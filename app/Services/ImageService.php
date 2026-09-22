<?php

namespace App\Services;

use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Mekanisme terpusat untuk menyimpan gambar upload.
 *
 * Setiap gambar yang masuk dikonversi ke WebP dan dikompresi
 * (kualitas 90, sisi terpanjang maksimal 1920px, hanya diperkecil
 * tidak pernah diperbesar) sehingga ringan namun tetap tajam.
 *
 * WAJIB dipakai oleh semua controller yang menerima upload gambar
 * (banner, galeri, personalia, sambutan, dsb.) agar formatnya seragam.
 */
class ImageService
{
    public function __construct(
        protected string $disk = 'public',
        protected int $quality = 90,
        protected int $maxDimension = 1920,
    ) {}

    /**
     * Simpan gambar sebagai WebP terkompresi.
     *
     * Mengembalikan path relatif-publik, contoh: storage/banners/xxxx.webp
     * (format yang sama seperti sebelumnya, jadi view tidak perlu diubah).
     */
    public function storeAsWebp(UploadedFile $file, string $directory): string
    {
        $directory = trim($directory, '/');

        if ($this->canConvert()) {
            $converted = $this->convert($file);

            if ($converted !== null) {
                $name = Str::random(40) . '.webp';
                Storage::disk($this->disk)->putFileAs($directory, new File($converted), $name);
                @unlink($converted);

                return 'storage/' . $directory . '/' . $name;
            }

            Log::warning('ImageService: gambar gagal dikonversi ke WebP, menyimpan berkas original.', [
                'name' => $file->getClientOriginalName(),
            ]);
        } else {
            Log::warning('ImageService: ekstensi GD tidak tersedia, gambar disimpan tanpa konversi WebP. Install php-gd agar konversi aktif.');
        }

        return 'storage/' . $file->store($directory, $this->disk);
    }

    /**
     * Hapus berkas gambar berdasarkan path relatif-publik (storage/...).
     */
    public function delete(?string $publicPath): void
    {
        if ($publicPath && str_starts_with($publicPath, 'storage/')) {
            Storage::disk($this->disk)->delete(Str::after($publicPath, 'storage/'));
        }
    }

    protected function canConvert(): bool
    {
        return function_exists('imagecreatefromstring')
            && function_exists('imagewebp');
    }

    /**
     * Konversi ke WebP. Mengembalikan path file sementara, atau null bila gagal.
     */
    protected function convert(UploadedFile $file): ?string
    {
        try {
            // Gambar yang sudah WebP dan ukurannya wajar disimpan apa adanya
            // agar tidak ada penurunan kualitas akibat encode ulang.
            if ($file->getMimeType() === 'image/webp') {
                $size = @getimagesize($file->getRealPath());
                if ($size && max($size[0], $size[1]) <= $this->maxDimension) {
                    $tmp = tempnam(sys_get_temp_dir(), 'webp_') . '.webp';
                    if (@copy($file->getRealPath(), $tmp)) {
                        return $tmp;
                    }
                }
            }

            $src = @imagecreatefromstring(file_get_contents($file->getRealPath()));
            if ($src === false) {
                return null;
            }

            if (! imageistruecolor($src)) {
                imagepalettetotruecolor($src);
            }

            $width = imagesx($src);
            $height = imagesy($src);
            if ($width <= 0 || $height <= 0) {
                imagedestroy($src);

                return null;
            }

            // Hanya perkecil, tidak pernah perbesar.
            $scale = min(1, $this->maxDimension / max($width, $height));
            if ($scale < 1) {
                $newWidth = (int) round($width * $scale);
                $newHeight = (int) round($height * $scale);
                $dst = imagecreatetruecolor($newWidth, $newHeight);
                imagealphablending($dst, false);
                imagesavealpha($dst, true);
                imagefill($dst, 0, 0, imagecolorallocatealpha($dst, 0, 0, 0, 127));
                imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                imagedestroy($src);
            } else {
                $dst = $src;
                imagealphablending($dst, false);
                imagesavealpha($dst, true);
            }

            $tmp = tempnam(sys_get_temp_dir(), 'webp_') . '.webp';
            $ok = imagewebp($dst, $tmp, $this->quality);
            imagedestroy($dst);

            if (! $ok) {
                @unlink($tmp);

                return null;
            }

            return $tmp;
        } catch (\Throwable) {
            return null;
        }
    }
}
