<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\UangHarian;
use Illuminate\Http\Request;

class UangHarianController extends Controller
{
    public function index()
    {
        return view('pages.master-data.sbm.uang_harian.index');
    }

    public function getData(Request $request)
    {
        $keyword = $request['searchkey'];

        $data = UangHarian::select()
            ->with('province')
            ->offset($request['start'])
            ->limit(($request['length'] == -1) ? UangHarian::where('status', true)->count() : $request['length'])
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->get();

        $dataCounter = UangHarian::select()
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->count();
        $response = [
            'status'          => true,
            'draw'            => $request['draw'],
            'recordsTotal'    => UangHarian::where('status', true)->count(),
            'recordsFiltered' => $dataCounter,
            'data'            => $data,
        ];
        return $response;
    }
    public function store(Request $request)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Uang Harian failed to create'];
            $create = UangHarian::create([
                'name'        => ucwords($request['name']),
                'description' => $request['description']
            ]);
            if ($create) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Uang Harian successfully created'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }

        return $data;
    }
    public function show($id)
    {
        try {
            $data = ['status' => false, 'message' => 'Uang Harian failed to be found'];
            $data = UangHarian::findOrFail($id);
            if ($data) {
                $data = ['status' => true, 'message' => 'Uang Harian was successfully found', 'data' => $data];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;
    }
    public function update(Request $request)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Uang Harian failed to update'];

            $update = UangHarian::where('id', $request['id'])->update([
                'name'        => ucwords($request['name']),
                'description' => $request['description']
            ]);
            if ($update) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Uang Harian successfully updated'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;
    }
    public function destroy($id)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Uang Harian failed to delete'];
            $delete = UangHarian::where('id', $id)->update([
                'status' => false
            ]);
            if ($delete) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Uang Harian deleted successfully'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;
    }
}
