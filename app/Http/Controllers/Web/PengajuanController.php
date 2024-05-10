<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DataKegiatan;
use App\Models\DataStaffPerjalanan;
use App\Models\DataUangHarian;
use App\Models\LogStatusPerjalanan;
use App\Models\Perjalanan;
use App\Models\PerjalananDinas;
use App\Models\Staff;
use App\Models\Tujuan;
use App\Models\UangHarian;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class PengajuanController extends Controller
{
    public function index()
    {
        return view('pages.perjalanan.pengajuan.admin.index');
    }

    public function create()
    {
        return view('pages.perjalanan.pengajuan.admin.create');
    }

    public function stores(Request $request)
    {
        dd($request->all());
    }

    public function store(Request $request)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Perjalanan failed to create'];
            $create = Perjalanan::create([
                'id_mak' => $request['id_mak'],
            ]);

            if ($create) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Perjalanan successfully created'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }

        //if else return with Alert Sweet Alert and redirect to route or view or url page
        if ($data['status'] == true) {
            Alert::success('Success', $data['message']);
            return redirect()->route('pengajuan/createId', ['id' => $create->id]);
        } else {
            Alert::error('Error', $data['message']);
            return redirect()->back();
        }
    }

    public function edit($id)
    {

        $perjalanan = Perjalanan::with(['tujuan'])->findOrFail($id);

        $staff = Staff::where('status', 1)->get();

        try {
            $data = ['status' => false, 'message' => 'Status failed to be found'];
            $data = Perjalanan::with(['data_staff_perjalanan', 'mak'])->findOrFail($id);
            if ($data) {
                $data = ['status' => true, 'message' => 'Status was successfully found', 'data' => $data];
            }

            $value = Perjalanan::with(['data_staff_perjalanan', 'mak'])->findOrFail($id);

            $dataStaff = DataStaffPerjalanan::with([
                'staff.golongans', 'tujuan_perjalanan.uangHarian',
                'tujuan_perjalanan.tempatTujuan.hotel',
                'tujuan_perjalanan.tempatTujuan.tiket',
                'tujuan_perjalanan.tempatTujuan.translok'
            ])->where('id_perjalanan', $value->id)->get();

            $totalHotel = 0;
            $totalTiket = 0;
            $totalTranslok = 0;
            $uangHarian = 0;
            foreach ($dataStaff as $valueStaff) {
                $hotel = $valueStaff->tujuan_perjalanan[0]->tempatTujuan->hotel->first(function ($item) use ($valueStaff) {
                    return $item['id_golongan'] === $valueStaff->staff->golongans->id;
                });

                $tiket = $valueStaff->tujuan_perjalanan[0]->tempatTujuan->tiket->first(function ($item) use ($valueStaff) {
                    return $item['id_golongan'] === $valueStaff->staff->golongans->id;
                });

                $translok = $valueStaff->tujuan_perjalanan[0]->tempatTujuan->translok->first(function ($item) use ($valueStaff) {
                    return $item['id_golongan'] === $valueStaff->staff->golongans->id;
                });
                $uangHarian += $valueStaff->tujuan_perjalanan[0]->uangHarian->nominal * $valueStaff->tujuan_perjalanan[0]->lama_perjalanan;
                $totalHotel += $hotel->nominal;
                $totalTiket += $tiket->nominal;
                $totalTranslok += $translok->nominal;
            }
            $total = $totalHotel + $totalTiket + $totalTranslok + $uangHarian;

            $saldo = $value->mak->saldo_pagu - $total;
            if ($saldo > 0) {
                Alert::success('Saldo Terpenuhi', 'Success');
            } else {
                Alert::error('Saldo Mata Anggaran Kegiatan Tidak Mencukupi', 'Fail');
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }

        return view('pages.perjalanan.pengajuan.admin.edit', compact('data', 'perjalanan', 'staff'));
    }

    function save_staff(Request $request, $id_perjalanan)
    {
        $nip_staff = $request->nip_staff;
        $id_tujuan_perjalanan = $request->id_tujuan_perjalanan;

        $staff = new DataStaffPerjalanan;
        $staff->status = 1;
        $staff->created_by = Auth::id();
        $staff->updated_by = Auth::id();
        $staff->id_perjalanan = $id_perjalanan;

        // if id_edit contains value, then update data
        if ($request->has('id_edit') and !empty($request->id_edit)) {
            $staff = DataStaffPerjalanan::findOrFail($request->id_edit);
        }

        $staff->nip_staff = $nip_staff;
        $staff->id_tujuan_perjalanan = $id_tujuan_perjalanan;
        $staff->save();

        // Save data into Data_Kegiatan_Perjalanan table
        $kegiatan = new DataKegiatan;
        $kegiatan->id_perjalanan = $id_perjalanan;
        $kegiatan->id_tujuan = $id_tujuan_perjalanan;
        $kegiatan->nip_staff = $nip_staff;
        $kegiatan->id_kegiatan = $request->id_kegiatan_tujuan; // Assuming this field is coming from the request
        $kegiatan->status = 1;
        $kegiatan->created_by = Auth::id();
        $kegiatan->updated_by = Auth::id();
        $kegiatan->save();

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function createId($id)
    {

        $perjalanan = Perjalanan::with('tujuan', 'mak', 'data_staff_perjalanan')->findOrFail($id);

        $staff = Staff::where('status', 1)->get();

        try {
            $data = ['status' => false, 'message' => 'Status failed to be found'];
            $data = Perjalanan::findOrFail($id);
            if ($data) {
                $data = ['status' => true, 'message' => 'Status was successfully found', 'data' => $data];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }

        return view('pages.perjalanan.pengajuan.admin.tujuan', compact('data', 'perjalanan', 'staff'));
    }

    public function getData(Request $request)
    {
        $keyword = $request['searchkey'];
        $userRole = Auth::user()->roles->pluck('name')[0];

        $data = Perjalanan::select()
            ->with(['mak', 'tujuan', 'tujuan.tempatBerangkat', 'tujuan.tempatTujuan', 'log_status_perjalanan', 'kegiatan', 'data_staff_perjalanan.staff'])
            ->whereDoesntHave('log_status_perjalanan', function ($query) {
                $query->where('status_perjalanan', 'Disetujui');
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
            $query->where('status_perjalanan', 'Disetujui');
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


    public function store_status(Request $request)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Perjalanan failed to create'];
            $create = LogStatusPerjalanan::create([
                'id_perjalanan' => $request->input('id_perjalanan'),
                'status_perjalanan' => $request->input('status_perjalanan'),
                'description' => $request->input('description'),
                'direvisi_oleh' => $request->input('direvisi_oleh'),
            ]);

            if ($create) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Perjalanan successfully created'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }

        return $data;
    }

    public function show_status($id)
    {
        try {
            $data = ['status' => false, 'message' => 'Status failed to be found'];
            $data = Perjalanan::find($id);
            if ($data) {
                $data = ['status' => true, 'message' => 'Status was successfully found', 'data' => $data];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;
    }

    public function update_status(Request $request, $id)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Status failed to update'];
            $update = Perjalanan::where('id', $id)->update([
                'id_perjalanan' => $request['id_perjalanan'],
                'status_perjalanan' => $request['status_perjalanan'],
                'description' => $request['description'],
                'direvisi_oleh' => $request['direvisi_oleh'],
            ]);
            if ($update) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Status successfully updated'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;
    }

    public function destroy($id)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Perjalanan failed to delete'];
            $delete = Perjalanan::where('id', $id)->update([
                'status' => false
            ]);
            if ($delete) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Perjalanan deleted successfully'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;
    }
}
