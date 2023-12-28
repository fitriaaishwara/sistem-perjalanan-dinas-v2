<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Instansi;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $instansi = Instansi::where('status', true)->get();
        return view('pages.master.staff.index', compact('instansi'));
    }

    public function getData(Request $request)
    {
        $keyword = $request['searchkey'];

        $data = Staff::select()
            ->with(['golongans', 'jabatans', 'instansis'])
            ->offset($request['start'])
            ->limit(($request['length'] == -1) ? Staff::where('status', true)->count() : $request['length'])
            ->when($keyword, function ($query, $keyword) {
                //name nip golongan jabatan instansi
                return $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('nip', 'like', '%' . $keyword . '%')
                    ->orWhereHas('golongans', function ($query) use ($keyword) {
                        return $query->where('name', 'like', '%' . $keyword . '%');
                    });
            })
            ->where('status', true)
            ->get();

        $dataCounter = Staff::select()
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('nip', 'like', '%' . $keyword . '%')
                    ->orWhereHas('golongans', function ($query) use ($keyword) {
                        return $query->where('name', 'like', '%' . $keyword . '%');
                    });
            })
            ->where('status', true)
            ->count();
        $response = [
            'status'          => true,
            'draw'            => $request['draw'],
            'recordsTotal'    => Staff::where('status', true)->count(),
            'recordsFiltered' => $dataCounter,
            'data'            => $data,
        ];
        return $response;
    }
    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Staff failed to create'];
               // Check if NIP already exists
            $existingStaff = Staff::where('nip', $request['nip'])->first();

            if ($existingStaff) {
                // NIP already exists, return an error
                $data = ['status' => false, 'code' => 'EC002', 'message' => 'NIP already exists'];
            } else {
                // NIP does not exist, proceed with creating a new record
                $create = Staff::create([
                    'nip'         => $request['nip'],
                    'name'        => strtoupper($request['name']),
                    'jenis'       => $request['jenis'],
                    'id_golongan' => $request['id_golongan'],
                    'id_jabatan'  => $request['id_jabatan'],
                    'id_instansi' => $request['id_instansi'],
                    'updated_by'  => auth()->user()->id,
                ]);

                if ($create) {
                    $data = ['status' => true, 'code' => 'SC001', 'message' => 'Staff successfully created'];
                } else {
                    $data = ['status' => false, 'code' => 'EC001', 'message' => 'Staff failed to create'];
                }
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;
    }
    public function show($id)
    {
        try {
            $data = ['status' => false, 'message' => 'Staff failed to be found'];
            $data = Staff::with(['golongans', 'jabatans', 'instansis','kwitansiBendahara','kwitansiPejabat','dataStaffPerjalanan'])->where('id', $id)->first();

            switch ($data->jenis) {
                case '0':
                    $data->jenis_name = "PNS";
                    break;

                case '1':
                    $data->jenis_name = "Non PNS (PPPK)";
                    break;

                case '2':
                    $data->jenis_name = "Honorer";
                    break;

                default:
                    $data->jenis_name = "-";
                    break;
            };

            if ($data) {
                $data = ['status' => true, 'message' => 'Staff was successfully found', 'data' => $data];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;
    }
    public function update(Request $request)
    {

        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Staff failed to update'];
            $lainnya_instansi_id = Instansi::select('id') -> where('name', 'Lainnya') -> first() -> id;
            // // dd((int) $request->instansi_id == (int) $lainnya_instansi_id);

            // jika instansi_id lainnya maka create data
            if((int) $request->instansi_id == (int) $lainnya_instansi_id) {

                $cek_instansi = Instansi::where('name', $request->instansi_id) -> first();
                if(!$cek_instansi) {
                    $instansi = new Instansi();
                    $instansi->name = $request->instansi_other_id;
                    $instansi->save();
                    $instansiID = $instansi->id;
                } else {
                    $instansiID = $cek_instansi -> id;
                }

            } else {
                $instansiID = $request->instansi_id;
            }

            $update = Staff::where('id', $request['id'])->update([
                'nip' => $request['nip'],
                'name'        => strtoupper($request['name']),
                'id_golongan' => $request['id_golongan'],
                'id_jabatan' => $request['id_jabatan'],
                'id_instansi' => $instansiID,
                'jenis' => $request['jenis'],
            ]);
            if ($update) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Staff successfully updated'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex -> getLine()];
        }
        return $data;
    }
    public function destroy($id)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Staff failed to delete'];
            $delete = Staff::where('id', $id)->update([
                'status' => false
            ]);
            if ($delete) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Staff deleted successfully'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;
    }
}
