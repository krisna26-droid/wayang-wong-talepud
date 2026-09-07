<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class SupabaseStorageService
{
    protected string $supabaseUrl;
    protected string $apiKey;
    protected string $bucket;

    public function __construct()
    {
        $this->supabaseUrl = rtrim(env('SUPABASE_URL', 'https://xxnzfemutgulvophvdfx.supabase.co'), '/');
        $this->apiKey = env('SUPABASE_SERVICE_KEY', 'sb_publishable_mieb-2-g4_5KVE121SESMQ_YTrf4qtI');
        $this->bucket = env('SUPABASE_STORAGE_BUCKET', 'wayang-wong');
    }

    /**
     * Unggah berkas ke Supabase Storage via REST API.
     */
    public function upload(UploadedFile $file, string $folder = 'uploads'): string
    {
        $extension = $file->getClientOriginalExtension();
        $filename = Str::uuid() . '.' . $extension;
        $path = trim($folder, '/') . '/' . $filename;

        $endpoint = "{$this->supabaseUrl}/storage/v1/object/{$this->bucket}/{$path}";

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'apikey'        => $this->apiKey,
            'Content-Type'  => $file->getMimeType(),
        ])->withBody(
            file_get_contents($file->getRealPath()),
            $file->getMimeType()
        )->post($endpoint);

        if (!$response->successful()) {
            throw new \Exception('Supabase API Error (' . $response->status() . '): ' . $response->body());
        }

        return $this->getUrl($path);
    }

    /**
     * Hapus berkas dari Supabase Storage.
     */
    public function delete(?string $urlOrPath): bool
    {
        if (empty($urlOrPath)) {
            return false;
        }

        $path = $this->extractPathFromUrl($urlOrPath);
        $endpoint = "{$this->supabaseUrl}/storage/v1/object/{$this->bucket}";

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'apikey'        => $this->apiKey,
        ])->delete($endpoint, [
            'prefixes' => [$path],
        ]);

        return $response->successful();
    }

    /**
     * Dapatkan URL publik berkas.
     */
    public function getUrl(string $path): string
    {
        return "{$this->supabaseUrl}/storage/v1/object/public/{$this->bucket}/" . ltrim($path, '/');
    }

    /**
     * Ekstrak relative path dari URL lengkap.
     */
    protected function extractPathFromUrl(string $url): string
    {
        $publicPrefix = $this->getUrl('');

        if (str_starts_with($url, $publicPrefix)) {
            return ltrim(substr($url, strlen($publicPrefix)), '/');
        }

        return ltrim($url, '/');
    }
}