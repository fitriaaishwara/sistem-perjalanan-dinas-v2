<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Perjalanan;
use App\Models\Tujuan;
use Illuminate\Http\Request;

class TujuanController extends Controller
{
    public function getData(Request $request)
    {
        $keyword = $request['searchkey'];
        $data = Tujuan::select()
            ->with('perjalanan')
            ->offset($request['start'])
            ->limit(($request['length'] == -1) ? Tujuan::where('status', true)->count() : $request['length'])
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->get();

        $dataCounter = Tujuan::select()
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
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

    public function getTujuanByIdPerjalanan(Request $request, $id)
    {
        $perjalanan = Perjalanan::findOrFail($id);
        // dd($perjalanan);
        $keyword = $request['searchkey'];

            $data = ['status' => false, 'message' => 'Tujuan failed to be found'];
            $data = Tujuan::select()
                ->where('id_perjalanan', $perjalanan)
                ->offset($request['start'])
                ->limit(($request['length'] == -1) ? Tujuan::where('status', true)->count() : $request['length'])
                ->when($keyword, function ($query, $keyword) {
                    return $query->where('name', 'like', '%' . $keyword . '%');
                })
                ->where('status', true)
                ->get();
            $dataCounter = Tujuan::select()
                ->when($keyword, function ($query, $keyword) {
                    return $query->where('name', 'like', '%' . $keyword . '%');
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

    public function show($id)
    {
        try {
            $data = ['status' => false, 'message' => 'Tujuan failed to be found'];
            $data = Tujuan::findOrFail($id);
            if ($data) {
                $data = ['status' => true, 'message' => 'Tujuan was successfully found', 'data' => $data];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }

        return $data;
    }

    public function destroy($id)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Jabatan failed to delete'];
            $delete = Tujuan::where('id', $id)->update([
                'status' => false
            ]);
            if ($delete) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Jabatan deleted successfully'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;
    }

    public function store(Request $request)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Tujuan failed to be created'];
            $create = Tujuan::create([
                'id_perjalanan' => $request->id_perjalanan,
                'tempat_berangkat' => $request->tempat_berangkat,
                'tempat_tujuan' => $request->tempat_tujuan,
                'tanggal_berangkat' => $request->tanggal_berangkat,
                'tanggal_pulang' => $request->tanggal_pulang,
                'tanggal_tiba' => $request->tanggal_tiba,
                'lama_perjalanan' => $request->lama_perjalanan,
            ]);
            if ($create) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Tujuan successfully created'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }

        return $data;
    }

    public function update(Request $request)
    {
        // try {
            // $data = ['status' => false, 'code' => 'EC001', 'message' => 'Tujuan failed to be updated'];
            $update = Tujuan::where('id', $request['id'])->update([
                'tempat_berangkat' => $request['tempat_berangkat'], // $request['name'
                'tempat_tujuan' => $request['tempat_tujuan'], // $request['description
                'tanggal_berangkat' => $request['tanggal_berangkat'], // $request['status'
                'tanggal_pulang' => $request['tanggal_pulang'], // $request['status'
                'tanggal_tiba' => $request['tanggal_tiba'], // $request['status'
                'lama_perjalanan' => $request['lama_perjalanan'] // $request['status'
            ]);
        //     if ($update) {
        //         $data = ['status' => true, 'code' => 'SC001', 'message' => 'Tujuan successfully updated'];
        //     }
        // } catch (\Exception $ex) {
        //     $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        // }

        dd($update);

        // return $data;
    }
}
