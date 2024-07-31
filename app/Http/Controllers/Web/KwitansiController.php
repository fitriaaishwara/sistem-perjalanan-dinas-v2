<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DataStaffPerjalanan;
use App\Models\Kwitansi;
use App\Models\Staff;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Dotenv\Validator;
use Illuminate\Support\Facades\Storage;

class KwitansiController extends Controller
{
    public function index()
    {
        return view('pages.pra-perjalanan.kwitansi.index');
    }

    public function indexDownload()
    {
        return view('pages.pra-perjalanan.kwitansi.index-download');
    }

    public function getData(Request $request)
    {
        $user = Auth::user();
        $keyword = $request->has('searchkey') ? $request->input('searchkey') : null;
        $userRole = $user->roles->pluck('name')->first();

        $query = DataStaffPerjalanan::query()
            ->with('staff', 'perjalanan', 'perjalanan.mak', 'tujuan_perjalanan.tempatTujuan', 'tujuan_perjalanan.uangHarian', 'spd', 'kwitansi', 'transportasi_berangkat', 'transportasi_pulang', 'akomodasi_hotel', 'perjalanan.kegiatan')
            ->whereHas('perjalanan.status_perjalanan', function ($query) {
                $query->where('id_status', '=', '2');
            })
            ->where('status', true);

        // Check if user is not a super admin
        if ($userRole !== 'Super Admin') {
            // If not a super admin, restrict data based on user's id
            $query->whereHas('staff', function ($query) use ($user) {
                $query->where('id_user', $user->id);
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
        $kwitansi = DataStaffPerjalanan::with(['perjalanan.mak', 'staff.instansis', 'penandatangan', 'tujuan_perjalanan', 'spd', 'kwitansi'])->find($id);
        return view('pages.pra-perjalanan.kwitansi.detail', compact('kwitansi'));

        // dd($kwitansi);
    }

    public function create($id)
    {

        $staff  = Staff::where('status', true)->get();
        $dataStaff = DataStaffPerjalanan::with(['staff', 'perjalanan.mak', 'tujuan_perjalanan', 'tujuan_perjalanan.uangHarian','tujuan_perjalanan.kegiatan'])->find($id);
        // dd($dataStaff);

        //if nomor_spd is null, then sowing alert
        if ($dataStaff->spd == null) {
            Alert::warning('', 'SPD belum dibuat');
            return redirect()->back();
        }
        return view('pages.pra-perjalanan.kwitansi.create', compact('dataStaff', 'staff'));
    }

    public function store(Request $request)
    {
        //make create function
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Kwitansi failed to create'];
            $create = Kwitansi::create([
                'id_staff_perjalanan' => $request->id_staff_perjalanan,
                'nip_bendahara'        => $request->nip_bendahara,
                'nip_pejabat_pembuat_komitmen' => $request->nip_pejabat_pembuat_komitmen,
                'bukti_kas_nomor'        => $request->bukti_kas_nomor,
                'tahun_anggaran'      => $request->tahun_anggaran,
                'sudah_diterima_dari' => $request->sudah_diterima_dari,
                'status'              => 1,
            ]);

            // if ($create) {
            //     $dataStaff = DataStaffPerjalanan::where('id', $request->input('id_staff_perjalanan'))->first();
            //     $dataStaff->status_kwitansi = true;
            //     $dataStaff->save();
            // }

            if ($create->save()) {
                $response = ['status' => true, 'code' => 'SC001', 'message' => 'Kwitansi successfully created'];
            }
        } catch (\Exception $ex) {
            $response = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. Please try again later. ' . $ex];
        }
        if ($response['status']) {
            Alert::success('Kwitansi Berhasil Dibuat', 'Berhasil');
            return redirect()->route('kwitansi');
        } else {
            Alert::error('Kwitansi Gagal Dibuat', 'Gagal');
            return redirect()->back();
        }

    }

    public function kwitansiPDF($id)
    {
        // $kwitansi = Kwitansi::with(['dataStaffPerjalanan.staff', 'dataStaffPerjalanan.perjalanan.mak', 'dataStaffPerjalanan.tujuan_perjalanan', 'bendahara', 'pejabatPembuatKomitmen', 'dataStaffPerjalanan.spd'])->find($id);
        // // dd($kwitansi);

        // // return $pdf->stream();

        // if ($kwitansi) {
        //     $pdf = \PDF::loadView('pages.kwitansi.pdf', compact('kwitansi'));
        //     return $pdf->stream();
        // } else {
        //     alert()->warning('', 'Data tidak ditemukan');
        //     return redirect()->back();
        // }

        // $kwitansi = Kwitansi::with(['dataStaffPerjalanan.staff', 'dataStaffPerjalanan.perjalanan.mak', 'dataStaffPerjalanan.tujuan_perjalanan', 'bendahara', 'pejabatPembuatKomitmen', 'dataStaffPerjalanan.spd'])->find($id);
        $kwitansi = DataStaffPerjalanan::with(['staff', 'perjalanan.mak', 'tujuan_perjalanan.uangHarian', 'spd', 'kwitansi', 'transportasi_berangkat', 'transportasi_pulang', 'akomodasi_hotel'])->find($id);
        // return view('pages.pra-perjalanan.kwitansi.pdf', compact('kwitansi'));
        $pdf = \PDF::loadView('pages.pra-perjalanan.kwitansi.pdf', compact('kwitansi'));
        // return response()->json([
        //     'data' => $kwitansi
        // ]);
        return $pdf->stream();
    }

    public function kwitansiPDF2($id)
    {
        // $kwitansi = Kwitansi::with(['dataStaffPerjalanan.staff', 'dataStaffPerjalanan.perjalanan.mak', 'dataStaffPerjalanan.tujuan_perjalanan', 'bendahara', 'pejabatPembuatKomitmen', 'dataStaffPerjalanan.spd'])->find($id);
        // // dd($kwitansi);

        // // return $pdf->stream();

        // if ($kwitansi) {
        //     $pdf = \PDF::loadView('pages.kwitansi.pdf', compact('kwitansi'));
        //     return $pdf->stream();
        // } else {
        //     alert()->warning('', 'Data tidak ditemukan');
        //     return redirect()->back();
        // }

        // $kwitansi = Kwitansi::with(['dataStaffPerjalanan.staff', 'dataStaffPerjalanan.perjalanan.mak', 'dataStaffPerjalanan.tujuan_perjalanan', 'bendahara', 'pejabatPembuatKomitmen', 'dataStaffPerjalanan.spd'])->find($id);
        $kwitansi = DataStaffPerjalanan::with(['staff', 'perjalanan.mak', 'tujuan_perjalanan.uangHarian', 'spd', 'kwitansi', 'transportasi_berangkat', 'transportasi_pulang', 'akomodasi_hotel'])->find($id);
        $pdf = \PDF::loadView('pages.pra-perjalanan.kwitansi.pdf2', compact('kwitansi'));
        // return response()->json([
        //     'data' => $kwitansi->tujuan_perjalanan[0]->uangHarian->nominal*$kwitansi->tujuan_perjalanan[0]->lama_perjalanan
        // ]);
        return $pdf->stream();
    }

    public function kwitansiPDF3($id)
    {
        // $kwitansi = Kwitansi::with(['dataStaffPerjalanan.staff', 'dataStaffPerjalanan.perjalanan.mak', 'dataStaffPerjalanan.tujuan_perjalanan', 'bendahara', 'pejabatPembuatKomitmen', 'dataStaffPerjalanan.spd'])->find($id);
        // // dd($kwitansi);

        // // return $pdf->stream();

        // if ($kwitansi) {
        //     $pdf = \PDF::loadView('pages.kwitansi.pdf', compact('kwitansi'));
        //     return $pdf->stream();
        // } else {
        //     alert()->warning('', 'Data tidak ditemukan');
        //     return redirect()->back();
        // }

        // $kwitansi = Kwitansi::with(['dataStaffPerjalanan.staff', 'dataStaffPerjalanan.perjalanan.mak', 'dataStaffPerjalanan.tujuan_perjalanan', 'bendahara', 'pejabatPembuatKomitmen', 'dataStaffPerjalanan.spd'])->find($id);
        $kwitansi = DataStaffPerjalanan::with(['staff', 'perjalanan.mak', 'tujuan_perjalanan.uangHarian', 'spd', 'kwitansi'])->find($id);
        $pdf = \PDF::loadView('pages.pra-perjalanan.kwitansi.pdf3', compact('kwitansi'));
        // return response()->json([
        //     'data' => $kwitansi->tujuan_perjalanan[0]->uangHarian->nominal*$kwitansi->tujuan_perjalanan[0]->lama_perjalanan
        // ]);
        return $pdf->stream();
    }

    public function upload(Request $request)
    {
        \Log::info('Upload method called');
        $dataStaff = DataStaffPerjalanan::with(['kwitansi'])->find($request->id_staff_perjalanan);

        if (!$dataStaff) {
            return response()->json([
                'status' => false,
                'message' => 'Perjalanan not found'
            ]);
        }

        $validator = \Validator::make($request->all(), [
            'file_kwitansi' => 'required|mimes:pdf|max:2048', // Ensure the file is a PDF and not larger than 2MB
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid file. The maximum file size is 2 MB with the format PDF.'
            ]);
        }

        try {
            $file = $request->file('file_kwitansi');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = 'uploads/kwitansi/ttd/' . $fileName; // Update path

            // Store the file using Laravel Storage
            Storage::disk('public')->putFileAs('uploads/kwitansi/ttd', $file, $fileName);

            $KwitansiUpdate = Kwitansi::where('id_staff_perjalanan', $dataStaff->id)->update([
                'file_kwitansi' => $fileName,
            ]);

            if ($KwitansiUpdate) {
                return response()->json([
                    'status' => true,
                    'message' => 'Kwitansi successfully updated'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Kwitansi failed to update'
                ]);
            }
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => 'A system error has occurred. Please try again later. ' . $ex->getMessage()
            ]);
        }
    }

    public function showKwitansi($id)
    {
        $dataStaff = DataStaffPerjalanan::with(['kwitansi'])->find($id);

        if (!$dataStaff) {
            return response()->json(['status' => false, 'message' => 'Perjalanan not found'], 404);
        }

        $kwitansi = $dataStaff->kwitansi;

        if ($kwitansi) {
            return response()->json(['status' => true, 'message' => 'Nota Dinas found', 'data' => $kwitansi]);
        } else {
            return response()->json(['status' => false, 'message' => 'Nota Dinas not found']);
        }
    }

    public function downloadFile($id)
    {
        $kwitansi = Kwitansi::find($id);

        if (!$kwitansi) {
            return response()->json(['status' => false, 'message' => 'Nota Dinas not found'], 404);
        }

        $filePath = 'uploads/kwitansi/ttd/' . $kwitansi->file_kwitansi;

        if (Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->download($filePath);
        } else {
            return response()->json(['status' => false, 'message' => 'File not found'], 404);
        }

        if ($kwitansi == null) {
            Alert::error('File Not Found');

            return redirect()->back();

            }

    }
}
