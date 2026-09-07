<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArsipBudaya;
use App\Services\SupabaseStorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArsipBudayaController extends Controller
{
    protected SupabaseStorageService $storageService;

    public function __construct(SupabaseStorageService $storageService)
    {
        $this->storageService = $storageService;
    }

    public function index(Request $request)
    {
        $search = $request->query('search');
        $query = ArsipBudaya::query();

        if ($search) {
            $query->where('judul_arsip', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%");
        }

        $arsips = $query->latest()->paginate(10)->withQueryString();
        $totalKoleksi = ArsipBudaya::count();
        $digitalisasiBulanIni = ArsipBudaya::whereMonth('created_at', now()->month)
                                           ->whereYear('created_at', now()->year)
                                           ->count();

        return view('admin.arsip.index', compact('arsips', 'totalKoleksi', 'digitalisasiBulanIni', 'search'));
    }

    public function create()
    {
        return view('admin.arsip.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_arsip'       => 'required|string|max:255',
            'kategori'          => 'required|string|max:100',
            'tahun_dokumentasi' => 'nullable|integer',
            'deskripsi'         => 'nullable|string',
            'thumbnail'         => 'nullable|image|max:5120',
            'file_media'        => 'nullable|file|max:20480',
            'video_youtube'     => 'nullable|url|max:255',
        ]);

        $validated['id_admin'] = Auth::id() ?? 1;

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $this->storageService->upload($request->file('thumbnail'), 'arsip/thumbnails');
        }

        if ($request->hasFile('file_media')) {
            $validated['file_media'] = $this->storageService->upload($request->file('file_media'), 'arsip/media');
        }

        ArsipBudaya::create($validated);

        return redirect()->route('admin.arsip.index')->with('success', 'Arsip budaya berhasil ditambahkan.');
    }

    public function edit(ArsipBudaya $arsip)
    {
        return view('admin.arsip.edit', compact('arsip'));
    }

    public function update(Request $request, ArsipBudaya $arsip)
    {
        $validated = $request->validate([
            'judul_arsip'       => 'required|string|max:255',
            'kategori'          => 'required|string|max:100',
            'tahun_dokumentasi' => 'nullable|integer',
            'deskripsi'         => 'nullable|string',
            'thumbnail'         => 'nullable|image|max:5120',
            'file_media'        => 'nullable|file|max:20480',
            'video_youtube'     => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('thumbnail')) {
            $this->storageService->delete($arsip->thumbnail);
            $validated['thumbnail'] = $this->storageService->upload($request->file('thumbnail'), 'arsip/thumbnails');
        }

        if ($request->hasFile('file_media')) {
            $this->storageService->delete($arsip->file_media);
            $validated['file_media'] = $this->storageService->upload($request->file('file_media'), 'arsip/media');
        }

        $arsip->update($validated);

        return redirect()->route('admin.arsip.index')->with('success', 'Arsip budaya berhasil diperbarui.');
    }

    public function destroy(ArsipBudaya $arsip)
    {
        $this->storageService->delete($arsip->thumbnail);
        $this->storageService->delete($arsip->file_media);
        $arsip->delete();

        return redirect()->route('admin.arsip.index')->with('success', 'Arsip berhasil dihapus.');
    }
}