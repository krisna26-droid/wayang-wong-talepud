<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karakter extends Model
{
    use HasFactory;

    protected $table = 'karakters';
    protected $primaryKey = 'id_karakter';
    protected $guarded = ['id_karakter'];

    public function topeng()
    {
        return $this->belongsTo(Topeng::class, 'id_topeng', 'id_topeng');
    }

    public function pemerans()
    {
        return $this->belongsToMany(Pemeran::class, 'karakter_pemeran', 'id_karakter', 'id_pemeran')
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