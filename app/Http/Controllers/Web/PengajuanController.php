<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DataKegiatan;
use App\Models\DataStaffPerjalanan;
use App\Models\DataUangHarian;
use App\Models\LogStatusPerjalanan;
use App\Models\Mak;
use App\Models\Perjalanan;
use App\Models\PerjalananDinas;
use App\Models\Province;
use App\Models\Staff;
use App\Models\Tujuan;
use App\Models\UangHarian;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

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
            $dataTujuanAll = Tujuan::where('id_perjalanan', $id)->with('kegiatan', 'tempatBerangkat', 'tempatTujuan')->get();
            if ($data) {
                $data = ['status' => true, 'message' => 'Status was successfully found', 'data' => $data];
            }

            $value = Perjalanan::with(['data_staff_perjalanan', 'mak'])->findOrFail($id);

            $dataStaff = DataStaffPerjalanan::with([
                'staff.golongans', 'tujuan_perjalanan.uangHarian','staff.jabatans',
                'tujuan_perjalanan.tempatTujuan.hotel',
                'tujuan_perjalanan.tempatTujuan.tiket',
                'tujuan_perjalanan.tempatTujuan.translok'
            ])->where('id_perjalanan', $value->id)->get();

            $totalHotel = 0;
            $totalTiket = 0;
            $totalTranslok = 0;
            $uangHarian = 0;
            // foreach ($dataStaff as $valueStaff) {
            //     $hotel = $valueStaff->tujuan_perjalanan[0]->tempatTujuan->hotel->first(function ($item) use ($valueStaff) {
            //         return $item['id_golongan'] === $valueStaff->staff->golongans->id;
            //     });

            //     $tiket = $valueStaff->tujuan_perjalanan[0]->tempatTujuan->tiket->first(function ($item) use ($valueStaff) {
            //         return $item['id_golongan'] === $valueStaff->staff->golongans->id;
            //     });

            //     $translok = $valueStaff->tujuan_perjalanan[0]->tempatTujuan->translok->first(function ($item) use ($valueStaff) {
            //         return $item['id_golongan'] === $valueStaff->staff->golongans->id;
            //     });
            //     $uangHarian += $valueStaff->tujuan_perjalanan[0]->uangHarian->nominal * $valueStaff->tujuan_perjalanan[0]->lama_perjalanan;
            //     $totalHotel += $hotel->nominal;
            //     $totalTiket += $tiket->nominal;
            //     $totalTranslok += $translok->nominal;
            // }
            foreach ($dataStaff as $valueStaff) {
                $jabatanId = null;
                if ($valueStaff->staff->jabatans && $valueStaff->staff->jabatans->id) {
                    $jabatanId = $valueStaff->staff->jabatans->jabatanStruktural->id;
                } else {
                    $jabatanId = $valueStaff->staff->golongans->id;
                }

                // Gunakan $jabatanId sesuai kebutuhan Anda
                // Misalnya, untuk debug, Anda bisa mencetaknya:
                // echo $jabatanId;

                $hotel = $valueStaff->tujuan_perjalanan[0]->tempatTujuan->hotel->first(function ($item) use ($jabatanId) {
                    return $item['id_golongan'] === $jabatanId;
                });

                $tiket = $valueStaff->tujuan_perjalanan[0]->tempatTujuan->tiket->first(function ($item) use ($jabatanId) {
                    return $item['id_golongan'] === $jabatanId;
                });

                $translok = $valueStaff->tujuan_perjalanan[0]->tempatTujuan->translok->first(function ($item) use ($jabatanId) {
                    return $item['id_golongan'] === $jabatanId;
                });
                $uangHarian += $valueStaff->tujuan_perjalanan[0]->uangHarian->nominal * $valueStaff->tujuan_perjalanan[0]->lama_perjalanan;
                $totalHotel += $hotel->nominal;
                $totalTiket += $tiket->nominal;
                $totalTranslok += $translok->nominal;
            }
            $total = $totalHotel + $totalTiket + $totalTranslok + $uangHarian;

            // $saldo = $value->mak->saldo_pagu - $total;
            // if ($saldo > 0) {
            //     Alert::success('Saldo Terpenuhi', 'Success');
            // } else {
            //     Alert::error('Saldo Mata Anggaran Kegiatan Tidak Mencukupi', 'Fail');
            // }

        } catch (\Exception $ex) {
            $data = ['status' => false, 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }

        return view('pages.perjalanan.pengajuan.admin.edit', compact('data', 'perjalanan', 'staff', 'dataTujuanAll'));

    }

    function save_staff(Request $request, $id_perjalanan)
    {
        $id_staff = $request->id_staff;
        $id_tujuan_perjalanan = $request->id_tujuan_perjalanan;

        //check when tanggal_berangkat and tanggal_pulang staff have perjalanan. then cant add data staff perjalnanan and showing alert
        $check = DataStaffPerjalanan::where('id_staff', $id_staff)
            ->whereHas('tujuan_perjalanan', function ($query) use ($id_tujuan_perjalanan) {
                    $query->where('id', $id_tujuan_perjalanan);
                })
                ->whereHas('tujuan_perjalanan', function ($query) use ($id_tujuan_perjalanan) {
                        $query->where('id', $id_tujuan_perjalanan);
                    })
                    ->count();

                    if ($check > 0) {
                        Alert::error('Error', 'Staff sudah terdaftar pada tujuan perjalanan ini');
                        return redirect()->back();
                    }

        $staff = new DataStaffPerjalanan;
        $staff->status = 1;
        $staff->created_by = Auth::id();
        $staff->updated_by = Auth::id();
        $staff->id_perjalanan = $id_perjalanan;

        // if id_edit contains value, then update data
        if ($request->has('id_edit') and !empty($request->id_edit)) {
            $staff = DataStaffPerjalanan::findOrFail($request->id_edit);
        }

        $staff->id_staff = $id_staff;
        $staff->id_tujuan_perjalanan = $id_tujuan_perjalanan;
        $staff->save();

        // Save data into Data_Kegiatan_Perjalanan table
        // $kegiatan = new DataKegiatan;
        // $kegiatan->id_perjalanan = $id_perjalanan;
        // $kegiatan->id_tujuan = $id_tujuan_perjalanan;
        // $kegiatan->id_staff = $id_staff;
        // $kegiatan->id_kegiatan = $request->id_kegiatan; // Assuming this field is coming from the request
        // $kegiatan->status = 1;
        // $kegiatan->created_by = Auth::id();
        // $kegiatan->updated_by = Auth::id();
        // $kegiatan->save();

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function createId($id)
    {

        $perjalanan = Perjalanan::with('mak', 'kegiatan.dataTujuan')->findOrFail($id);
        $dataTujuan = Province::get();
        $dataTujuanAll = Tujuan::where('id_perjalanan', $id)->with('kegiatan', 'tempatBerangkat', 'tempatTujuan')->get();
        $staff = Staff::where('status', 1)->get();

        // return response()->json($perjalanan);
        return view('pages.perjalanan.pengajuan.admin.tujuan', compact('perjalanan', 'staff', 'dataTujuan', 'dataTujuanAll'));
    }

    public function getData(Request $request)
    {
        $keyword = $request['searchkey'];
        $userRole = Auth::user()->roles->pluck('name')[0];

        $data = Perjalanan::select()
            ->with(['mak','kegiatan.dataTujuan', 'kegiatan.dataTujuan.tempatBerangkat', 'kegiatan.dataTujuan.tempatTujuan', 'log_status_perjalanan.status_perjalanan',
                    'kegiatan.dataTujuan.staff.staff', 'status_perjalanan'])
                    ->whereHas('status_perjalanan', function ($query) {
                        $query->where('id_status', '1');
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
        if ($userRole != 'Super Admin' && $userRole != 'Admin') {
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

    public function store_status(Request $request)
{
    try {
        response()->json($request->all());
        $data = ['status' => false, 'code' => 'EC001', 'message' => 'Perjalanan failed to create'];

        // Membuat entri di tabel LogStatusPerjalanan
        $create = LogStatusPerjalanan::create([
            'id_perjalanan' => $request->input('id_perjalanan'),
            'id_status_perjalanan' => $request->input('id_status_perjalanan'),
            'description' => $request->input('description'),
            'direvisi_oleh' => Auth::id(),
        ]);

        if ($create) {
            // Jika berhasil membuat entri di LogStatusPerjalanan, perbarui id_status_perjalanan di tabel Perjalanan
            $perjalanan = Perjalanan::find($request->input('id_perjalanan'));
            if ($perjalanan) {
                $perjalanan->id_status_perjalanan = $request->input('id_status_perjalanan');
                $perjalanan->save();

               // Jika id_status_perjalanan adalah 12, kurangi saldo_pagu dengan total_biaya
                if ($request->input('id_status_perjalanan') == 12) {
                    $sisaSaldo = Mak::where('id', $perjalanan->id_mak)->first();
                    if ($sisaSaldo) {
                        $saldoAwal = $sisaSaldo->saldo_pagu;

                        // Mengupdate mak.terealisasi
                        $sisaSaldo->terealisasi += $perjalanan->total_biaya;

                        // Mengupdate saldo_pagu
                        $sisaSaldo->saldo_pagu -= $perjalanan->total_biaya;

                        $sisaSaldo->save();

                        $data['saldo_awal'] = $saldoAwal;
                        $data['saldo_akhir'] = $sisaSaldo->saldo_pagu;
                    }
                }

                $data['status'] = true;
                $data['code'] = 'SC001';
                $data['message'] = 'Status successfully created';
            }
        }
    } catch (\Exception $ex) {
        $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex->getMessage()];
    }

    return response()->json($data);
}

    public function update_status(Request $request, $id)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Status failed to update'];
            $update = Perjalanan::where('id', $id)->update([
                'id_perjalanan' => $request['id_perjalanan'],
                'id_status_perjalanan' => $request['id_status_perjalanan'],
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

    public function update(Request $request, $id)
    {
        $perjalanan = Perjalanan::find($id);
        $perjalanan->id_mak = $request->id_mak;

        $perjalanan->save();

        if ($perjalanan->save()) {
            Alert::success('Success', 'Perjalanan has been updated');
        } else {
            Alert::error('Failed', 'Perjalanan failed to update');
        }

        return redirect()->route('pengajuan');
    }
}
