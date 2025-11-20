<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoTutorial extends Model
{
    use HasFactory;

    protected $table = 'video_tutorials';

    protected $fillable = [
        'judul',
        'keterangan',
        'modul',
        'keterangan_modul',
        'video_path',
        'video_url',
        'durasi',
        'urutan',
        'is_aktif',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'is_aktif' => 'boolean',
            'durasi' => 'integer',
            'urutan' => 'integer',
        ];
    }

    /**
     * Relationship: User yang membuat video tutorial
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get video URL (local atau external)
     */
    public function getVideoUrlDisplayAttribute()
    {
        if ($this->attributes['video_url'] ?? null) {
            return $this->attributes['video_url'];
        }
        
        if ($this->video_path) {
            return asset('storage/' . $this->video_path);
        }
        
        return null;
    }

    /**
     * Get formatted duration
     */
    public function getFormattedDurasiAttribute(): string
    {
        if (!$this->durasi) {
            return '-';
        }

        $hours = floor($this->durasi / 3600);
        $minutes = floor(($this->durasi % 3600) / 60);
        $seconds = $this->durasi % 60;

        if ($hours > 0) {
            return sprintf('%d:%02d:%02d', $hours, $minutes, $seconds);
        }

        return sprintf('%d:%02d', $minutes, $seconds);
    }

    /**
     * Check if video URL is from Google Drive
     */
    public function isGoogleDriveUrl(): bool
    {
        if (!$this->video_url) {
            return false;
        }

        return str_contains($this->video_url, 'drive.google.com');
    }

    /**
     * Get Google Drive embed URL
     */
    public function getGoogleDriveEmbedUrl(): ?string
    {
        if (!$this->isGoogleDriveUrl()) {
            return null;
        }

        // Extract file ID from various Google Drive URL formats
        // Format 1: https://drive.google.com/file/d/FILE_ID/view
        // Format 2: https://drive.google.com/open?id=FILE_ID
        // Format 3: https://drive.google.com/uc?id=FILE_ID
        // Format 4: https://docs.google.com/file/d/FILE_ID/edit

        $url = $this->video_url;
        $fileId = null;

        // Pattern 1: /file/d/FILE_ID/
        if (preg_match('/\/file\/d\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            $fileId = $matches[1];
        }
        // Pattern 2: ?id=FILE_ID
        elseif (preg_match('/[?&]id=([a-zA-Z0-9_-]+)/', $url, $matches)) {
            $fileId = $matches[1];
        }
        // Pattern 3: /uc?id=FILE_ID
        elseif (preg_match('/\/uc\?id=([a-zA-Z0-9_-]+)/', $url, $matches)) {
            $fileId = $matches[1];
        }

        if ($fileId) {
            // Return Google Drive preview/embed URL
            return "https://drive.google.com/file/d/{$fileId}/preview";
        }

        return null;
    }

    /**
     * Get video source type for rendering
     */
    public function getVideoSourceType(): string
    {
        if ($this->video_path) {
            return 'local';
        }

        if ($this->isGoogleDriveUrl()) {
            return 'google_drive';
        }

        if ($this->video_url && (str_contains($this->video_url, 'youtube.com') || str_contains($this->video_url, 'youtu.be'))) {
            return 'youtube';
        }

        if ($this->video_url) {
            return 'external';
        }

        return 'none';
    }
}

