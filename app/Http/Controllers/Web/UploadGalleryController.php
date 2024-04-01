<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Tujuan;
use App\Models\UploadGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UploadGalleryController extends Controller
{
    public function index()
    {
        return view('pages.pra-perjalanan.dokumentasi.gallery.index');
    }

    public function getData(Request $request)
    {
        $keyword = $request['searchkey'];

        $data = Tujuan::select()
            ->with('perjalanan', 'perjalanan.data_staff_perjalanan.staff', 'uploadLaporan', 'uploadGallery', 'TempatTujuan')
            ->offset($request['start'])
            ->limit(($request['length'] == -1) ? Tujuan::where('status', true)->count() : $request['length'])
            ->when($keyword, function ($query, $keyword) {
                return $query->where('nomor_spt', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->get();

        $dataCounter = Tujuan::select()
            ->when($keyword, function ($query, $keyword) {
                return $query->where('nomor_spt', 'like', '%' . $keyword . '%');
            })
            ->where('status', true)
            ->count();

        $response = [
            'status'          => true,
            'draw'            => $request['draw'],
            'recordsTotal'    => Tujuan::where('status', true)->count(),
            'recordsFiltered' => $dataCounter,
            'data'            => $data,
        ];

        return $response;

    }

    public function create($id)
    {
        $tujuan = Tujuan::with('perjalanan', 'perjalanan.data_staff_perjalanan.staff', 'uploadLaporan', 'uploadGallery')->findOrFail($id);

        return view('pages.pra-perjalanan.dokumentasi.gallery.create', compact('tujuan'));
    }

    public function store (Request $request)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Data failed to update'];
            $filePath = $request->file('path_file');
            $fileName = time() . '_' . Str::random(10) . '.' . $filePath->getClientOriginalExtension();
            $path     = 'gallery/';

            $validator = Validator::make($request->all(), [
                'path_file' => 'required|mimes:jpg,jpeg,png|max:200240',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'code' => 'EC001', 'message' => 'The maximum file size is 20 MB with the format JPG, JPEG, PNG.']);
            }

            if ($validator->fails()) {
                return response()->json(['status' => false, 'code' => 'EC001', 'message' => 'The maximum file size is 10 MB with the format PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, TXT, CSV, PNG, JPG, JPEG, RAR, ZIP.']);
            }
            $extension = $request->file('path_file')->extension();
            Storage::disk('public')->putFileAs($path, $request->file('path_file'), $fileName);

            // Create the record in the database
            $create = UploadGallery::create([
                'id_tujuan_perjalanan' => $request->input('id_tujuan_perjalanan'),
                'name_file'      => $request->input('name_file'),
                'path_file'           => $fileName,
            ]);

            if ($create) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Jabatan successfully created'];
            }

        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. Please try again later. ' . $ex];
        }

        return $data;
    }

    public function show($id)
    {
        try {
            $data = ['status' => false, 'message' => 'Jabatan failed to be found'];
            $data = Tujuan::findOrFail($id);
            if ($data) {
                $data = ['status' => true, 'message' => 'Jabatan was successfully found', 'data' => $data];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;
    }

    //download file
    public function downloadFile($id)
    {
        $data = UploadGallery::findOrFail($id);
        $path = 'gallery' . DIRECTORY_SEPARATOR . $data->id_tujuan_perjalanan . DIRECTORY_SEPARATOR;
        $fileName = $data->path_file;
        $filePath = 'app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . $path . $fileName;

        $path = storage_path($filePath);

        return \Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$fileName.'"'
        ]);
    }
}
