<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Topeng extends Model
{
    use HasFactory;

    protected $table = 'topengs';
    protected $primaryKey = 'id_topeng';
    protected $guarded = ['id_topeng'];

    public function karakters()
    {
        return $this->hasMany(Karakter::class, 'id_topeng', 'id_topeng');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }

    protected function fotoCover(): Attribute
    {
        return Attribute::make(
            get: function (?string $value) {
                if (!$value) return null;
                if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
                    return $value;
                }
                $cleanPath = preg_replace('#^/?' . preg_quote(env('SUPABASE_STORAGE_BUCKET', 'wayang-wong'), '#') . '/#', '', $value);
                return rtrim(env('SUPABASE_PUBLIC_URL', 'https://xxnzfemutgulvophvdfx.supabase.co/storage/v1/object/public/wayang-wong'), '/') . '/' . ltrim($cleanPath, '/');
            }
        );
    }
}