<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeran extends Model
{
    use HasFactory;

    protected $table = 'pemerans';
    protected $primaryKey = 'id_pemeran';
    protected $guarded = ['id_pemeran'];

    public function karakters()
    {
        return $this->belongsToMany(Karakter::class, 'karakter_pemeran', 'id_pemeran', 'id_karakter')
                    ->withPivot('keterangan')
                    ->withTimestamps();
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }

    public function getYoutubeEmbedUrlAttribute(): ?string
    {
        if (empty($this->video_youtube)) return null;
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $this->video_youtube, $matches);
        return isset($matches[1]) ? 'https://www.youtube.com/embed/' . $matches[1] : null;
    }
}