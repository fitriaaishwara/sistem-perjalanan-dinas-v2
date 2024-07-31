<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DataStaffPerjalanan;
use App\Models\Spt;
use App\Models\Staff;
use App\Models\Tujuan;
use Dotenv\Validator;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SptController extends Controller
{
    public function index()
    {
        return view('pages.pre-perjalanan.spt.index');
    }

    public function indexDownload()
    {
        return view('pages.pre-perjalanan.spt.index-download');
    }

   public function getData(Request $request)
    {
        $keyword = $request->input('searchkey');
        $userRole = Auth::user()->roles->pluck('name')->first();

        $query = Tujuan::with([
                'perjalanan',
                'spt',
                'staff.staff',
                'tempatTujuan',
                'perjalanan.kegiatan',
                'perjalanan.data_staff_perjalanan.staff',
                'kegiatan'
            ])
            ->whereHas('perjalanan.status_perjalanan', function ($query) {
                $query->where('id_status', 2);
            })
            ->where('status', true);

        // If the user is not a super admin or admin, filter data based on the user's ID
        if ($userRole !== 'Super Admin' && $userRole !== 'Admin') {
            $query->whereHas('staff', function ($query) {
                $query->whereHas('staff', function ($query) {
                    $query->where('id_user', Auth::id());
                });
            });
        }

        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->whereHas('perjalanan.data_staff_perjalanan.staff', function ($query) use ($keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('perjalanan.data_staff_perjalanan.staff', function ($query) use ($keyword) {
                        $query->where('nip', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('perjalanan.mak', function ($query) use ($keyword) {
                        $query->where('kode_mak', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('perjalanan.kegiatan', function ($query) use ($keyword) {
                        $query->where('kegiatan', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('tempatTujuan', function ($query) use ($keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('spt', function ($query) use ($keyword) {
                        $query->where('nomor_spt', 'like', '%' . $keyword . '%');
                    });
            });
        }

        $totalRecords = Tujuan::where('status', true)->count();
        $filteredRecords = $query->count();

        $data = $query->offset($request->input('start'))
            ->limit(($request->input('length') == -1) ? $filteredRecords : $request->input('length'))
            ->get();

        $response = [
            'status'          => true,
            'draw'            => $request->input('draw'),
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data'            => $data,
        ];

        return response()->json($response);
    }
    public function create($id)
    {
        $tujuan = Tujuan::with(['perjalanan', 'spt', 'staff', 'staff.staff', 'tempatTujuan'])->find($id);
        $staff = Staff::where('status', true)->get();
        $dataStaff= DataStaffPerjalanan::with(['staff.jabatans','perjalanan', 'tujuan_perjalanan'])->where('id_tujuan_perjalanan', $tujuan->id)->get();
        return view('pages.pre-perjalanan.spt.create', compact('tujuan', 'staff', 'dataStaff'));
    }

    public function store(Request $request)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'SPT failed to create'];
            $create = Spt::create([
                'id_tujuan' => $request->id_tujuan,
                'id_staff' => $request->id_staff,
                'id_staff_penandatangan' => $request->id_staff_penandatangan,
                'nomor_spt' => $request->nomor_spt,
                'dikeluarkan_tanggal' => $request->dikeluarkan_tanggal,
            ]);
            if ($create) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Jabatan successfully created'];
            }
        } catch (\Exception $e) {
            $data = ['status' => false, 'code' => 'EC001', 'message' => $e->getMessage()];
        }
        if ($data['status']) {
            Alert::success('SPT Berhasil Dibuat', 'Berhasil');
            return redirect()->route('spt');
        } else {
            Alert::error('SPT Gagal Dibuat', 'Gagal');
            return redirect()->back();
        }
    }
    public function detail($id)
    {
        $tujuan = Tujuan::with(['perjalanan', 'spt', 'staff', 'staff.staff'])->find($id);
        $spt = Spt::where('id_tujuan', $id)->first();
        $dataStaff= DataStaffPerjalanan::with(['staff','perjalanan', 'tujuan_perjalanan'])->where('id_tujuan_perjalanan', $tujuan->id)->get();

        return view('pages.pre-perjalanan.spt.detail', compact('tujuan', 'dataStaff', 'spt'));
    }

    public function sptPDF($id)
    {
        $tujuan = Tujuan::with(['perjalanan', 'spt', 'staff', 'staff.staff'])->find($id);
        $spt = Spt::where('id_tujuan', $id)->first();
        $dataStaff= DataStaffPerjalanan::with(['staff','perjalanan', 'tujuan_perjalanan'])->where('id_tujuan_perjalanan', $tujuan->id)->get();

        //pdf
        if ($spt) {
            $pdf = \PDF::loadView('pages.pre-perjalanan.spt.pdf', compact('tujuan', 'dataStaff', 'spt'));
            return $pdf->stream();
        } else {
            //return redirect with Alert
            //css for alert
            Alert::error('SPT Tidak Ditemukan', 'Buat SPT Terlebih Dahulu');
            return redirect()->back();
        }
    }

    public function upload(Request $request)
    {
        \Log::info('Upload method called');
        $tujuan = Tujuan::with(['spt'])->find($request->id_tujuan);

        if (!$tujuan) {
            return response()->json(['status' => false, 'code' => 'EC002', 'message' => 'Perjalanan not found'], 404);
        }

        $validator = \Validator::make($request->all(), [
            'file_spt' => 'required|mimes:pdf|max:2048', // Ensure the file is a PDF and not larger than 2MB
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 'EC003', 'message' => 'Invalid file. The maximum file size is 2 MB with the format PDF.']);
        }

        try {
            $file = $request->file('file_spt');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = 'uploads/spt/ttd/' . $fileName; // Update path

            // Store the file using Laravel Storage
            Storage::disk('public')->putFileAs('uploads/spt/ttd/', $file, $fileName);

            $SptUpdate = Spt::where('id_tujuan', $tujuan->id)->update([
                'file_spt' => $fileName,
            ]);


            if ($SptUpdate) {
                return response()->json([
                    'status' => true,
                    'message' => 'Spt successfully updated'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Spt failed to update'
                ]);
            }
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => 'A system error has occurred. Please try again later. ' . $ex->getMessage()
            ]);
        }
    }

    public function showSpt($id)
    {
        $tujuan = Tujuan::with(['spt'])->find($id);

        if (!$tujuan) {
            return response()->json(['status' => false, 'message' => 'Perjalanan not found'], 404);
        }

        $Spt = $tujuan->spt;

        if ($Spt) {
            return response()->json(['status' => true, 'message' => 'Nota Dinas found', 'data' => $Spt]);
        } else {
            return response()->json(['status' => false, 'message' => 'Nota Dinas not found']);
        }
    }

    public function downloadFile($id)
    {
        $Spt = Spt::find($id);

        if (!$Spt) {
            return response()->json(['status' => false, 'message' => 'Nota Dinas not found'], 404);
        }

        if (is_null($Spt->file_spt)) {
            return response()->json(['status' => false, 'message' => 'File not found'], 404);
        }

        $filePath = 'uploads/spt/ttd/' . $Spt->file_spt;

        if (Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->download($filePath);
        } else {
            return response()->json(['status' => false, 'message' => 'File not found'], 404);
        }
    }

    public function downloadFilettd($id)
    {
        $Spt = Spt::findOrFail($id);
        $filePath = 'uploads/spt/ttd/' . $Spt->file_spt;

        // Pastikan disk yang digunakan adalah 'public'
        if (Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->download($filePath);
        } else {
            return response()->json(['status' => false, 'message' => 'File not found'], 404);
        }

        if ($Spt == null) {
            Alert::error('File Not Found');

            return redirect()->back();

            }
    }
}
