<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Perjalanan;
use App\Models\PerjalananDinas;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PengajuanController extends Controller
{
    public function index()
    {
        return view('pages.master.pengajuan.admin.index');
    }

    public function create()
    {
        return view('pages.master.pengajuan.admin.create');
    }

    public function stores(Request $request) {
        dd($request->all());
    }

    public function store(Request $request) {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Perjalanan failed to create'];
            $create = Perjalanan::create([
                'id_mak' => $request['id_mak'],
                'perihal_perjalanan' => $request['perihal_perjalanan'],
                'estimasi_biaya' => $request['estimasi_biaya'],
                'description' => $request['description']
            ]);
            if ($create) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Perjalanan successfully created'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }

        //if else return with Alert Sweet Alert and redirect to route or view or url page
        if ($data['status'] == true) {
            Alert::success('Success', $data['message']);
            return redirect()->route('pengajuan/createId', ['id' => $create->id]);
        } else {
            Alert::error('Error', $data['message']);
            return redirect()->back();
        }
    }

    public function edit($id)
    {

        $perjalanan = Perjalanan::findOrFail($id);

        try {
            $data = ['status' => false, 'message' => 'Jabatan failed to be found'];
            $data = Perjalanan::findOrFail($id);
            if ($data) {
                $data = ['status' => true, 'message' => 'Jabatan was successfully found', 'data' => $data];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }

        return view('pages.master.pengajuan.admin.edit', compact('data','perjalanan'));
    }

    public function createId($id)
    {

        $perjalanan = Perjalanan::findOrFail($id);

        try {
            $data = ['status' => false, 'message' => 'Jabatan failed to be found'];
            $data = Perjalanan::findOrFail($id);
            if ($data) {
                $data = ['status' => true, 'message' => 'Jabatan was successfully found', 'data' => $data];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }

        return view('pages.master.pengajuan.admin.tujuan', compact('data','perjalanan'));
    }

    public function getData(Request $request)
    {
        $keyword = $request['searchkey'];

        $data = Perjalanan::select()
            ->with('mak', 'tujuan')
            ->offset($request['start'])
            ->limit(($request['length'] == -1) ? Perjalanan::where('status', true)->count() : $request['length'])
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

        $response = [
            'status'          => true,
            'draw'            => $request['draw'],
            'recordsTotal'    => Perjalanan::where('status', true)->count(),
            'recordsFiltered' => $dataCounter,
            'data'            => $data,
        ];
        return $response;
    }

}
