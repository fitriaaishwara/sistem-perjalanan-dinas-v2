<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DataStaffPerjalanan;
use App\Models\Staff;
use Illuminate\Http\Request;

class KkpController extends Controller
{

    public function index()
    {
        return view('pages.master-data.kkp.index');
    }

    public function detail($id)
    {
        // $data = DataStaffPerjalanan::select()
        // ->with(['staff.golongans', 'staff.jabatans', 'staff.instansis', 'perjalanan', 'tujuan_perjalanan.uangHarian'])
        // ->where('id_perjalanan', $id)
        // ->where('status', true)->get();

        // return response()->json([
        //     'message' => 'success',
        //     'id_perjalanan' => $id,
        //     'data' => $data
        // ]);
        return view('pages.master-data.kkp.detail', ['id_detail' => $id]);
    }

    public function getData(Request $request, $id)
    {
        $keyword = $request['searchkey'];

        $data = DataStaffPerjalanan::select()
        ->with(['staff.golongans', 'staff.jabatans', 'staff.instansis', 'perjalanan', 'tujuan_perjalanan.uangHarian',
        'tujuan_perjalanan.tempatTujuan.hotel' => function ($query) {
            $query->where('id_golongan', function ($subquery) {
                $subquery->select('id_golongan')
                    ->from('staff');
            });
        },
        'tujuan_perjalanan.tempatTujuan.tiket' => function ($query) {
            $query->where('id_golongan', function ($subquery) {
                $subquery->select('id_golongan')
                    ->from('staff');
            });
        }
        ,
        'tujuan_perjalanan.tempatTujuan.translok' => function ($query) {
            $query->where('id_golongan', function ($subquery) {
                $subquery->select('id_golongan')
                    ->from('staff');
            });
        }])
        ->where('id_perjalanan', $id)
        ->when($keyword, function ($query, $keyword) {
            return $query->where('name', 'like', '%' . $keyword . '%');
        })
        ->where('status', true);
    //     return response()->json([
    //         'message' => 'success',
    //         'request' => $request->all(),
    //         'data' => $data
    //     ]);
    // }
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
            $text = '';

            if ($staff and !empty($staff->id_golongan)) {
                $text .= "<span><small>" . $staff->golongans->name . "</small></span><br>";
            }

            return $text;
        })
        ->addColumn('jenis', function($db) {
            $staff = Staff::where('id', $db->id_staff)->first();
            $text = "";

            if ($staff) {
                switch ($staff->jenis) {
                    case 0:
                        $text .= "<span class='badge badge-primary'><small>PNS</small></span><br>";
                        break;
                    case 1:
                        $text .= "<span class='badge badge-primary'><small>Non PNS</small></span><br>";
                        break;
                    case 2:
                        $text .= "<span class='badge badge-primary'><small>Magang</small></span><br>";
                        break;
                    default:
                        $text .= "<span><small>-</small></span><br>";
                        break;
                }
            } else {
                $text .= "<span><small>-</small></span><br>";
            }

            return $text;
        })
        ->addColumn('jabatan', function($db) {
            $staff = Staff::where('id', $db->id_staff)->first();
            $text = '';

            if ($staff and !empty($staff->id_jabatan)) {
                $text .= "<span><small>" . $staff->jabatans->name . "</small></span><br>";
            }

            return $text;
        })
        ->addColumn('instansi', function($db) {
            $staff = Staff::where('id', $db->id_staff)->first();
            $text = '';

            if ($staff and !empty($staff->id_instansi)) {
                $text .= "<span><small>" . $staff->instansis->name . "</small></span><br>";
            }

            return $text;
        })
        ->rawColumns(['nama', 'golongan', 'jenis', 'jabatan', 'instansi'])
        ->make(true);
    }


    public function kkpPDF($id)
    {
        $data = DataStaffPerjalanan::with([
            'staff.golongans',
            'staff.jabatans',
            'staff.instansis',
            'perjalanan',
            'tujuan_perjalanan.uangHarian',
            'tujuan_perjalanan.tempatTujuan.hotel' => function ($query) {
                $query->where('id_golongan', function ($subquery) {
                    $subquery->select('id_golongan')
                        ->from('staff');
                });
            },
            'tujuan_perjalanan.tempatTujuan.tiket' => function ($query) {
                $query->where('id_golongan', function ($subquery) {
                    $subquery->select('id_golongan')
                        ->from('staff');
                });
            }
            ,
            'tujuan_perjalanan.tempatTujuan.translok' => function ($query) {
                $query->where('id_golongan', function ($subquery) {
                    $subquery->select('id_golongan')
                        ->from('staff');
                });
            }
        ])
        ->where('status', true)
        ->find($id);
        $pdf = \PDF::loadView('pages.master-data.kkp.pdf', compact('data'));
        // return response()->json([
        //     'hotel' => $data->tujuan_perjalanan[0]->tempatTujuan->hotel[0]->nominal,
        //     'tiket' => $data->tujuan_perjalanan[0]->tempatTujuan->tiket[0]->nominal,
        //     'translok' => $data->tujuan_perjalanan[0]->tempatTujuan->translok[0]->nominal,
        //     'data' => $data
        // ]);
        // return view('pages.master-data.kkp.pdf', ['data' => $data]);
        return $pdf->stream();
    }
}
