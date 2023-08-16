<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotaDinasController extends Controller
{
    public function index()
    {
        return view('pages.nota_dinas.index');
    }


}
