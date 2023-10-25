<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\NotaDinas;
use App\Models\Perjalanan;
use App\Models\Staff;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class NotaDinasController extends Controller
{
    public function index()
    {
        return view('pages.nota_dinas.index');
    }

    public function getData(Request $request)
    {
        $keyword = $request['searchkey'];

        $data = Perjalanan::select()
            ->with('mak', 'tujuan', 'nota_dinas')
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->get();

        $dataCounter = Perjalanan::select()
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->count();

        return DataTables::of($data)
                    ->make(true);
    }

    public function create($id)
    {
        $perjalanan = Perjalanan::find($id);
        $staff = Staff::where('status', true)->get();
        return view('pages.nota_dinas.create', compact('perjalanan', 'staff'));
    }

    public function edit($id)
    {
        $perjalanan = Perjalanan::with(['nota_dinas']) -> find($id);
        $notadinas = NotaDinas::with(['perjalanan', 'staff']) -> where('id_perjalanan', $id) -> first();
        $staff = Staff::where('status', true)->get();
        return view('pages.nota_dinas.edit', compact('perjalanan', 'staff', 'notadinas'));
    }

    public function pdf($id)
    {
        $perjalanan = Perjalanan::with(['nota_dinas', 'tujuan', 'mak', 'tujuan.staff', 'tujuan.tempatBerangkat', 'tujuan.tempatTujuan', 'tujuan.uploadLaporan', 'tujuan.uploadGallery'])->find($id);
        $data = NotaDinas::where('id_perjalanan', $id)->first();
        $staff = Staff::where('status', true)->get();
        //pdf
        if ($data) {
            $pdf = \PDF::loadView('pages.nota_dinas.pdf', compact('perjalanan', 'staff', 'data'));
            return $pdf->stream();
        } else {
            //return redirect with Alert
            //css for alert
            alert()->warning('', 'Data Not Found');
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Jabatan failed to create'];
            $create =  NotaDinas::create([
                'id_perjalanan' => $request->id_perjalanan,
                'id_staff_penandatangan' => $request->id_staff_penandatangan,
                'nomor_nota_dinas' => $request->nomor_nota_dinas,
                'yth' => $request->yth,
                'dari' => $request->dari,
                'perihal' => $request->perihal,
                'tanggal_nota_dinas' => $request->tanggal_nota_dinas,
                'isi_nota_dinas' => $request->isi_nota_dinas,
            ]);
            if ($create) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Jabatan successfully created'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }

        if ($data['status'] == true) {
            Alert::success('Success', $data['message']);
            return redirect()->route('nota-dinas');
        } else {
            Alert::error('Error', $data['message']);
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Jabatan failed to create'];
            $create =  NotaDinas::find($id) -> update([
                'id_perjalanan' => $request->id_perjalanan,
                'id_staff_penandatangan' => $request->id_staff_penandatangan,
                'nomor_nota_dinas' => $request->nomor_nota_dinas,
                'yth' => $request->yth,
                'dari' => $request->dari,
                'perihal' => $request->perihal,
                'tanggal_nota_dinas' => $request->tanggal_nota_dinas,
                'isi_nota_dinas' => $request->isi_nota_dinas,
            ]);

            if ($create) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Jabatan successfully edited'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }

        // return $data;
        return redirect() -> back() -> with('success', $data['message']);
    }

}
