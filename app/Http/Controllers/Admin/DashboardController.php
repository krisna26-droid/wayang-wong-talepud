<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArsipBudaya;
use App\Models\Karakter;
use App\Models\Pemeran;
use App\Models\Topeng;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTopeng = Topeng::count();
        $totalArsip = ArsipBudaya::count();
        $totalKarakter = Karakter::count();
        $totalPemeran = Pemeran::count();

        $topengTerbaru = Topeng::latest()->take(5)->get();
        $arsipTerbaru = ArsipBudaya::latest()->take(5)->get();
        $pemeranTerbaru = Pemeran::with('karakters')->latest()->take(4)->get();

        return view('admin.dashboard', compact(
            'totalTopeng',
            'totalArsip',
            'totalKarakter',
            'totalPemeran',
            'topengTerbaru',
            'arsipTerbaru',
            'pemeranTerbaru'
        ));
    }
}