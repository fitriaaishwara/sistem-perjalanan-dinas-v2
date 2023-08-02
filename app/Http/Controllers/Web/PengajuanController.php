<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function index()
    {
        return view('pages.master.pengajuan.admin.index');
    }

    public function create()
    {
        return view('pages.master.pengajuan.admin.create');
    }

    function stores(Request $request) {
        dd($request->all());
    }
}
