<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Kwitansi;
use Illuminate\Http\Request;

class KwitansiController extends Controller
{
    public function index()
    {
        return view('pages.kwitansi.index');
    }
    public function getData(Request $request)
    {
        $keyword = $request['searchkey'];

        $data = Kwitansi::select()
            ->with('dataStaffPerjalanan.staff', 'dataStaffPerjalanan.perjalanan.mak', 'dataStaffPerjalanan.tujuan_perjalanan', 'bendahara', 'pejabatPembuatKomitmen')
            ->offset($request['start'])
            ->limit(($request['length'] == -1) ? Kwitansi::where('status', true)->count() : $request['length'])
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->get();

        $dataCounter = Kwitansi::select()
            ->with('DataStaffPerjalanan', 'Bendahara', 'PejabatPembuatKomitmen')
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->count();
        $response = [
            'status'          => true,
            'draw'            => $request['draw'],
            'recordsTotal'    => Kwitansi::where('status', true)->count(),
            'recordsFiltered' => $dataCounter,
            'data'            => $data,
        ];
        return $response;
    }

    public function create($id)
    {
        $kwitansi = Kwitansi::with(['dataStaffPerjalanan.staff', 'dataStaffPerjalanan.perjalanan.mak', 'dataStaffPerjalanan.tujuan_perjalanan', 'bendahara', 'pejabatPembuatKomitmen', 'dataStaffPerjalanan.spd'])->find($id);
        // dd($kwitansi);
        return view(('pages.kwitansi.pdf'), compact('kwitansi'));
    }

    public function kwitansiPDF($id)
    {
        $kwitansi = Kwitansi::with(['dataStaffPerjalanan'])->find($id);
        // dd($kwitansi);
        $pdf = \PDF::loadView('pages.kwitansi.pdf', compact('kwitansi'));
        return $pdf->stream();
    }
}
