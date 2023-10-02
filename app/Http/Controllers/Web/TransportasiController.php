<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Transportasi;
use Illuminate\Http\Request;

class TransportasiController extends Controller
{
    public function getData(Request $request)
    {
        $keyword = $request['searchkey'];

        $data = Transportasi::select()
            ->with('transportasi_berangkat')
            ->offset($request['start'])
            ->limit(($request['length'] == -1) ? Transportasi::where('status', true)->count() : $request['length'])
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->get();

        $dataCounter = Transportasi::select()
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->count();
        $response = [
            'status'          => true,
            'draw'            => $request['draw'],
            'recordsTotal'    => Transportasi::where('status', true)->count(),
            'recordsFiltered' => $dataCounter,
            'data'            => $data,
        ];
        return $response;
    }
}
