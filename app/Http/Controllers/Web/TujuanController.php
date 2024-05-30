<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DataStaffPerjalanan;
use App\Models\Perjalanan;
use App\Models\Staff;
use App\Models\Tujuan;
use App\Models\UangHarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class TujuanController extends Controller
{
    public function getData(Request $request)
    {
        $keyword = $request['searchkey'];
        $data = Tujuan::select()
            ->with('perjalanan', 'tempatBerangkat', 'tempatTujuan')
            // ->offset($request['start'])
            // ->limit(($request['length'] == -1) ? Tujuan::where('status', true)->count() : $request['length'])
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->get();

        $dataCounter = Tujuan::select()
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->count();

        return DataTables::of($data)
                    ->make(true);
    }

    public function getTujuanByIdPerjalanan(Request $request, $id)
    {
        $dataTujuan = Tujuan::where('id_perjalanan', $id)->with('kegiatan', 'tempatBerangkat', 'tempatTujuan')->get();
        // return response()->json($perjalanan);
            return DataTables::of($dataTujuan)
                ->make(true);
    }

    public function getStaffByIdPerjalanan(Request $request, $id)
    {
        $dataStaff = DataStaffPerjalanan::where('id_perjalanan', $id)->with('staff.golongans', 'staff.jabatans', 'staff.instansis'
        , 'tujuan_perjalanan.tempatBerangkat', 'tujuan_perjalanan.tempatTujuan', 'tujuan_perjalanan.kegiatan')
        ->where('status', true)
        ->get();

            $data = DataStaffPerjalanan::where('id_perjalanan', $id)
                ->with('staff.golongans', 'staff.jabatans', 'staff.instansis', 'tujuan_perjalanan.tempatBerangkat', 'tujuan_perjalanan.tempatTujuan')
                ->where('status', true)
                ->get();

            return DataTables::of($dataStaff)
                ->make(true);
    }

    public function show($id)
    {
        try {
            $data = ['status' => false, 'message' => 'Tujuan failed to be found'];
            $data = Tujuan::with('perjalanan', 'tempatBerangkat', 'tempatTujuan', 'kegiatan')->findOrFail($id);
            if ($data) {
                $data = ['status' => true, 'message' => 'Tujuan was successfully found', 'data' => $data];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }

        return $data;
    }

    public function showStaff($id)
    {
        try {
            $data = ['status' => false, 'message' => 'Staff failed to be found'];
            $data = DataStaffPerjalanan::with([
                'staff',
                'perjalanan',
                'tujuan_perjalanan'
            ])->findOrFail($id);
            if ($data) {
                $data = ['status' => true, 'message' => 'Staff was successfully found', 'data' => $data];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }

        return $data;
    }

    public function destroy($id)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Tujuan failed to delete'];
            $delete = Tujuan::where('id', $id)->update([
                'status' => false
            ]);
            if ($delete) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Tujuan deleted successfully'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;
    }

    public function store(Request $request)
{
    try {
        // Inisialisasi data respons default
        $data = ['status' => false, 'code' => 'EC001', 'message' => 'Tujuan failed to be created'];

        // Buat entitas Tujuan
        $create = Tujuan::create([
            'id_kegiatan' => $request->id_kegiatan_tujuan,
            'id_perjalanan' => $request->id_perjalanan,
            'tempat_berangkat_id' => $request->tempat_berangkat_id,
            'tempat_tujuan_id' => $request->tempat_tujuan_id,
            'id_uang_harian' => $request->tempat_tujuan_id,
            'tanggal_berangkat' => $request->tanggal_berangkat,
            'tanggal_pulang' => $request->tanggal_pulang,
            'tanggal_tiba' => $request->tanggal_tiba,
            'lama_perjalanan' => $request->lama_perjalanan,
            'created_by' => Auth::user()->id,
        ]);

        if ($create) {
            // Ambil data UangHarian
            $uangHarian = UangHarian::where('province_id', $request->tempat_tujuan_id)->first();

            if ($uangHarian) {
                // Hitung total biaya berdasarkan nominal uang harian dan lama perjalanan
                $totalBiayaTambahan = $uangHarian->nominal * $request->lama_perjalanan;

                // Perbarui field total_biaya di tabel Perjalanan
                $perjalanan = Perjalanan::find($request->id_perjalanan);
                if ($perjalanan) {
                    $perjalanan->total_biaya += $totalBiayaTambahan;
                    $perjalanan->save();
                }
            }

            // Set data respons berhasil
            $data = ['status' => true, 'code' => 'SC001', 'message' => 'Tujuan successfully created'];
        }
    } catch (\Exception $ex) {
        // Tangani kesalahan
        $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex->getMessage()];
    }

    return $data;
}

    public function update(Request $request)
    {
        try {
            // return response()->json($request->all());
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Tujuan failed to be updated'];
            // Menampilkan seluruh data yang diterima dari permintaan POST

            $update = Tujuan::where('id', $request['id_tujuan'])->update([
                'id_kegiatan' => $request['id_kegiatan_tujuan'],
                'tempat_berangkat_id' => $request['tempat_berangkat_id'],
                'tempat_tujuan_id' => $request['tempat_tujuan_id'],
                'tanggal_berangkat' => $request['tanggal_berangkat'],
                'tanggal_pulang' => $request['tanggal_pulang'],
                'tanggal_tiba' => $request['tanggal_tiba'],
                'lama_perjalanan' => $request['lama_perjalanan'],
                'created_by' => Auth::user()->id,
            ]);

            if ($update) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Tujuan successfully updated'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }

        return $data;
    }
}
