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

        $data = sbm_hotel::select()
            ->with('province')
            ->offset($request['start'])
            ->limit(($request['length'] == -1) ? sbm_hotel::where('status', true)->count() : $request['length'])
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->get();

        $dataCounter = sbm_hotel::select()
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->count();
        $response = [
            'status'          => true,
            'draw'            => $request['draw'],
            'recordsTotal'    => sbm_hotel::where('status', true)->count(),
            'recordsFiltered' => $dataCounter,
            'data'            => $data,
        ];
        return $response;
    }
}
