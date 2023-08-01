<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Mak;
use Illuminate\Http\Request;

class MakController extends Controller
{
    public function index()
    {
        return view('pages.master.mak.index');
    }

    public function getData(Request $request)
    {
        $keyword = $request['searchkey'];

        $data = Mak::select()
            ->offset($request['start'])
            ->limit(($request['length'] == -1) ? Mak::where('status', true)->count() : $request['length'])
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->get();

        $dataCounter = Mak::select()
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->count();
        $response = [
            'status'          => true,
            'draw'            => $request['draw'],
            'recordsTotal'    => Mak::where('status', true)->count(),
            'recordsFiltered' => $dataCounter,
            'data'            => $data,
        ];
        return $response;
    }
    public function store(Request $request)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Mata Anggaran Akun failed to create'];
            $create = Mak::create([
                'kode_mak' => $request['kode_mak'],
                'saldo_awal_pagu' => $request['saldo_awal_pagu'],
                'saldo_pagu' => $request['saldo_pagu'],
                'description' => $request['description']
            ]);
            if ($create) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Mata Anggaran Akun successfully created'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }

        return $data;
    }
    public function show($id)
    {
        try {
            $data = ['status' => false, 'message' => 'Mata Anggaran Akun failed to be found'];
            $data = Mak::findOrFail($id);
            if ($data) {
                $data = ['status' => true, 'message' => 'Mata Anggaran Akun was successfully found', 'data' => $data];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;
    }
    public function update(Request $request)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Mata Anggaran Akun failed to update'];

            $update = Mak::where('id', $request['id'])->update([
                'name'        => ucwords($request['name']),
                'description' => $request['description']
            ]);
            if ($update) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Mata Anggaran Akun successfully updated'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;
    }
    public function destroy($id)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Mata Anggaran Akun failed to delete'];
            $delete = Mak::where('id', $id)->update([
                'status' => false
            ]);
            if ($delete) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Mata Anggaran Akun deleted successfully'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;
    }
}
