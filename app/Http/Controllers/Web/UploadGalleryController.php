<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DataKegiatan;
use App\Models\Kegiatan;
use App\Models\Tujuan;
use App\Models\UploadGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UploadGalleryController extends Controller
{
    public function index()
    {
        return view('pages.pra-perjalanan.dokumentasi.gallery.index');
    }

    public function getData(Request $request)
    {
        $keyword = $request['searchkey'];
        $userRole = Auth::user()->roles->pluck('name')[0];

        $query = Kegiatan::with(['perjalanan', 'perjalanan.data_staff_perjalanan.staff', 'perjalanan.tujuan.uploadGallery', 'perjalanan.tujuan.tempatTujuan', 'perjalanan.tujuan.tempatBerangkat', 'DataKegiatan.staff'])
            ->where('status', true);

        // If the user is not a super admin, filter data based on user's ID
        if ($userRole != 'Super Admin') {
            $query->whereHas('perjalanan.data_staff_perjalanan.staff', function ($query) {
                $query->where('id_user', Auth::id());
            });
        }

        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->where('kegiatan', 'like', '%' . $keyword . '%')
                    ->orWhereHas('perjalanan', function ($query) use ($keyword) {
                        $query->whereHas('tujuan', function ($query) use ($keyword) {
                            $query->whereHas('tempatTujuan', function ($query) use ($keyword) {
                                $query->where('name', 'like', '%' . $keyword . '%');
                            });
                        });
                    })
                    ->orWhereHas('perjalanan', function ($query) use ($keyword) {
                        $query->whereHas('tujuan', function ($query) use ($keyword) {
                            $query->where('tanggal_berangkat', 'like', '%' . $keyword . '%');
                        });
                    })
                    ->orWhereHas('perjalanan', function ($query) use ($keyword) {
                        $query->whereHas('tujuan', function ($query) use ($keyword) {
                            $query->where('tanggal_pulang', 'like', '%' . $keyword . '%');
                        });
                    })
                    ->orWhereHas('DataKegiatan', function ($query) use ($keyword) {
                        $query->whereHas('staff', function ($query) use ($keyword) {
                                $query->where('name', 'like', '%' . $keyword . '%');

                        });
                    });
            });
        }

        $data = $query->offset($request['start'])
            ->limit(($request['length'] == -1) ? Kegiatan::where('status', true)->count() : $request['length'])
            ->get();

        $dataCounter = $query->count();

        $response = [
            'status'          => true,
            'draw'            => $request['draw'],
            'recordsTotal'    => Kegiatan::where('status', true)->count(),
            'recordsFiltered' => $dataCounter,
            'data'            => $data,
        ];

        return $response;
    }

    public function create($id)
    {
        $kegiatan = Kegiatan::with(['perjalanan', 'perjalanan.data_staff_perjalanan.staff', 'perjalanan.tujuan.uploadGallery', 'perjalanan.tujuan.tempatTujuan','perjalanan.tujuan.tempatBerangkat'])->findOrFail($id);

        return view('pages.pra-perjalanan.dokumentasi.gallery.create', compact('kegiatan'));
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
                'id_data_kegiatan'     => $request->input('id_data_kegiatan'),
                'name_file'      => $request->input('name_file'),
                'path_file'           => $fileName,
            ]);

            if ($create) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Photo successfully created'];
            }

        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. Please try again later. ' . $ex];
        }

        return $data;
    }

    public function show($id)
    {
        try {
            $data = ['status' => false, 'message' => 'Photo failed to be found'];
            $data = Tujuan::findOrFail($id);
            if ($data) {
                $data = ['status' => true, 'message' => 'Photo was successfully found', 'data' => $data];
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
