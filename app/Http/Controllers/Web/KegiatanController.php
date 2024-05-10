<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Perjalanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class KegiatanController extends Controller
{
    public function getData(Request $request)
    {
        $keyword = $request['searchkey'];
        $data = Kegiatan::select()
            ->with('perjalanan')
            // ->offset($request['start'])
            // ->limit(($request['length'] == -1) ? Tujuan::where('status', true)->count() : $request['length'])
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->get();

        $dataCounter = Kegiatan::select()
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->count();

        return DataTables::of($data)
                    ->make(true);
    }

    public function getKegiatanByIdPerjalanan(Request $request, $id)
    {
        $perjalanan = Perjalanan::findOrFail($id);

            $data = ['status' => false, 'message' => 'Tujuan failed to be found'];
            $data = Kegiatan::where('id_perjalanan', $id)
                ->where('status', true)
                ->get();

            return DataTables::of($data)
                ->make(true);
    }

    public function show($id)
    {
        try {
            $data = ['status' => false, 'message' => 'Kegiatan failed to be found'];
            $data = Kegiatan::with('perjalanan')->findOrFail($id);
            if ($data) {
                $data = ['status' => true, 'message' => 'Kegiatan was successfully found', 'data' => $data];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }

        return $data;
    }

    public function store(Request $request)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Kegiatan failed to be created'];
            $create = Kegiatan::create([
                'id_perjalanan' => $request->id_perjalanan,
                'kegiatan' => $request->kegiatan,
                'created_by' => Auth::user()->id,
            ]);

            if ($create) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Kegiatan successfully created'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }

        return $data;
    }

    public function update(Request $request)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Kegiatan failed to update'];

            $update = Kegiatan::where('id', $request['id'])->update([
                'id_perjalanan' => $request->id_perjalanan,
                'kegiatan' => $request->kegiatan,
            ]);
            if ($update) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Kegiatan successfully updated'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;
    }

    public function destroy($id)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Kegiatan failed to delete'];
            $delete = Kegiatan::where('id', $id)->update([
                'status' => false
            ]);
            if ($delete) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Kegiatan deleted successfully'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;
    }


}
