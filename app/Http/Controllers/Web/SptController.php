<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Spt;
use App\Models\Staff;
use App\Models\Tujuan;
use Illuminate\Http\Request;

class SptController extends Controller
{
    public function index()
    {
        return view('pages.spt.index');
    }

    public function getData(Request $request)
    {
        $keyword = $request['searchkey'];

        $data = Tujuan::select()
            ->with(['perjalanan', 'spt', 'staff', 'staff.staff'])
            ->offset($request['start'])
            ->limit(($request['length'] == -1) ? Tujuan::where('status', true)->count() : $request['length'])
            ->when($keyword, function ($query, $keyword) {
                return $query->where('nomor_spt', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->get();

        $dataCounter = Tujuan::select()
            ->when($keyword, function ($query, $keyword) {
                return $query->where('nomor_spt', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->count();
        $response = [
            'status'          => true,
            'draw'            => $request['draw'],
            'recordsTotal'    => Tujuan::where('status', true)->count(),
            'recordsFiltered' => $dataCounter,
            'data'            => $data,
        ];
        return $response;
    }

    public function create()
    {
        $staff = Staff::where('status', true)->get();
        return view('pages.spt.create', compact('staff'));
    }
}
