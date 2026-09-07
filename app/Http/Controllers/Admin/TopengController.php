<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topeng;
use App\Services\SupabaseStorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopengController extends Controller
{
    protected SupabaseStorageService $storageService;

    public function __construct(SupabaseStorageService $storageService)
    {
        $this->storageService = $storageService;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Topeng::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_topeng', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%");
            });
        }

        $totalKoleksi = Topeng::count();
        $totalModel3D = Topeng::whereNotNull('model_3d')->count();
        $updateTerakhir = Topeng::latest('updated_at')->first();

        $topengs = $query->latest()->paginate(10)->withQueryString();

        return view('admin.topeng.index', compact(
            'topengs',
            'totalKoleksi',
            'totalModel3D',
            'updateTerakhir',
            'search'
        ));
    }

    public function create()
    {
        return view('admin.topeng.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_topeng' => 'required|string|max:100',
            'kategori' => 'required|in:Ratu Lingsir,Ratu Anom',
            'pencipta_pembuat' => 'nullable|string|max:100',
            'jenis_koleksi' => 'nullable|string|max:100',
            'model_3d' => 'nullable|file|max:51200',
            'foto_cover' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'deskripsi' => 'nullable|string',
            'makna_filosofis' => 'nullable|string',
            'fungsi_pertunjukan' => 'nullable|string',
            'nilai_budaya' => 'nullable|string',
            'nilai_estetika' => 'nullable|string',
            'bahan_pembuatan' => 'nullable|string|max:100',
            'periode_sejarah' => 'nullable|string|max:100',
            'lokasi_penyimpanan' => 'nullable|string|max:150',
            'pemilik' => 'nullable|string|max:100',
            'pengelola' => 'nullable|string|max:100',
            'kondisi_koleksi' => 'nullable|string|max:100',
            'tanggal_dokumentasi' => 'nullable|date',
            'petugas_dokumentasi' => 'nullable|string|max:100',
        ]);

        if ($request->hasFile('model_3d')) {
            $validated['model_3d'] = $this->storageService->upload($request->file('model_3d'), 'models');
        }

        if ($request->hasFile('foto_cover')) {
            $validated['foto_cover'] = $this->storageService->upload($request->file('foto_cover'), 'covers');
        }

        $validated['id_admin'] = Auth::id();

        Topeng::create($validated);

        return redirect()->route('admin.topeng.index')->with('success', 'Data topeng berhasil ditambahkan.');
    }

    public function edit(Topeng $topeng)
    {
        return view('admin.topeng.edit', compact('topeng'));
    }

    public function update(Request $request, Topeng $topeng)
    {
        $validated = $request->validate([
            'nama_topeng' => 'required|string|max:100',
            'kategori' => 'required|in:Ratu Lingsir,Ratu Anom',
            'pencipta_pembuat' => 'nullable|string|max:100',
            'jenis_koleksi' => 'nullable|string|max:100',
            'model_3d' => 'nullable|file|max:51200',
            'foto_cover' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'deskripsi' => 'nullable|string',
            'makna_filosofis' => 'nullable|string',
            'fungsi_pertunjukan' => 'nullable|string',
            'nilai_budaya' => 'nullable|string',
            'nilai_estetika' => 'nullable|string',
            'bahan_pembuatan' => 'nullable|string|max:100',
            'periode_sejarah' => 'nullable|string|max:100',
            'lokasi_penyimpanan' => 'nullable|string|max:150',
            'pemilik' => 'nullable|string|max:100',
            'pengelola' => 'nullable|string|max:100',
            'kondisi_koleksi' => 'nullable|string|max:100',
            'tanggal_dokumentasi' => 'nullable|date',
            'petugas_dokumentasi' => 'nullable|string|max:100',
        ]);

        if ($request->hasFile('model_3d')) {
            $this->storageService->delete($topeng->model_3d);
            $validated['model_3d'] = $this->storageService->upload($request->file('model_3d'), 'models');
        }

        if ($request->hasFile('foto_cover')) {
            $this->storageService->delete($topeng->foto_cover);
            $validated['foto_cover'] = $this->storageService->upload($request->file('foto_cover'), 'covers');
        }

        $topeng->update($validated);

        return redirect()->route('admin.topeng.index')->with('success', 'Data topeng berhasil diperbarui.');
    }

    public function destroy(Topeng $topeng)
    {
        $this->storageService->delete($topeng->model_3d);
        $this->storageService->delete($topeng->foto_cover);
        $topeng->delete();

        return redirect()->route('admin.topeng.index')->with('success', 'Data topeng berhasil dihapus.');
    }
}