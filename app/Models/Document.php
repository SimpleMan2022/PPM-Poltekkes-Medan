<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    protected $fillable = [
        'document_category_id',
        'code',
        'name',
        'published_year',
        'file_path',
    ];

    public function documentCategory(): BelongsTo
    {
        return $this->belongsTo(DocumentCategory::class);
    }

    public function fileExists(): bool
    {
        return (bool) $this->file_path && Storage::disk('public')->exists($this->file_path);
    }

    public function fileUrl(): ?string
    {
        return $this->fileExists() ? Storage::url($this->file_path) : null;
    }
}
