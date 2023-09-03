<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DataStaffPerjalanan;
use App\Models\Staff;
use Illuminate\Http\Request;

class DataStaffPerjalananDinasController extends Controller
{
    public function getData(Request $request)
    {
        $keyword = $request ['searchkey'];

        $data = DataStaffPerjalanan::select()
            ->with('perjalanan', 'staff')
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->where('status', true);

        // $dataCounter = DataStaffPerjalanan::select()
        //     ->when($keyword, function ($query, $keyword) {
        //         return $query->where('name', 'like', '%' . $keyword . '%');
        //     })
        //     ->where('status', true)
        //     ->count();
        // $response = [
        //     'status'          => true,
        //     'draw'            => $request['draw'],
        //     'recordsTotal'    => DataStaffPerjalanan::where('status', true)->count(),
        //     'recordsFiltered' => $dataCounter,
        //     'data'            => $data,
        // ];
        // return $response;

        return datatables($data)
            ->addIndexColumn()
            ->addColumn('nama', function($db) {
                $staff = Staff::where('id', $db->id_staff)->first();
                $text = "";

                if ($staff) {
                    $text .= "<b>" . strtoupper($staff->name) . "</b><br>";
                    $text .= "<span class='text-secondary'><small>" . $staff->nip . "</small></span>";
                }

                return $text;
            })
            ->addColumn('golongan', function($db) {
                $staff = Staff::where('id', $db->id_staff)->first();
            })
            ->addColumn('jenis', function($db) {
                $staff = Staff::where('id', $db->id_staff)->first();
                $text = '';

                if ($staff and !empty($staff->jenis)) {
                    switch ($staff->jenis) {
                        case 1:
                            $text .= "<span class='badge badge-success'><small>PNS</small></span><br>";
                            break;

                        case 2:
                            $text .= "<span class='badge badge-success'><small>Non PNS</small></span><br>";
                            break;

                        case 3:
                            $text .= "<span class='badge badge-primary'><small>Lainnya</small></span><br>";
                            break;
                        
                        default:
                            $text .= "<span class='badge badge-danger'><small>Unknown</small></span><br>";
                            break;
                    }
                }

                return $text;
            })
            ->addColumn('jabatan', function($db) {
                $staff = Staff::where('id', $db->id_staff)->first();
                $text = '';

                if ($staff and !empty($staff->id_jabatan)) {
                    # code...
                }

                return $text;
            })
            ->addColumn('instansi', function($db) {
                $staff = Staff::where('id', $db->id_staff)->first();
                $text = '';

                if ($staff and !empty($staff->id_instansi)) {
                    # code...
                }

                return $text;
            })
            ->rawColumns(['nama', 'golongan', 'jenis', 'jabatan', 'instansi'])
            ->make(true);
    }
}
