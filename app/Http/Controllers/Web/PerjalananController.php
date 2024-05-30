<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DataKegiatan;
use App\Models\Kegiatan;
use App\Models\Perjalanan;
use App\Models\Province;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class PerjalananController extends Controller
{
    public function index()
    {
        return view('pages.perjalanan.perjalanan.index');
    }

    public function staff(Request $request)
    {
        $staff = \App\Models\Staff::select('id as id', 'name as text', 'nip')->get();

        if ($request->has('q')) {
            $staff = \App\Models\Staff::select('id as id', 'name as text', 'nip')
                ->where('name', 'like', '%' . $request->get('q') . '%')
                ->get();
        }

        return response()->json(['staff' => $staff]);
    }

    public function staff_by_id($nip)
    {
        $staff = \App\Models\Staff::where('nip', $nip)->first();

        return response()->json(['staff' => $staff]);
    }

    public function getData(Request $request)
    {
        $keyword = $request['searchkey'];
        $userRole = Auth::user()->roles->pluck('name')[0];

        $data = Perjalanan::select()
        ->with(['mak','kegiatan.dataTujuan', 'kegiatan.dataTujuan.tempatBerangkat', 'kegiatan.dataTujuan.tempatTujuan', 'log_status_perjalanan.status_perjalanan',
            'kegiatan.dataTujuan.staff.staff', 'status_perjalanan','tujuan.uangHarian'])
            ->whereHas('status_perjalanan', function ($query) {
                $query->where('id_status', '=' , '2');
            })
            // ->where(function ($query) use ($keyword) {
            //     $query->where('id', 'like', '%' . $keyword . '%')
            //         ->orWhereHas('mak', function ($query) use ($keyword) {
            //             $query->where('kode_mak', 'like', '%' . $keyword . '%');
            //         })
            //         ->orWhereHas('tujuan', function ($query) use ($keyword) {
            //             $query->whereHas('tempatTujuan', function ($query) use ($keyword) {
            //                 $query->where('name', 'like', '%' . $keyword . '%');
            //             });
            //         })
            //         ->orWhereHas('tujuan', function ($query) use ($keyword) {
            //             $query->where('tanggal_berangkat', 'like', '%' . $keyword . '%');
            //         })
            //         ->orWhereHas('tujuan', function ($query) use ($keyword) {
            //             $query->where('tanggal_pulang', 'like', '%' . $keyword . '%');
            //         })
            //         ->orWhereHas('kegiatan', function ($query) use ($keyword) {
            //             $query->where('kegiatan', 'like', '%' . $keyword . '%');
            //         });
            // })
            ->where('status', 1);

        // If the user is not a super admin, filter data based on user's ID
        if ($userRole != 'Super Admin') {
            $data->whereHas('data_staff_perjalanan.staff', function ($query) {
                $query->where('id_user', Auth::id());
            });
        }

        $data = $data->offset($request['start'])
            ->limit(($request['length'] == -1) ? Perjalanan::where('status', true)->count() : $request['length'])
            ->get();

        $dataCounter = Perjalanan::whereDoesntHave('log_status_perjalanan', function ($query) {
            $query->where('id_status_perjalanan', '5');
        })
            ->where(function ($query) use ($keyword) {
                $query->where('id', 'like', '%' . $keyword . '%')
                    ->orWhereHas('mak', function ($query) use ($keyword) {
                        $query->where('kode_mak', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('kegiatan.dataTujuan', function ($query) use ($keyword) {
                        $query->whereHas('tempatTujuan', function ($query) use ($keyword) {
                            $query->where('name', 'like', '%' . $keyword . '%');
                        });
                    });
            })
            ->where('status', true)
            ->count();

        $response = [
            'status'         => true,
            'draw'           => $request['draw'],
            'recordsTotal'   => Perjalanan::where('status', true)->count(),
            'recordsFiltered' => $dataCounter,
            'data'           => $data,
        ];
        return $response;
    }

    public function getDataRekap(Request $request)
    {
        $keyword = $request['searchkey'];
        $userRole = Auth::user()->roles->pluck('name')[0];

        $data = Perjalanan::select()
            ->with('mak', 'tujuan.tempatTujuan', 'kegiatan', 'data_staff_perjalanan.staff', 'status_perjalanan')
            ->where(function ($query) use ($keyword) {
                $query->where('id', 'like', '%' . $keyword . '%')
                    ->orWhereHas('mak', function ($query) use ($keyword) {
                        $query->where('kode_mak', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('tujuan', function ($query) use ($keyword) {
                        $query->whereHas('tempatTujuan', function ($query) use ($keyword) {
                            $query->where('name', 'like', '%' . $keyword . '%');
                        });
                    })
                    ->orWhereHas('tujuan', function ($query) use ($keyword) {
                        $query->where('tanggal_berangkat', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('tujuan', function ($query) use ($keyword) {
                        $query->where('tanggal_pulang', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('kegiatan', function ($query) use ($keyword) {
                        $query->where('kegiatan', 'like', '%' . $keyword . '%');
                    });
            })
            ->where('status', true);

        // If the user is not a super admin, filter data based on user's ID
        if ($userRole != 'Super Admin') {
            $data->whereHas('data_staff_perjalanan.staff', function ($query) {
                $query->where('id_user', Auth::id());
            });
        }

        $data = $data->offset($request['start'])
            ->limit(($request['length'] == -1) ? Perjalanan::where('status', true)->count() : $request['length'])
            ->get();

        $dataCounter = Perjalanan::whereDoesntHave('log_status_perjalanan', function ($query) {
            $query->where('id_status_perjalanan', '5');
        })
            ->where(function ($query) use ($keyword) {
                $query->where('id', 'like', '%' . $keyword . '%')
                    ->orWhereHas('mak', function ($query) use ($keyword) {
                        $query->where('kode_mak', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('tujuan', function ($query) use ($keyword) {
                        $query->whereHas('tempatTujuan', function ($query) use ($keyword) {
                            $query->where('name', 'like', '%' . $keyword . '%');
                        });
                    });
            })
            ->where('status', true)
            ->count();

        $response = [
            'status'         => true,
            'draw'           => $request['draw'],
            'recordsTotal'   => Perjalanan::where('status', true)->count(),
            'recordsFiltered' => $dataCounter,
            'data'           => $data,
        ];
        return $response;
    }

    public function getDataProvinsi(Request $request)
    {
        $keyword = $request['searchkey'];

        $data = Province::select()
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->get();

        $dataCounter = Province::select()
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->count();

        return DataTables::of($data)
            ->make(true);
    }

    public function detail($id)
    {
        $perjalanan = Perjalanan::with('mak', 'kegiatan.dataTujuan.staff.staff')->find($id);
        // return response()->json($perjalanan);
        return view('pages.perjalanan.perjalanan.detail', compact('perjalanan'));
    }
}
