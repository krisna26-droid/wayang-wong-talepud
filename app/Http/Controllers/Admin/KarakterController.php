<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karakter;
use App\Models\Topeng;
use App\Services\SupabaseStorageService;
use Illuminate\Http\Request;

class KarakterController extends Controller
{
    protected SupabaseStorageService $storageService;

    public function __construct(SupabaseStorageService $storageService)
    {
        $this->storageService = $storageService;
    }

    public function index(Request $request)
    {
        $search = $request->query('search');
        $query = Karakter::with('topeng');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_karakter', 'like', "%{$search}%")
                  ->orWhere('peran', 'like', "%{$search}%");
            });
        }

        $karakters = $query->latest()->paginate(10)->withQueryString();
        $totalKarakter = Karakter::count();
        $peranAktif = Karakter::distinct('peran')->count('peran');

        return view('admin.karakter.index', compact('karakters', 'totalKarakter', 'peranAktif', 'search'));
    }

    public function create()
    {
        $topengs = Topeng::select('id_topeng', 'nama_topeng')->get();
        return view('admin.karakter.create', compact('topengs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_karakter'   => 'required|string|max:255',
            'peran'           => 'nullable|string|max:100',
            'id_topeng'       => 'nullable|exists:topengs,id_topeng',
            'deskripsi'       => 'nullable|string',
            'visual_karakter' => 'nullable|image|max:5120',
            'audio_karakter'  => 'nullable|mimes:mp3,wav,ogg,m4a|max:10240',
            'video_youtube'   => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('visual_karakter')) {
            $validated['visual_karakter'] = $this->storageService->upload($request->file('visual_karakter'), 'karakter/visual');
        }

        if ($request->hasFile('audio_karakter')) {
            $validated['audio_karakter'] = $this->storageService->upload($request->file('audio_karakter'), 'karakter/audio');
        }

        Karakter::create($validated);

        return redirect()->route('admin.karakter.index')->with('success', 'Karakter berhasil ditambahkan.');
    }

    public function edit(Karakter $karakter)
    {
        $topengs = Topeng::select('id_topeng', 'nama_topeng')->get();
        return view('admin.karakter.edit', compact('karakter', 'topengs'));
    }

    public function update(Request $request, Karakter $karakter)
    {
        $validated = $request->validate([
            'nama_karakter'   => 'required|string|max:255',
            'peran'           => 'nullable|string|max:100',
            'id_topeng'       => 'nullable|exists:topengs,id_topeng',
            'deskripsi'       => 'nullable|string',
            'visual_karakter' => 'nullable|image|max:5120',
            'audio_karakter'  => 'nullable|mimes:mp3,wav,ogg,m4a|max:10240',
            'video_youtube'   => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('visual_karakter')) {
            $this->storageService->delete($karakter->visual_karakter);
            $validated['visual_karakter'] = $this->storageService->upload($request->file('visual_karakter'), 'karakter/visual');
        }

        if ($request->hasFile('audio_karakter')) {
            $this->storageService->delete($karakter->audio_karakter);
            $validated['audio_karakter'] = $this->storageService->upload($request->file('audio_karakter'), 'karakter/audio');
        }

        $karakter->update($validated);

        return redirect()->route('admin.karakter.index')->with('success', 'Karakter berhasil diperbarui.');
    }

    public function destroy(Karakter $karakter)
    {
        $this->storageService->delete($karakter->visual_karakter);
        $this->storageService->delete($karakter->audio_karakter);
        $karakter->delete();

        return redirect()->route('admin.karakter.index')->with('success', 'Karakter berhasil dihapus.');
    }
}