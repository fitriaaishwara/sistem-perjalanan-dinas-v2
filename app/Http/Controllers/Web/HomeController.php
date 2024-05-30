<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Perjalanan;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Dashboard', ['only' => ['index']]);
    }

    public function index()
    {
        $naskah_masuk = Perjalanan::whereHas('status_perjalanan', function ($query) {
            $query->where('id_status', 1);
        })->count();
        $naskah_proses = Perjalanan::whereHas('status_perjalanan', function ($query) {
            $query->where('id_status', 2);
        })->count();

        $naskah_selesai = Perjalanan::whereHas('status_perjalanan', function ($query) {
            $query->where('id_status', 3);
        })->count();

        $naskah_ditolak = Perjalanan::whereHas('status_perjalanan', function ($query) {
            $query->where('id_status', 4);
        })->count();
        return view('pages.dashboard.index', compact('naskah_masuk', 'naskah_proses', 'naskah_selesai', 'naskah_ditolak'));
    }
}
