<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Dashboard', ['only' => ['index']]);
    }

    public function index()
    {
        return view('pages.dashboard.index');
    }
}
