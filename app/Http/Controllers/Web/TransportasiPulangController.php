<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\TransportasiPulang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TransportasiPulangController extends Controller
{
    public function store (Request $request)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Data failed to update'];
            $file_path = $request->file('file_path');
            $fileName = time() . '_' . Str::random(10) . '.' . $file_path->getClientOriginalExtension();
            $path     = 'transportasi_pulang/' . $request->input('id_staff_perjalanan');

            $validator = Validator::make($request->all(), [
                'file_path' => 'required|mimes:pdf|max:200240',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'code' => 'EC001', 'message' => 'The maximum file size is 20 MB with the format PDF.']);
            }

            $extension = $request->file('file_path')->extension();
            Storage::disk('public')->putFileAs($path, $request->file('file_path'), $fileName);

            // Create the record in the database
            $create = TransportasiPulang::create([
                'id_transportasi'     => $request->input('id_transportasi'),
                'id_staff_perjalanan' => $request->input('id_staff_perjalanan'),
                'deskripsi_file'      => $request->input('deskripsi_file'),
                'nominal'             => $request->input('nominal'),
                'file_path'           => $fileName,
            ]);

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
        $data = TransportasiPulang::findOrFail($id);
        $path = 'transportasi_pulang' . DIRECTORY_SEPARATOR . $data->id_staff_perjalanan . DIRECTORY_SEPARATOR;
        $fileName = $data->file_path;
        $filePath = 'app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . $path . $fileName;

        $path = storage_path($filePath);

        return \Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$fileName.'"'
        ]);
    }
}
