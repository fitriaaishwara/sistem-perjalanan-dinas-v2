<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\JabatanStruktural;
use Illuminate\Http\Request;

class JabatanStrukturalController extends Controller
{
    public function index()
    {

    }

    public function getData(Request $request)
    {
        $keyword = $request['searchkey'];

        $data = JabatanStruktural::select()
            ->offset($request['start'])
            ->limit(($request['length'] == -1) ? JabatanStruktural::where('status', true)->count() : $request['length'])
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->get();

        $dataCounter = JabatanStruktural::select()
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->count();
        $response = [
            'status'          => true,
            'draw'            => $request['draw'],
            'recordsTotal'    => JabatanStruktural::where('status', true)->count(),
            'recordsFiltered' => $dataCounter,
            'data'            => $data,
        ];
        return $response;
    }
}
