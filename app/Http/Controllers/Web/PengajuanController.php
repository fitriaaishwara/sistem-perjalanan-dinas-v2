<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DataStaffPerjalanan;
use App\Models\LogStatusPerjalanan;
use App\Models\Perjalanan;
use App\Models\PerjalananDinas;
use App\Models\Staff;
use App\Models\Tujuan;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class PengajuanController extends Controller
{
    public function index()
    {
        return view('pages.master.pengajuan.admin.index');
    }

    public function create()
    {
        return view('pages.master.pengajuan.admin.create');
    }

    public function stores(Request $request) {
        dd($request->all());
    }

    public function store(Request $request) {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Perjalanan failed to create'];
            $create = Perjalanan::create([
                'id_mak' => $request['id_mak'],
                'perihal_perjalanan' => $request['perihal_perjalanan'],
                'estimasi_biaya' => $request['estimasi_biaya'],
                'description' => $request['description']
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
            $data = ['status' => false, 'message' => 'Jabatan failed to be found'];
            $data = Perjalanan::findOrFail($id);
            if ($data) {
                $data = ['status' => true, 'message' => 'Jabatan was successfully found', 'data' => $data];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }

        return view('pages.master.pengajuan.admin.edit', compact('data','perjalanan', 'staff'));
    }

    function save_staff(Request $request, $id_perjalanan) {

        // Validator::make($request->all(), [
        //     'id_staff' => 'required',
        //     'id_tujuan_perjalanan' => 'required',
        // ])->validate();
        // if (Validator::fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        $id_staff = $request->id_staff;
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

        $staff->id_staff = $id_staff;
        $staff->id_tujuan_perjalanan = $id_tujuan_perjalanan;
        $staff->save();

        return redirect()->back() -> with('success', 'Data berhasil disimpan');
    }

    public function createId($id)
    {

        $perjalanan = Perjalanan::with('tujuan', 'mak', 'data_staff_perjalanan')->findOrFail($id);

        $staff = Staff::where('status', 1)->get();

        try {
            $data = ['status' => false, 'message' => 'Jabatan failed to be found'];
            $data = Perjalanan::findOrFail($id);
            if ($data) {
                $data = ['status' => true, 'message' => 'Jabatan was successfully found', 'data' => $data];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }

        return view('pages.master.pengajuan.admin.tujuan', compact('data','perjalanan', 'staff'));
    }

    public function getData(Request $request)
    {
        $keyword = $request['searchkey'];

        $data = Perjalanan::select()
            ->with('mak', 'tujuan', 'tujuan.tempatBerangkat', 'tujuan.tempatTujuan', 'log_status_perjalanan')
            ->offset($request['start'])
            ->limit(($request['length'] == -1) ? Perjalanan::where('status', true)->count() : $request['length'])
            ->when($keyword, function ($query, $keyword) {
                return $query->where('perihal_perjalanan', 'like', '%' . $keyword . '%')
                    ->orWhereHas('mak', function ($query) use ($keyword) {
                        return $query->where('kode_mak', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('tujuan', function ($query) use ($keyword) {
                        return $query->where('tempat_tujuan', 'like', '%' . $keyword . '%');
                    });
            })
            ->where('status', true)
            ->get();

        $dataCounter = Perjalanan::select()
            ->when($keyword, function ($query, $keyword) {
                return $query->where('perihal_perjalanan', 'like', '%' . $keyword . '%');
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
                'description' => $request->input('description')
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
            $data = ['status' => false, 'message' => 'Jabatan failed to be found'];
            $data = Perjalanan::find($id);
            if ($data) {
                $data = ['status' => true, 'message' => 'Jabatan was successfully found', 'data' => $data];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;
    }

     public function update_status(Request $request, $id)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Perjalanan failed to update'];
            $update = Perjalanan::where('id', $id)->update([
                'id_perjalanan' => $request['id_perjalanan'],
                'status_perjalanan' => $request['status_perjalanan'],
                'description' => $request['description']
            ]);
            if ($update) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Perjalanan successfully updated'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;
    }
}
