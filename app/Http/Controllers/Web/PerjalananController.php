<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
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

        $query = Perjalanan::select()
            ->with('mak', 'tujuan.tempatTujuan', 'log_status_perjalanan', 'kegiatan', 'data_staff_perjalanan.staff')
            ->where('status', true)
            ->whereHas('log_status_perjalanan', function ($query) {
                $query->where('status_perjalanan', 'Disetujui');
            });

        // If the user is not a super admin, filter data based on user's ID
        if ($userRole != 'Super Admin') {
            $query->whereHas('data_staff_perjalanan.staff', function ($query) {
                $query->where('id_user', Auth::id());
            });
        }

        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->where('perihal_perjalanan', 'like', '%' . $keyword . '%')
                    ->orWhereHas('mak', function ($query) use ($keyword) {
                        $query->where('kode_mak', 'like', '%' . $keyword . '%');
                    });
            });
        }

        $data = $query->get();

        return DataTables::of($data)->make(true);
    }

    public function getDataRekap(Request $request)
    {
        $keyword = $request['searchkey'];
        $userRole = Auth::user()->roles->pluck('name')[0];

        $query = Perjalanan::select()
            ->with('mak', 'tujuan.tempatTujuan', 'kegiatan', 'data_staff_perjalanan.staff')
            ->where('status', true);

        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
                $query
                    ->whereHas('mak', function ($query) use ($keyword) {
                        $query->where('mak.kode_mak', 'like', '%' . $keyword . '%');
                    })
                    ->orWhere('perihal_perjalanan', 'like', '%' . $keyword . '%');
            });
        }

        // If the user is not a super admin, filter data based on user's ID
        if ($userRole != 'Super Admin') {
            $query->whereHas('data_staff_perjalanan.staff', function ($query) {
                $query->where('id_user', Auth::id());
            });
        }

        $data = $query->get();

        return DataTables::of($data)->make(true);
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
}