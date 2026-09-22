<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index', [
            'users' => User::orderBy('name')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.users.create', [
            'user' => new User(['role' => 'admin_operator']),
            'roles' => $this->roles(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules(), $this->messages());

        $user = User::create($data);

        return redirect()->route('admin.users.index')
            ->with('success', "Akun \"{$user->name}\" ditambahkan.");
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => $this->roles(),
        ]);
    }

    public function update(Request $request, User $user)
    {
        if ($user->is(auth()->user()) && $request->input('role') !== 'superadmin') {
            return back()
                ->withErrors(['role' => 'Anda tidak bisa menurunkan peran akun sendiri. Minta Super Admin lain melakukannya.'])
                ->withInput();
        }

        $data = $request->validate($this->rules($user), $this->messages());

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', "Akun \"{$user->name}\" disimpan.");
    }

    public function destroy(User $user)
    {
        if ($user->is(auth()->user())) {
            return back()->with('error', 'Anda tidak bisa menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', "Akun \"{$user->name}\" dihapus.");
    }

    private function rules(?User $user = null): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user?->id),
            ],
            'password' => $user?->exists
                ? 'nullable|string|min:8|confirmed'
                : 'required|string|min:8|confirmed',
            'role' => ['required', 'string', Rule::in(['superadmin', 'admin_operator'])],
        ];
    }

    private function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah dipakai akun lain.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sama. Ulangi dengan teliti.',
            'role.required' => 'Peran wajib dipilih.',
            'role.in' => 'Peran tidak dikenal.',
        ];
    }

    private function roles(): array
    {
        return [
            'superadmin' => 'Super Admin',
            'admin_operator' => 'Admin Operator',
        ];
    }
}
