<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DataStaffPerjalanan;
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

        $data = DataStaffPerjalanan::select()
            ->with('staff', 'perjalanan', 'perjalanan.mak', 'tujuan_perjalanan.tempatTujuan', 'spd', 'kwitansi')
            ->offset($request['start'])
            ->limit(($request['length'] == -1) ? Kwitansi::where('status', true)->count() : $request['length'])
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->get();

        $dataCounter = DataStaffPerjalanan::select()
            ->with('staff', 'perjalanan', 'perjalanan.mak', 'tujuan_perjalanan', 'spd', 'kwitansi')
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->count();
        $response = [
            'status'          => true,
            'draw'            => $request['draw'],
            'recordsTotal'    => DataStaffPerjalanan::where('status', true)->count(),
            'recordsFiltered' => $dataCounter,
            'data'            => $data,
        ];
        return $response;
    }

    public function create($id)
    {
        $dataStaff = DataStaffPerjalanan::with(['staff', 'perjalanan.mak', 'tujuan_perjalanan'])->find($id);
        // dd($dataStaff);

        return view('pages.kwitansi.create', compact('dataStaff'));
    }

    public function kwitansiPDF($id)
    {
        $kwitansi = Kwitansi::with(['dataStaffPerjalanan.staff', 'dataStaffPerjalanan.perjalanan.mak', 'dataStaffPerjalanan.tujuan_perjalanan', 'bendahara', 'pejabatPembuatKomitmen', 'dataStaffPerjalanan.spd'])->find($id);
        // dd($kwitansi);

        // return $pdf->stream();

        if ($kwitansi) {
            $pdf = \PDF::loadView('pages.kwitansi.pdf', compact('kwitansi'));
            return $pdf->stream();
        } else {
            alert()->warning('', 'Data tidak ditemukan');
            return redirect()->back();
        }
    }
}
