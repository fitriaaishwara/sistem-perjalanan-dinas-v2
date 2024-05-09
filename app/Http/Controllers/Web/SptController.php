<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DataStaffPerjalanan;
use App\Models\Spt;
use App\Models\Staff;
use App\Models\Tujuan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

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
        $keyword = $request['searchkey'];
        $userRole = Auth::user()->roles->pluck('name')[0];

        $query = Tujuan::select()
            ->with(['perjalanan', 'spt', 'staff', 'staff.staff', 'tempatTujuan', 'perjalanan.kegiatan', 'perjalanan.data_staff_perjalanan.staff'])
            ->where('status', true);

        // If the user is not a super admin, filter data based on user's ID
        if ($userRole != 'Super Admin') {
            $query->whereHas('staff.staff', function ($query) {
                $query->where('id_user', Auth::id());
            });
        }

        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->whereHas('perjalanan', function ($query) use ($keyword) {
                    $query->whereHas('data_staff_perjalanan', function ($query) use ($keyword) {
                        $query->whereHas('staff', function ($query) use ($keyword) {
                            $query->where('name', 'like', '%' . $keyword . '%');
                        });
                    });
                })
                ->orWhereHas('perjalanan', function ($query) use ($keyword) {
                    $query->whereHas('data_staff_perjalanan', function ($query) use ($keyword) {
                        $query->whereHas('staff', function ($query) use ($keyword) {
                            $query->where('nip', 'like', '%' . $keyword . '%');
                        });
                    });
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
                ->orWhereHas('tempatTujuan', function ($query) use ($keyword) {
                    $query->where('name', 'like', '%' . $keyword . '%');
                })
                ->orWhereHas('spt', function ($query) use ($keyword) {
                    $query->where('nomor_spt', 'like', '%' . $keyword . '%');
                });

            });
        }

        $data = $query->offset($request->input('start'))
            ->limit(($request->input('length') == -1) ? Tujuan::where('status', true)->count() : $request->input('length'))
            ->get();

        $dataCounter = $query->count();

        $response = [
            'status'          => true,
            'draw'            => $request->input('draw'),
            'recordsTotal'    => Tujuan::where('status', true)->count(),
            'recordsFiltered' => $dataCounter,
            'data'            => $data,
        ];

        return $response;
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
                'nip_staff_penandatangan' => $request->nip_staff_penandatangan,
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
}
