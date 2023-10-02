<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DataStaffPerjalanan;
use App\Models\Spd;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SpdController extends Controller
{
    public function index()
    {
        return view('pages.spd.index');
    }

    public function getData(Request $request)
    {
        $keyword = $request['searchkey'];

        $data = DataStaffPerjalanan::select()
            ->with(['perjalanan.mak', 'staff.instansis', 'penandatangan', 'tujuan_perjalanan', 'spd'])
            ->offset($request['start'])
            ->limit(($request['length'] == -1) ? DataStaffPerjalanan::where('status', true)->count() : $request['length'])
            ->when($keyword, function ($query, $keyword) {
                return $query->where('nomor_spt', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->get();

        $dataCounter = DataStaffPerjalanan::select()
            ->when($keyword, function ($query, $keyword) {
                return $query->where('nomor_spt', 'like', '%' . $keyword . '%');
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
        return view('pages.spd.create', compact('dataStaff'));
    }

    public function store(Request $request)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Jabatan failed to create'];
            $create = Spd::create([
                'id_staff_perjalanan' => $request->id_staff_perjalanan,
                'nomor_spd' => $request->nomor_spd,
                'pejabat_pembuat_komitmen' => $request->pejabat_pembuat_komitmen,
                'tingkat_biaya_perjalanan_dinas' => $request->tingkat_biaya_perjalanan_dinas,
                'alat_angkutan' => $request->alat_angkutan,
                'keterangan' => $request->keterangan,
                'pada_tanggal' => $request->pada_tanggal,
            ]);
            if ($create) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Jabatan successfully created'];
            }
        } catch (\Exception $e) {
            $data = ['status' => false, 'code' => 'EC001', 'message' => $e->getMessage()];
        }
        if ($data['status']) {
            Alert::success('SPD Berhasil Dibuat', 'Berhasil');
            return redirect()->route('spd');
        } else {
            Alert::error('SPD Gagal Dibuat', 'Gagal');
            return redirect()->back();
        }
    }

    public function spdPDF($id)
    {
        $spd = DataStaffPerjalanan::with(['perjalanan.mak', 'staff.instansis', 'penandatangan', 'tujuan_perjalanan', 'spd'])->find($id);
        $pdf = \PDF::loadView('pages.spd.pdf', compact('spd'));
        return $pdf->stream();
    }
}
