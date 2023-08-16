<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DataStaffPerjalanan;
use Illuminate\Http\Request;

class DataStaffPerjalananDinasController extends Controller
{
    public function getData(Request $request)
    {
        $keyword = $request ['searchkey'];

        $data = DataStaffPerjalanan::select()
            ->with('perjalanan', 'staff')
            ->offset($request['start'])
            ->limit(($request['length'] == -1) ? DataStaffPerjalanan::where('status', true)->count() : $request['length'])
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->get();

        $dataCounter = DataStaffPerjalanan::select()
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->count();
        $response = [
            'status'          => true,
            'draw'            => $request['draw'],
            'recordsTotal'    => DataStaffPerjalanan::where('status', true)->count(),
            'recordsFiltered' => $dataCounter,
            'data'            => $data,
        ];
        return $response;
    }
}
