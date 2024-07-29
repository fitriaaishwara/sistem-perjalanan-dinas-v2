<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\StatusPerjalanan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StatusPerjalananController extends Controller
{
    public function index()
    {
        return view('status-perjalanan.index');
    }

    public function create()
    {
        return view('status-perjalanan.create');
    }

    public function getData(Request $request) {
        $keyword = $request['searchkey'];
        $data = StatusPerjalanan::select()
            ->when($keyword, function ($query, $keyword) {
                return $query->where('status_perjalanan', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->orderByRaw('CAST(status_perjalanan AS UNSIGNED) ASC')  // Cast the column to an integer for sorting
            ->get();

        $dataCounter = StatusPerjalanan::select()
            ->when($keyword, function ($query, $keyword) {
                return $query->where('status_perjalanan', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->count();

        return DataTables::of($data)
                    ->make(true);
    }


}
