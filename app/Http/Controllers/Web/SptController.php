<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DataStaffPerjalanan;
use App\Models\Spt;
use App\Models\Staff;
use App\Models\Tujuan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SptController extends Controller
{
    public function index()
    {
        return view('pages.spt.index');
    }

    public function getData(Request $request)
    {
        $keyword = $request['searchkey'];

        $data = Tujuan::select()
            ->with(['perjalanan', 'spt', 'staff', 'staff.staff'])
            ->offset($request['start'])
            ->limit(($request['length'] == -1) ? Tujuan::where('status', true)->count() : $request['length'])
            ->when($keyword, function ($query, $keyword) {
                return $query->where('nomor_spt', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->get();

        $dataCounter = Tujuan::select()
            ->when($keyword, function ($query, $keyword) {
                return $query->where('nomor_spt', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->count();
        $response = [
            'status'          => true,
            'draw'            => $request['draw'],
            'recordsTotal'    => Tujuan::where('status', true)->count(),
            'recordsFiltered' => $dataCounter,
            'data'            => $data,
        ];
        return $response;
    }

    public function create($id)
    {
        $tujuan = Tujuan::with(['perjalanan', 'spt', 'staff', 'staff.staff'])->find($id);
        $staff = Staff::where('status', true)->get();
        $dataStaff= DataStaffPerjalanan::with(['staff','perjalanan', 'tujuan_perjalanan'])->where('id_tujuan_perjalanan', $tujuan->id)->get();
        return view('pages.spt.create', compact('tujuan', 'staff', 'dataStaff'));
    }

    public function store(Request $request)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'SPT failed to create'];
            $create = Spt::create([
                'id_tujuan' => $request->id_tujuan,
                'id_staff_penandatangan' => $request->id_staff_penandatangan,
                'nomor_spt' => $request->nomor_spt,
                'dikeluarkan_tanggal' => $request->dikeluarkan_tanggal,
                // 'id_staff' => $request->toArray(['id_staff']),
            ]);
            if ($create) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Jabatan successfully created'];
            }
        } catch (\Exception $e) {
            $data = ['status' => false, 'code' => 'EC001', 'message' => $e->getMessage()];
        }
        if ($data['status']) {
            Alert::success('SPT Berhasil Dibuat', 'Berhasil');
            return redirect()->route('spt');
        } else {
            Alert::error('SPT Gagal Dibuat', 'Gagal');
            return redirect()->back();
        }
    }

    public function sptPDF($id)
    {
        $tujuan = Tujuan::with(['perjalanan', 'spt', 'staff', 'staff.staff'])->find($id);
        $spt = Spt::where('id_tujuan', $id)->first();
        $dataStaff= DataStaffPerjalanan::with(['staff','perjalanan', 'tujuan_perjalanan'])->where('id_tujuan_perjalanan', $tujuan->id)->get();

        //pdf
        if ($spt) {
            $pdf = \PDF::loadView('pages.spt.pdf', compact('tujuan', 'dataStaff', 'spt'));
            return $pdf->stream();
        } else {
            //return redirect with Alert
            //css for alert
            Alert::error('SPT Tidak Ditemukan', 'Buat SPT Terlebih Dahulu');
            return redirect()->back();
        }
    }
}
