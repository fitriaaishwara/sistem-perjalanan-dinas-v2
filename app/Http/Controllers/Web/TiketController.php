<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\sbm_tiket;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    public function index()
    {
        return view('pages.master-data.sbm.tiket.index');
    }

    public function getData(Request $request)
    {
        $keyword = $request['searchkey'];

        $query = sbm_tiket::query()
                ->with('province', 'golongan', 'jabatan_struktural')
                ->where('status', true)
                ->orderBy('province_id')
                ->orderBy('id_golongan')
                ->orderBy('id_jabatan_struktural');

        if ($keyword) {
            $query->whereHas('province', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->orWhereHas('golongan', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->orWhereHas('jabatan_struktural', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');

            })->orWhere('nominal', 'like', '%' . $keyword . '%');
        }

        $data = $query->offset($request['start'])
                    ->limit(($request['length'] == -1) ? sbm_tiket::where('status', true)->count() : $request['length'])
                    ->get();

        $dataCounter = $query->count();

        $response = [
            'status'          => true,
            'draw'            => $request['draw'],
            'recordsTotal'    => sbm_tiket::where('status', true)->count(),
            'recordsFiltered' => $dataCounter,
            'data'            => $data,
        ];

        return $response;
    }

    public function store(Request $request)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Uang Harian failed to create'];
            $create = sbm_tiket::create([
                'nominal' => $request['nominal'],
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
            $data = sbm_tiket::findOrFail($id);
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

            $update = sbm_tiket::where('id', $request['id'])->update([
                'nominal' => $request['nominal']
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
            $delete = sbm_tiket::where('id', $id)->update([
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
