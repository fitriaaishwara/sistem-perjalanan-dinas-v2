<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DataStaffPerjalanan;
use App\Models\Spd;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Dotenv\Validator;
use Illuminate\Support\Facades\Storage;

class SpdController extends Controller
{
    public function index()
    {
        return view('pages.pre-perjalanan.spd.index');
    }

    public function indexDownload()
    {
        return view('pages.pre-perjalanan.spd.index-download');
    }

    public function getData(Request $request)
    {
        $keyword = $request['searchkey'];
        $userRole = Auth::user()->roles->pluck('name')[0];

        $query = DataStaffPerjalanan::select()
            ->with(['perjalanan.mak', 'staff.instansis', 'penandatangan', 'tujuan_perjalanan.tempatTujuan', 'spd', 'perjalanan.kegiatan'])
            ->whereHas('perjalanan.status_perjalanan', function ($query) {
                $query->where('id_status', '=', '2');
            })
            ->where('status', true);

        // If the user is not a super admin, filter data based on user's ID
        if ($userRole != 'Super Admin' && $userRole != 'Admin') {
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
                ->orWhereHas('spd', function ($query) use ($keyword) {
                    $query->where('nomor_spd', 'like', '%' . $keyword . '%');
                })
                ->orWhereHas('tujuan_perjalanan', function ($query) use ($keyword) {
                    $query->where('tanggal_berangkat', 'like', '%' . $keyword . '%')
                          ->orWhere('tanggal_pulang', 'like', '%' . $keyword . '%');
                });
            });
        }

        $data = $query->offset($request->input('start'))
            ->limit(($request->input('length') == -1) ? DataStaffPerjalanan::where('status', true)->count() : $request->input('length'))
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

    public function detail($id)
    {
        $spd = DataStaffPerjalanan::with(['perjalanan.mak', 'staff.instansis', 'penandatangan', 'tujuan_perjalanan', 'spd'])->find($id);
        return view('pages.pre-perjalanan.spd.detail', compact('spd'));
    }

    public function create($id)
    {

        $dataStaff = DataStaffPerjalanan::with(['staff', 'perjalanan.mak', 'tujuan_perjalanan', 'perjalanan.kegiatan'])->find($id);
        // dd($dataStaff);
        return view('pages.pre-perjalanan.spd.create', compact('dataStaff'));
    }

    public function store(Request $request)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'SPD failed to create'];
            $create = Spd::create([
                'id_staff_perjalanan' => $request->id_staff_perjalanan,
                'id_kegiatan' => $request->id_kegiatan,
                'nomor_spd' => $request->nomor_spd,
                'pejabat_pembuat_komitmen' => $request->pejabat_pembuat_komitmen,
                'tingkat_biaya_perjalanan_dinas' => $request->tingkat_biaya_perjalanan_dinas,
                'alat_angkutan' => $request->alat_angkutan,
                'keterangan' => $request->keterangan,
                'pada_tanggal' => $request->pada_tanggal,
            ]);
            if ($create) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'SPD successfully created'];
            }
        } catch (\Exception $e) {
            $data = ['status' => false, 'code' => 'EC001', 'message' => $e->getMessage()];
        }
        if ($data['status']) {
            Alert::success('SPD Berhasil Dibuat', 'Berhasil');
            return redirect()->route('spd');
        } else {
            Alert::error('SPD Gagal Dibuat', 'Gagal');
            return redirect()->back();
        }
    }

    public function spdPDF($id)
    {
        $spd = DataStaffPerjalanan::with(['perjalanan.mak', 'staff.instansis', 'penandatangan', 'tujuan_perjalanan.tempatBerangkat', 'spd', 'staff.jabatans', 'staff.golongans', 'perjalanan.kegiatan'])->find($id);

        // Load view dengan konfigurasi ukuran kertas A5
        $pdf = \PDF::loadView('pages.pre-perjalanan.spd.pdf', compact('spd'))->setPaper('a5');

        return $pdf->stream();
    }

    public function spdPDF2($id)
    {
        $spd = DataStaffPerjalanan::with(['perjalanan.mak', 'staff.instansis', 'penandatangan', 'tujuan_perjalanan', 'spd'])->find($id);
        $pdf = \PDF::loadView('pages.pre-perjalanan.spd.pdf2', compact('spd'));
        return $pdf->stream();
    }

    public function upload(Request $request)
    {
        \Log::info('Upload method called');
        $perjalanan = DataStaffPerjalanan::with(['spd'])->find($request->id_staff_perjalanan);

        if (!$perjalanan) {
            return response()->json([
                'status' => false,
                'message' => 'Perjalanan not found'
            ]);
        }

        $validator = \Validator::make($request->all(), [
            'file_spd' => 'required|mimes:pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid file. The maximum file size is 2 MB with the format PDF.'
            ]);
        }

        try {
            $file = $request->file('file_spd');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = 'uploads/spd/ttd/' . $fileName;

             // Store the file using Laravel Storage
             Storage::disk('public')->putFileAs('uploads/spt/ttd/', $file, $fileName);

            $SpdUpdate = Spd::where('id_staff_perjalanan', $perjalanan->id)->update(['file_spd' => $fileName]);

            if ($SpdUpdate) {
                return response()->json([
                    'status' => true,
                    'message' => 'Spd successfully updated'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Spd failed to update'
                ]);
            }

        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => 'A system error has occurred. Please try again later. ' . $ex->getMessage()
            ]);
        }
    }



    public function showSpd($id)
    {
        $perjalanan = DataStaffPerjalanan::with(['spd'])->find($id);

        if (!$perjalanan) {
            return response()->json(['status' => false, 'message' => 'Perjalanan not found'], 404);
        }

        $Spd = $perjalanan->spd;

        if ($Spd) {
            return response()->json(['status' => true, 'message' => 'Nota Dinas found', 'data' => $Spd]);
        } else {
            return response()->json(['status' => false, 'message' => 'Nota Dinas not found']);
        }
    }

    public function downloadFile($id)
    {
        $Spd = Spd::find($id);

        if (!$Spd) {
            return response()->json(['status' => false, 'message' => 'Nota Dinas not found'], 404);
        }

        $filePath = 'uploads/spd/ttd/' . $Spd->file_spd;

        if (Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->download($filePath);
        } else {
            return response()->json(['status' => false, 'message' => 'File not found'], 404);
        }

        if ($Spd == null) {
            Alert::error('File Not Found');

            return redirect()->back();

            }
    }

    public function downloadFilettd($id)
    {
        $Spd = Spd::findOrFail($id);
        $filePath = 'uploads/spd/ttd/' . $Spd->file_spd;

        // Pastikan disk yang digunakan adalah 'public'
        if (Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->download($filePath);
        } else {
            return response()->json(['status' => false, 'message' => 'File not found'], 404);
        }

        if ($Spd == null) {
            Alert::error('File Not Found');

            return redirect()->back();

            }
    }
}
