<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AkomodasiHotel;
use App\Models\DataStaffPerjalanan;
use App\Models\TransportasiBerangkat;
use App\Models\TransportasiPulang;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class UploadBuktiController extends Controller
{
    public function index()
    {
        return view('pages.pra-perjalanan.bukti_invoice.index');
    }

    public function getData(Request $request)
    {
        $keyword = $request['searchkey'];
        $userRole = Auth::user()->roles->pluck('name')[0];

        $query = DataStaffPerjalanan::select()
            ->with(['perjalanan.mak', 'staff.instansis', 'penandatangan', 'tujuan_perjalanan.tempatTujuan', 'spd', 'perjalanan.kegiatan', 'staff'])
            ->whereHas('perjalanan.status_perjalanan', function ($query) {
                $query->where('id_status', '=', '2');
            })
            ->where('status', true);

        // If the user is not a super admin, filter data based on user's ID
        if ($userRole != 'Super Admin') {
            $query->whereHas('staff', function ($query) {
                $query->where('id_user', Auth::id());
            });
        }

        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->whereHas('staff', function ($query) use ($keyword) {
                    $query->where('name', 'like', '%' . $keyword . '%');
                })
                ->orWhereHas('staff', function ($query) use ($keyword) {
                    $query->where('nip', 'like', '%' . $keyword . '%');
                })
                ->orWhereHas('perjalanan', function ($query) use ($keyword) {
                    $query->whereHas('mak', function ($query) use ($keyword) {
                        $query->where('kode_mak', 'like', '%' . $keyword . '%');
                    });
                })
                ->orWhereHas('perjalanan', function ($query) use ($keyword) {
                    $query->whereHas('kegiatan', function ($query) use ($keyword) {
                        $query->where('kegiatan', 'like', '%' . $keyword . '%');
                    });
                })
                ->orWhereHas('tujuan_perjalanan', function ($query) use ($keyword) {
                    $query->whereHas('tempatTujuan', function ($query) use ($keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%');
                    });
                })
                ->orWhereHas('tujuan_perjalanan', function ($query) use ($keyword) {
                    $query->where('tanggal_berangkat', 'like', '%' . $keyword . '%')
                          ->orWhere('tanggal_pulang', 'like', '%' . $keyword . '%');
                });
            });
        }

        $data = $query->offset($request['start'])
                      ->limit(($request['length'] == -1) ? DataStaffPerjalanan::where('status', true)->count() : $request['length'])
                      ->get();
                      $dataCounter = $query->count();

                      $response = [
                          'status'          => true,
                          'draw'            => $request->input('draw'),
                          'recordsTotal'    => DataStaffPerjalanan::where('status', true)->count(),
                          'recordsFiltered' => $dataCounter,
                          'data'            => $data,
                      ];

                      return $response;
    }

    public function create($id)
    {
        $dataStaff = DataStaffPerjalanan::findOrFail($id);
        // dd($dataStaff);
        return view('pages.pra-perjalanan.bukti_invoice.create', compact('dataStaff'));
    }

    public function getUploadByIdBerangkat(Request $request, $id)
    {
        $dataStaff = DataStaffPerjalanan::findOrFail($id);

        $data = ['status' => false, 'message' => 'Tujuan failed to be found'];
        $data = TransportasiBerangkat::where('id_staff_perjalanan', $id)
            ->with(['transportasi', 'staff'])
            ->where('status', true)
            ->get();

        $dataCounter = TransportasiBerangkat::where('id_staff_perjalanan', $id)
            ->where('status', true)
            ->count();

        return datatables($data)
            ->addIndexColumn()
            ->editColumn('file_path', function($db) {
                $text = "";
                if ($db->file_path) {
                    $text .= "<a href='" . route('transportasi-berangkat/pdf', $db->id) . "' class='' target='_blank'>";
                    $text .= $db->deskripsi_file . '.pdf';
                    $text .= "</a>";
                }
                return $text;
            })
            ->rawColumns(['file_path'])
            ->make(true);
    }

    public function getUploadByIdPulang(Request $request, $id)
    {
        $dataStaff = DataStaffPerjalanan::findOrFail($id);

        $data = ['status' => false, 'message' => 'Tujuan failed to be found'];
        $data = TransportasiPulang::where('id_staff_perjalanan', $id)
            ->with(['transportasi', 'staff'])
            ->where('status', true)
            ->get();

        $dataCounter = TransportasiPulang::where('id_staff_perjalanan', $id)
            ->where('status', true)
            ->count();

        return datatables($data)
            ->addIndexColumn()
            ->editColumn('file_path', function($db) {
                $text = "";
                if ($db->file_path) {
                    $text .= "<a href='" . route('transportasi-pulang/pdf', $db->id) . "' class='' target='_blank'>";
                    $text .= $db->deskripsi_file . '.pdf';
                    $text .= "</a>";
                }
                return $text;
            })
            ->rawColumns(['file_path'])
            ->make(true);
    }

    public function getUploadByIdHotel(Request $request, $id)
    {
        $dataStaff = DataStaffPerjalanan::findOrFail($id);

        $data = ['status' => false, 'message' => 'Tujuan failed to be found'];
        $data = AkomodasiHotel::where('id_staff_perjalanan', $id)
            ->with(['staff'])
            ->where('status', true)
            ->get();

        $dataCounter = AkomodasiHotel::where('id_staff_perjalanan', $id)
            ->where('status', true)
            ->count();

        return datatables($data)
            ->addIndexColumn()
            ->editColumn('file_path', function($db) {
                $text = "";
                if ($db->file_path) {
                    $text .= "<a href='" . route('hotel/pdf', $db->id) . "' class='' target='_blank'>";
                    $text .= $db->deskripsi_file . '.pdf';
                    $text .= "</a>";
                }
                return $text;
            })
            ->rawColumns(['file_path'])
            ->make(true);

    }

    public function store(Request $request)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'File failed to create'];
            $fileName = \Str::random(20);
            $path = 'bukti_berangkat/' . $request['bukti_berangkat'];

            $validator = \Validator::make($request->all(), [
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'code' => 'EC001', 'message' => 'The maximum file size is 10 MB with the format PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, TXT, CSV, PNG, JPG, JPEG, RAR, ZIP.']);
            }


        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }

        return $data;
    }


}
