<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DataStaffPerjalanan;
use App\Models\Kwitansi;
use App\Models\Staff;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KwitansiController extends Controller
{
    public function index()
    {
        return view('pages.pra-perjalanan.kwitansi.index');
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
        $staff  = Staff::where('status', true)->get();
        $dataStaff = DataStaffPerjalanan::with(['staff', 'perjalanan.mak', 'tujuan_perjalanan'])->find($id);
        // dd($dataStaff);

        return view('pages.pra-perjalanan.kwitansi.create', compact('dataStaff', 'staff'));
    }

    public function store(Request $request)
    {
        //make create function
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Kwitansi failed to create'];
            $create = Kwitansi::create([
                'id_staff_perjalanan' => $request->input('id_staff_perjalanan'),
                'id_bendahara'        => $request->input('id_bendahara'),
                'id_pejabat_pembuat_komitmen' => $request->input('id_pejabat_pembuat_komitmen'),
                'bukti_kas_nomor'        => $request->input('bukti_kas_nomor'),
                'tahun_anggaran'      => $request->input('tahun_anggaran'),
                'sudah_diterima_dari' => $request->input('sudah_diterima_dari'),
                'status'              => true,
            ]);

            // if ($create) {
            //     $dataStaff = DataStaffPerjalanan::where('id', $request->input('id_staff_perjalanan'))->first();
            //     $dataStaff->status_kwitansi = true;
            //     $dataStaff->save();
            // }

            if ($create->save()) {
                $response = ['status' => true, 'code' => 'SC001', 'message' => 'Kwitansi successfully created'];
            }
        } catch (\Exception $ex) {
            $response = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. Please try again later. ' . $ex];
        }
        if ($response['status']) {
            Alert::success('Kwitansi Berhasil Dibuat', 'Berhasil');
            return redirect()->route('kwitansi');
        } else {
            Alert::error('Kwitansi Gagal Dibuat', 'Gagal');
            return redirect()->back();
        }

    }

    public function kwitansiPDF($id)
    {
        // $kwitansi = Kwitansi::with(['dataStaffPerjalanan.staff', 'dataStaffPerjalanan.perjalanan.mak', 'dataStaffPerjalanan.tujuan_perjalanan', 'bendahara', 'pejabatPembuatKomitmen', 'dataStaffPerjalanan.spd'])->find($id);
        // // dd($kwitansi);

        // // return $pdf->stream();

        // if ($kwitansi) {
        //     $pdf = \PDF::loadView('pages.kwitansi.pdf', compact('kwitansi'));
        //     return $pdf->stream();
        // } else {
        //     alert()->warning('', 'Data tidak ditemukan');
        //     return redirect()->back();
        // }

        // $kwitansi = Kwitansi::with(['dataStaffPerjalanan.staff', 'dataStaffPerjalanan.perjalanan.mak', 'dataStaffPerjalanan.tujuan_perjalanan', 'bendahara', 'pejabatPembuatKomitmen', 'dataStaffPerjalanan.spd'])->find($id);
        $kwitansi = DataStaffPerjalanan::with(['staff', 'perjalanan.mak', 'tujuan_perjalanan', 'spd', 'kwitansi'])->find($id);
        $pdf = \PDF::loadView('pages.pra-perjalanan.kwitansi.pdf', compact('kwitansi'));
        return $pdf->stream();
    }
}
