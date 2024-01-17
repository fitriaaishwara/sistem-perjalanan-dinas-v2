<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\LogStatusPerjalanan;
use Illuminate\Http\Request;

class DetailStatusController extends Controller
{
    public function index()
    {
        return view('pages.master.pengajuan.detail_status.index');
    }

    public function getData(Request $request)
    {
        $keyword = $request['searchkey'];

        $data = LogStatusPerjalanan::where('id_perjalanan', $request['id_perjalanan'])
            ->offset($request['start'])
            ->limit(($request['length'] == -1) ? LogStatusPerjalanan::where('id_perjalanan', $request['id_perjalanan'])->count() : $request['length'])
            ->when($keyword, function ($query, $keyword) {
                return $query->where('status_perjalanan', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->get();

        $dataCounter = LogStatusPerjalanan::where('id_perjalanan', $request['id_perjalanan'])
            ->when($keyword, function ($query, $keyword) {
                return $query->where('status_perjalanan', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->count();

        $response = [
            'status'          => true,
            'draw'            => $request['draw'],
            'recordsTotal'    => LogStatusPerjalanan::where('id_perjalanan', $request['id_perjalanan'])->count(),
            'recordsFiltered' => $dataCounter,
            'data'            => $data,
        ];

    }
}
