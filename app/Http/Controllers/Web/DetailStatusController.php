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
        return view('pages.perjalanan.pengajuan.detail_status.index', compact('perjalanan'));
    }

    public function getData(Request $request, $id)
    {
        $perjalanan = Perjalanan::findOrFail($id);

        $data = LogStatusPerjalanan::where('id_perjalanan', $id)
            ->with('status_perjalanan', 'user')
            ->where('status', true)
            ->orderBy('created_at', 'desc') // Sort by created_at timestamp in descending order
            ->get();

        return DataTables::of($data)
            ->make(true);
    }
}
