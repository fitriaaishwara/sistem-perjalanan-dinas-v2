<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Tujuan;
use App\Models\UploadLaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UploadLaporanController extends Controller
{
    public function index()
    {
        return view('pages.pra-perjalanan.dokumentasi.laporan.index');
    }

    public function getData(Request $request)
    {
        $keyword = $request['searchkey'];
        $userRole = Auth::user()->roles->pluck('name')[0];

        $query = Tujuan::select()
            ->with(['perjalanan', 'spt', 'staff.staff', 'tempatTujuan', 'perjalanan.kegiatan', 'perjalanan.data_staff_perjalanan.staff', 'kegiatan', 'uploadLaporan'])
            ->whereHas('perjalanan.status_perjalanan', function ($query) {
                $query->where('id_status', '=', '2');
            })
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

    public function store(Request $request)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Data failed to update'];
            $filePath = $request->file('path_file');
            $fileName = time() . '_' . Str::random(10) . '.' . $filePath->getClientOriginalExtension();
            $path     = 'laporan/' . $request->input('id_kegiatan');

            $validator = Validator::make($request->all(), [
                'path_file' => 'required|mimes:pdf|max:200240',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'code' => 'EC001', 'message' => 'The maximum file size is 20 MB with the format PDF.']);
            }

            if ($validator->fails()) {
                return response()->json(['status' => false, 'code' => 'EC001', 'message' => 'The maximum file size is 10 MB with the format PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, TXT, CSV, PNG, JPG, JPEG, RAR, ZIP.']);
            }
            $extension = $request->file('path_file')->extension();
            Storage::disk('public')->putFileAs($path, $request->file('path_file'), $fileName);

            // Create the record in the database
            $create = UploadLaporan::create([
                'id_tujuan_perjalanan' => $request->input('id_tujuan_perjalanan'),
                // 'id_kegiatan' => $request->input('id_kegiatan'),
                'name_file'      => $request->input('name_file'),
                'path_file'           => $fileName,
            ]);

            if ($create) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Laporan successfully created'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. Please try again later. ' . $ex];
        }

        return $data;
    }

    public function show($id)
    {
        try {
            $data = ['status' => false, 'message' => 'Laporan failed to be found'];
            $data = Tujuan::findOrFail($id);
            if ($data) {
                $data = ['status' => true, 'message' => 'Laporan was successfully found', 'data' => $data];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;
    }

    public function showing($id)
    {
        try {
            $data = ['status' => false, 'message' => 'Laporan failed to be found'];
            $data = UploadLaporan::with(['kegiatan'])->findOrFail($id);
            if ($data) {
                $data = ['status' => true, 'message' => 'Laporan was successfully found', 'data' => $data];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;
    }

    //download file
    public function downloadFile($id)
    {
        $data = UploadLaporan::findOrFail($id);
        $path = 'laporan' . DIRECTORY_SEPARATOR . $data->id_kegiatan . DIRECTORY_SEPARATOR;
        $fileName = $data->path_file;
        $filePath = 'app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . $path . $fileName;

        $path = storage_path($filePath);

        return \Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $fileName . '"'
        ]);
    }
}
