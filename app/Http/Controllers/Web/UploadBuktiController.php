<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DataStaffPerjalanan;
use App\Models\TransportasiBerangkat;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UploadBuktiController extends Controller
{
    public function index()
    {
        return view('pages.upload.index');
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
        $dataStaff = DataStaffPerjalanan::findOrFail($id);
        // dd($dataStaff);
        return view('pages.upload.create', compact('dataStaff'));
    }

    public function getUploadByIdBerangkat(Request $request, $id)
    {
        $dataStaff = DataStaffPerjalanan::findOrFail($id);

        $data = ['status' => false, 'message' => 'Tujuan failed to be found'];
        $data = TransportasiBerangkat::where('id_staff_perjalanan', $id)
            ->where('status', true)
            ->get();

        $dataCounter = TransportasiBerangkat::where('id_staff_perjalanan', $id)
            ->where('status', true)
            ->count();

        $response = [
            'status'          => true,
            'draw'            => $request['draw'],
            'recordsTotal'    => TransportasiBerangkat::where('id_staff_perjalanan', $id)->count(),
            'recordsFiltered' => $dataCounter,
            'data'            => $data,
        ];
        return $response;
    }

    public function store(Request $request)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'File failed to create'];
            $create = TransportasiBerangkat::create([
                'id_transportasi'      => $request['id_transportasi'],
                'id_staff_perjalanan'  => $request['id_staff_perjalanan'],
                'deskripsi_file'       => $request['deskripsi_file'],
                'nominal'              => $request['nominal'],
                'ukuran_file'          => $request['ukuran_file'],
            ]);
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }

        return $data;
    }
}
