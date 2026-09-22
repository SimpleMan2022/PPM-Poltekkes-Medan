{{-- Dipakai create & edit. Variabel $user dan $roles selalu tersedia. --}}
<div class="bg-white border border-slate-200 rounded-xl p-5 sm:p-6 space-y-5 max-w-2xl">
    <div>
        <label for="name" class="block text-sm font-semibold text-slate-800 mb-1.5">Nama <span class="text-red-500">*</span></label>
        <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required maxlength="255" autocomplete="off"
            placeholder="Contoh: Budi Santoso"
            class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('name') border-red-300 @else border-slate-200 @enderror">
        @error('name')
            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="email" class="block text-sm font-semibold text-slate-800 mb-1.5">Email <span class="text-red-500">*</span></label>
        <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required maxlength="255" autocomplete="off"
            placeholder="Contoh: budi@poltekkesmedan.ac.id"
            class="w-full px-3.5 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('email') border-red-300 @else border-slate-200 @enderror">
        @error('email')
            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid sm:grid-cols-2 gap-5">
        <div>
            <label for="password" class="block text-sm font-semibold text-slate-800 mb-1.5">Password {{ $user->exists ? '' : '*' }}</label>
            <div class="relative">
                <input id="password" type="password" name="password" {{ $user->exists ? '' : 'required' }} minlength="8" autocomplete="new-password"
                    placeholder="{{ $user->exists ? 'Kosongkan bila tidak diganti' : 'Minimal 8 karakter' }}"
                    class="w-full pl-3.5 pr-11 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('password') border-red-300 @else border-slate-200 @enderror">
                <button type="button" data-pw-toggle="password" aria-label="Tampilkan password" class="absolute inset-y-0 right-0 px-3 text-slate-400 hover:text-slate-600 transition-colors">
                    <svg class="pw-eye w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <svg class="pw-eye-off w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                </button>
            </div>
            <p class="mt-1.5 text-xs text-slate-400">Minimal 8 karakter. {{ $user->exists ? 'Isi untuk mereset password akun ini.' : '' }}</p>
            @error('password')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-slate-800 mb-1.5">Konfirmasi password {{ $user->exists ? '' : '*' }}</label>
            <div class="relative">
                <input id="password_confirmation" type="password" name="password_confirmation" {{ $user->exists ? '' : 'required' }} minlength="8" autocomplete="new-password"
                    placeholder="Ulangi password yang sama"
                    class="w-full pl-3.5 pr-11 py-2.5 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition border-slate-200">
                <button type="button" data-pw-toggle="password_confirmation" aria-label="Tampilkan konfirmasi password" class="absolute inset-y-0 right-0 px-3 text-slate-400 hover:text-slate-600 transition-colors">
                    <svg class="pw-eye w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <svg class="pw-eye-off w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                </button>
            </div>
            <p class="mt-1.5 text-xs text-slate-400">Wajib sama persis dengan password di atas.</p>
        </div>
        <div>
            <label for="role" class="block text-sm font-semibold text-slate-800 mb-1.5">Peran <span class="text-red-500">*</span></label>
            <select id="role" name="role" required
                class="w-full px-3.5 py-2.5 text-sm border rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition @error('role') border-red-300 @else border-slate-200 @enderror">
                @foreach($roles as $value => $label)
                    <option value="{{ $value }}" @selected(old('role', $user->role) === $value)>{{ $label }}</option>
                @endforeach
            </select>
            <p class="mt-1.5 text-xs text-slate-400">Super Admin mengelola pengguna &amp; situs. Operator mengelola konten.</p>
            @error('role')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="flex items-center gap-2.5 pt-1">
        <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-primary hover:bg-primary-dark rounded-md transition-colors">Simpan</button>
        <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-800 transition-colors">Batal</a>
    </div>
</div>

@push('scripts')
<script>
    document.querySelectorAll('[data-pw-toggle]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var input = document.getElementById(btn.getAttribute('data-pw-toggle'));
            if (!input) return;
            var show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            btn.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
            btn.querySelector('.pw-eye').classList.toggle('hidden', show);
            btn.querySelector('.pw-eye-off').classList.toggle('hidden', !show);
        });
    });
</script>
@endpush
