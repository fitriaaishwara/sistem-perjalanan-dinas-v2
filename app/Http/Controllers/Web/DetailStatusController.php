<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\LogStatusPerjalanan;
use App\Models\Perjalanan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DetailStatusController extends Controller
{
    public function index($id)
    {
        $perjalanan = Perjalanan::find($id);
        return view('pages.master.pengajuan.detail_status.index', compact('perjalanan'));
    }

    public function getData(Request $request, $id)
    {
        $perjalanan = Perjalanan::findOrFail($id);

        $data = ['status' => false, 'message' => 'Log Status Perjalanan failed to be found'];
        $data = LogStatusPerjalanan::where('id_perjalanan', $id)
            ->where('status', true)
            ->get();

        return DataTables::of($data)
            ->make(true);



    }
}
