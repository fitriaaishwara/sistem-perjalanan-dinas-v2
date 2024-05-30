<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\sbm_hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        return view('pages.master-data.sbm.hotel.index');
    }

    public function getData(Request $request)
    {
        $keyword = $request['searchkey'];

        $query = sbm_hotel::query()
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
                    ->limit(($request['length'] == -1) ? sbm_hotel::where('status', true)->count() : $request['length'])
                    ->get();

        $dataCounter = $query->count();

        $response = [
            'status'          => true,
            'draw'            => $request['draw'],
            'recordsTotal'    => sbm_hotel::where('status', true)->count(),
            'recordsFiltered' => $dataCounter,
            'data'            => $data,
        ];

        return $response;
    }

    public function store(Request $request)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Uang Harian failed to create'];
            $create = sbm_hotel::create([
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
            $data = ['status' => false, 'message' => 'SBM Hotel failed to be found'];
            $data = sbm_hotel::findOrFail($id);
            if ($data) {
                $data = ['status' => true, 'message' => 'SBM Hotel was successfully found', 'data' => $data];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;

    }

    public function update(Request $request)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'SBM Hotel failed to update'];

            $update = sbm_hotel::where('id', $request['id'])->update([
                'nominal' => $request['nominal'],
            ]);
            if ($update) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'SBM Hotel successfully updated'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;
    }

    public function destroy($id)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'SBM Hotel failed to delete'];
            $delete = sbm_hotel::where('id', $id)->update([
                'status' => false
            ]);
            if ($delete) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'SBM Hotel deleted successfully'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;
    }

}
