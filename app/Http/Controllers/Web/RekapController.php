<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RekapController extends Controller
{
    public function index()
    {
        return view('pages.master-data.rekap_data.index');
    }
}
