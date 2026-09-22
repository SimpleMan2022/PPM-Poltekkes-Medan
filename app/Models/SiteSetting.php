<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    public const FALLBACK_LOGO = 'assets/images/logo_poltekkes.webp';

    protected $fillable = [
        'site_name',
        'logo',
        'address',
        'phone',
        'whatsapp',
        'email',
        'operating_hours',
        'instagram_url',
        'facebook_url',
        'youtube_url',
        'google_maps_embed',
        'copyright_text',
    ];

    /**
     * URL logo yang tampil di situs. Selalu ada hasilnya:
     * berkas upload bila ada, logo bawaan bila tidak.
     */
    public function logoUrl(): string
    {
        if ($this->logo) {
            if (str_starts_with($this->logo, 'storage/')) {
                $relative = substr($this->logo, strlen('storage/'));

                if (\Illuminate\Support\Facades\Storage::disk('public')->exists($relative)) {
                    return asset($this->logo);
                }
            } elseif (file_exists(public_path($this->logo))) {
                return asset($this->logo);
            }
        }

        return asset(self::FALLBACK_LOGO);
    }
}
