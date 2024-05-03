<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AkomodasiHotel;
use App\Models\DataStaffPerjalanan;
use App\Models\Mak;
use App\Models\Perjalanan;
use App\Models\Tujuan;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AkomodasiHotelController extends Controller
{
    public function store (Request $request)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Data failed to update'];
            $file_path = $request->file('file_path');
            $fileName = $request->input('deskripsi_file') . '_' . date('d-m-Y') . '_' . time() . '_' . Str::random(10) . '.' . $file_path->getClientOriginalExtension();
            $path     = 'akomodasi_hotel/' . $request->input('id_staff_perjalanan');

            $validator = Validator::make($request->all(), [
                'file_path' => 'required|mimes:pdf|max:200240',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'code' => 'EC001', 'message' => 'The maximum file size is 20 MB with the format PDF.']);
            }

            $extension = $request->file('file_path')->extension();
            Storage::disk('public')->putFileAs($path, $request->file('file_path'), $fileName);

            // Create the record in the database
            $create = AkomodasiHotel::create([
                'id_staff_perjalanan' => $request->input('id_staff_perjalanan'),
                'id_sbm_hotel'        => $request->input('id_sbm_hotel'), // 'id_sbm_hotel' => 'required|integer',
                'nama_hotel'          => $request->input('nama_hotel'),
                'deskripsi_file'      => $request->input('deskripsi_file'),
                'tanggal_check_in'    => $request->input('tanggal_check_in'),
                'tanggal_check_out'   => $request->input('tanggal_check_out'),
                'nominal'             => $request->input('nominal'),
                'file_path'           => $fileName,
            ]);

            $dataStaff = DataStaffPerjalanan::where('id', $request->input('id_staff_perjalanan'))->first();
            $perjalanan = Perjalanan::where('id', $dataStaff->id_perjalanan)->first();
            $perjalanan->total_biaya = $perjalanan->total_biaya + $request->input('nominal');
            $perjalanan->save();

            if ($perjalanan->save()) {
                $dataStaff->total_biaya = $dataStaff->total_biaya + $request->input('nominal');
                $dataStaff->save();
            }

            if ($dataStaff->save()) {
                $tujuan = Tujuan::where('id', $dataStaff->id_tujuan_perjalanan)->first();
                $tujuan->total_biaya = $tujuan->total_biaya + $request->input('nominal');
                $tujuan->save();
            }

            if ($tujuan->save()) {
                $sisaSaldo = Mak::where('id', $perjalanan->id_mak)->first();
                $sisaSaldo->saldo_pagu = $sisaSaldo->saldo_pagu - $request->input('nominal');
                $sisaSaldo->save();
            }

            if ($sisaSaldo->save()) {
                $saldoTerealisasi = Mak::where('id', $perjalanan->id_mak)->first();
                $saldoTerealisasi->terealisasi = $saldoTerealisasi->terealisasi + $request->input('nominal');
                $saldoTerealisasi->save();
            }

            if ($create) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Jabatan successfully created'];
            }

        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. Please try again later. ' . $ex];
        }
        return $data;
    }

    //download file
    public function downloadFile($id)
    {
        $data = AkomodasiHotel::findOrFail($id);
        $path = 'akomodasi_hotel' . DIRECTORY_SEPARATOR . $data->id_staff_perjalanan . DIRECTORY_SEPARATOR;
        $fileName = $data->file_path;
        $filePath = 'app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . $path . $fileName;

        $path = storage_path($filePath);

        return \Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$fileName.'"'
        ]);
    }
}
