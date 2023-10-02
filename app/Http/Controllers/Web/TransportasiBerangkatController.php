<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\TransportasiBerangkat;
use Illuminate\Http\Request;

class TransportasiBerangkatController extends Controller
{
    public function store (Request $request)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Transportasi Berangkat failed to create'];
            $create = TransportasiBerangkat::create([
                'id_transportasi' => $request['id_transportasi'],
                'id_staff_peralanan' => $request['id_staff_peralanan'],
                'jenis_dokumen' => $request['jenis_dokumen'],

            ]);
            if ($create) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Transportasi Berangkat successfully created'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;
    }
}
