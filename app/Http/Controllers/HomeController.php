<?php

namespace App\Http\Controllers;

use App\Models\ArsipBudaya;
use App\Models\Karakter;
use App\Models\Pemeran;
use App\Models\Topeng;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $karakterSorotan = Karakter::with('topeng')->inRandomOrder()->first() ?? Karakter::with('topeng')->latest()->first();
        $topengSorotan = Topeng::inRandomOrder()->first() ?? Topeng::latest()->first();
        $pemeranSorotan = Pemeran::inRandomOrder()->first() ?? Pemeran::latest()->first();
        $arsipFotoSampul = ArsipBudaya::whereNotNull('file_media')->latest()->first();

        $totalTopeng = Topeng::count();
        $totalArsip = ArsipBudaya::count();
        $totalKarakter = Karakter::count();
        $totalPemeran = Pemeran::count();

        return view('welcome', compact(
            'karakterSorotan',
            'topengSorotan',
            'pemeranSorotan',
            'arsipFotoSampul',
            'totalTopeng',
            'totalArsip',
            'totalKarakter',
            'totalPemeran'
        ));
    }

    public function sejarah()
    {
        $videoSejarah = ArsipBudaya::whereNotNull('video_youtube')->latest()->first();
        return view('sejarah', compact('videoSejarah'));
    }

    public function topeng()
    {
        $semuaTopeng = Topeng::latest()->get();
        $topengs = Topeng::latest()->paginate(12);
        return view('topeng.index', compact('semuaTopeng', 'topengs'));
    }

    public function topengDetail($id)
    {
        $topeng = Topeng::with(['karakters.pemerans'])->findOrFail($id);
        return view('topeng.show', compact('topeng'));
    }

    public function karakter(Request $request)
    {
        $search = $request->query('search');
        $query = Karakter::with(['topeng', 'pemerans']);

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_karakter', 'like', "%{$search}%")
                  ->orWhere('peran', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $karakters = $query->latest()->paginate(9)->withQueryString();
        $totalKarakter = Karakter::count();

        return view('karakter.index', compact('karakters', 'totalKarakter', 'search'));
    }

    public function karakterVideo($id)
    {
        $karakter = Karakter::with(['topeng', 'pemerans'])->findOrFail($id);
        return view('karakter.video', compact('karakter'));
    }

    public function pemeran(Request $request)
    {
        $filter = $request->query('filter');
        $search = $request->query('search');

        $query = Pemeran::with('karakters');

        if ($filter === 'seniwati') {
            $query->where(function ($q) {
                $q->where('nama_pemeran', 'like', 'Ni %')
                  ->orWhere('biodata_singkat', 'like', '%seniwati%')
                  ->orWhereHas('karakters', function ($kq) {
                      $kq->where('nama_karakter', 'like', '%Sinta%')
                        ->orWhere('peran', 'like', '%putri%');
                  });
            });
        } elseif ($filter === 'seniwan') {
            $query->where(function ($q) {
                $q->where('nama_pemeran', 'not like', 'Ni %')
                  ->orWhere('biodata_singkat', 'like', '%seniman%');
            });
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_pemeran', 'like', "%{$search}%")
                  ->orWhere('biodata_singkat', 'like', "%{$search}%")
                  ->orWhere('pengalaman', 'like', "%{$search}%");
            });
        }

        $featuredPemeran = (clone $query)->whereNotNull('foto_pemeran')->latest()->first()
                            ?? (clone $query)->latest()->first();

        $gridQuery = clone $query;
        if ($featuredPemeran) {
            $gridQuery->where('id_pemeran', '!=', $featuredPemeran->id_pemeran);
        }

        $pemerans = $gridQuery->paginate(9)->withQueryString();

        return view('pemeran.index', compact('featuredPemeran', 'pemerans', 'filter', 'search'));
    }

    public function arsip(Request $request)
    {
        $kategori = $request->query('kategori');
        $tahun = $request->query('tahun');
        $search = $request->query('search');

        $query = Topeng::query();

        if (!empty($kategori)) {
            $query->where('kategori', $kategori);
        }

        if (!empty($tahun)) {
            if (str_contains($tahun, '-')) {
                [$startYear, $endYear] = explode('-', $tahun);
                $query->where(function ($q) use ($startYear, $endYear) {
                    $q->whereBetween(DB::raw('YEAR(tanggal_dokumentasi)'), [(int)$startYear, (int)$endYear])
                      ->orWhere('periode_sejarah', 'like', "%{$startYear}%")
                      ->orWhere('periode_sejarah', 'like', "%{$endYear}%");
                });
            } else {
                $query->where(function ($q) use ($tahun) {
                    $q->whereYear('tanggal_dokumentasi', $tahun)
                      ->orWhere('periode_sejarah', 'like', "%{$tahun}%");
                });
            }
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_topeng', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('bahan_pembuatan', 'like', "%{$search}%");
            });
        }

        $totalSemua = Topeng::count();
        $arsips = $query->latest('tanggal_dokumentasi')->paginate(9)->withQueryString();
        $daftarKategori = Topeng::whereNotNull('kategori')->distinct()->pluck('kategori');

        return view('arsip.index', compact('arsips', 'totalSemua', 'daftarKategori', 'kategori', 'tahun', 'search'));
    }

    public function arsipDetail($id)
    {
        $topeng = Topeng::findOrFail($id);
        return view('arsip.show', compact('topeng'));
    }
}