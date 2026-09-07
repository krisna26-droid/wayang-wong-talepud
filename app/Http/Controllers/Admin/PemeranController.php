<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karakter;
use App\Models\Pemeran;
use App\Services\SupabaseStorageService;
use Illuminate\Http\Request;

class PemeranController extends Controller
{
    protected SupabaseStorageService $storageService;

    public function __construct(SupabaseStorageService $storageService)
    {
        $this->storageService = $storageService;
    }

    public function index(Request $request)
    {
        $search = $request->query('search');
        $query = Pemeran::with('karakters');

        if ($search) {
            $query->where('nama_pemeran', 'like', "%{$search}%");
        }

        $pemerans = $query->latest()->paginate(10)->withQueryString();

        return view('admin.pemeran.index', compact('pemerans', 'search'));
    }

    public function create()
    {
        $karakters = Karakter::select('id_karakter', 'nama_karakter')->get();
        return view('admin.pemeran.create', compact('karakters'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pemeran'    => 'required|string|max:255',
            'pengalaman'      => 'nullable|string|max:100',
            'biodata_singkat' => 'nullable|string',
            'foto_pemeran'    => 'nullable|image|max:5120',
            'video_youtube'   => 'nullable|url|max:255',
            'karakter_ids'    => 'nullable|array',
            'karakter_ids.*'  => 'exists:karakters,id_karakter',
        ]);

        if ($request->hasFile('foto_pemeran')) {
            $validated['foto_pemeran'] = $this->storageService->upload($request->file('foto_pemeran'), 'pemeran/foto');
        }

        $pemeran = Pemeran::create($validated);

        if ($request->has('karakter_ids')) {
            $pemeran->karakters()->sync($request->karakter_ids);
        }

        return redirect()->route('admin.pemeran.index')->with('success', 'Data seniman pemeran berhasil disimpan.');
    }

    public function edit(Pemeran $pemeran)
    {
        $karakters = Karakter::select('id_karakter', 'nama_karakter')->get();
        $selectedKarakters = $pemeran->karakters->pluck('id_karakter')->toArray();

        return view('admin.pemeran.edit', compact('pemeran', 'karakters', 'selectedKarakters'));
    }

    public function update(Request $request, Pemeran $pemeran)
    {
        $validated = $request->validate([
            'nama_pemeran'    => 'required|string|max:255',
            'pengalaman'      => 'nullable|string|max:100',
            'biodata_singkat' => 'nullable|string',
            'foto_pemeran'    => 'nullable|image|max:5120',
            'video_youtube'   => 'nullable|url|max:255',
            'karakter_ids'    => 'nullable|array',
            'karakter_ids.*'  => 'exists:karakters,id_karakter',
        ]);

        if ($request->hasFile('foto_pemeran')) {
            $this->storageService->delete($pemeran->foto_pemeran);
            $validated['foto_pemeran'] = $this->storageService->upload($request->file('foto_pemeran'), 'pemeran/foto');
        }

        $pemeran->update($validated);

        if ($request->has('karakter_ids')) {
            $pemeran->karakters()->sync($request->karakter_ids);
        } else {
            $pemeran->karakters()->detach();
        }

        return redirect()->route('admin.pemeran.index')->with('success', 'Data seniman pemeran berhasil diperbarui.');
    }

    public function destroy(Pemeran $pemeran)
    {
        $this->storageService->delete($pemeran->foto_pemeran);
        $pemeran->karakters()->detach();
        $pemeran->delete();

        return redirect()->route('admin.pemeran.index')->with('success', 'Pemeran berhasil dihapus.');
    }
}