<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelatedLink extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * URL logo hanya dikembalikan bila berkasnya benar-benar ada.
     * Mendukung path storage/ (hasil upload admin) dan path public/images/.
     */
    public function logoUrl(): ?string
    {
        if (! $this->logo) {
            return null;
        }

        if (str_starts_with($this->logo, 'storage/')) {
            $relative = substr($this->logo, strlen('storage/'));

            return \Illuminate\Support\Facades\Storage::disk('public')->exists($relative)
                ? asset($this->logo)
                : null;
        }

        return file_exists(public_path($this->logo)) ? asset($this->logo) : null;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }
}
