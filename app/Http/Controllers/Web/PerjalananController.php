<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Perjalanan;
use App\Models\Province;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PerjalananController extends Controller
{
    public function index()
    {
        return view('pages.perjalanan.perjalanan.index');
    }

    public function staff(Request $request)
    {
        $staff = \App\Models\Staff::select('id as id', 'name as text', 'nip')->get();

        if ($request->has('q')) {
            $staff = \App\Models\Staff::select('id as id', 'name as text', 'nip')
                ->where('name', 'like', '%' . $request->get('q') . '%')
                ->get();
        }

        return response()->json(['staff' => $staff]);
    }

    public function staff_by_id($id)
    {
        $staff = \App\Models\Staff::where('id', $id)->first();

        return response()->json(['staff' => $staff]);
    }

    public function getData(Request $request)
{
    $keyword = $request['searchkey'];


        $data = Perjalanan::select()
            ->with('mak', 'tujuan.tempatTujuan')
            ->where('status', true)
            ->when($keyword, function ($query, $keyword) {
                return $query->where(function ($query) use ($keyword) {
                    $query
                        ->whereHas('mak', function ($query) use ($keyword) {
                            $query->where('mak.kode_mak', 'like', '%' . $keyword . '%');
                        })
                        ->orWhere('perihal_perjalanan', 'like', '%' . $keyword . '%');
                });
            })
            ->get();
        // return response()->json($data);
        // $dataCounter = Perjalanan::select()
        //     ->when($keyword, function ($query, $keyword) {
        //         return $query->where('name', 'like', '%' . $keyword . '%');
        //     })
        //     ->where('status', true)
        //     ->count();

        return DataTables::of($data)
                    ->make(true);

    $data = Perjalanan::select()
        ->with('mak', 'tujuan.tempatTujuan', 'log_status_perjalanan')
        ->where('status', true);

    if ($keyword) {
        $data->where('name', 'like', '%' . $keyword . '%');

    }

    $data->whereHas('log_status_perjalanan', function ($query) {
        $query->where('status_perjalanan', 'Disetujui');
    });

    $data = $data->get();

    $dataCounter = Perjalanan::when($keyword, function ($query, $keyword) {
            return $query->where('name', 'like', '%' . $keyword . '%');
        })
        ->where('status', true)
        ->whereHas('log_status_perjalanan', function ($query) {
            $query->where('status_perjalanan', 'Disetujui');
        })
        ->count();

    return DataTables::of($data)
                ->make(true);
}

    public function getDataProvinsi(Request $request)
    {
        $keyword = $request['searchkey'];

        $data = Province::select()
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->get();

        $dataCounter = Province::select()
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->count();

        return DataTables::of($data)
            ->make(true);
    }
}
