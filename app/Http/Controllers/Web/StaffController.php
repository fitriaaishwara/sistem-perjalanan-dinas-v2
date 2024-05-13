<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Instansi;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $instansi = Instansi::where('status', true)->get();
        return view('pages.master-data.staff.index', compact('instansi'));
    }

    public function getData(Request $request)
    {
        $keyword = $request->input('searchkey');

        $data = Staff::with(['golongans', 'jabatans', 'instansis'])
            ->where('status', true)
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('nip', 'like', '%' . $keyword . '%')
                    ->orWhereHas('golongans', function ($query) use ($keyword) {
                        return $query->where('name', 'like', '%' . $keyword . '%');
                    });
            })
            ->offset($request->input('start'))
            ->limit(($request->input('length') == -1) ? Staff::where('status', true)->count() : $request->input('length'))
            ->get();

        $dataCounter = Staff::when($keyword, function ($query, $keyword) {
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
            'draw'            => $request->input('draw'),
            'recordsTotal'    => Staff::where('status', true)->count(),
            'recordsFiltered' => $dataCounter,
            'data'            => $data,
        ];

        return $response;
    }

    public function store(Request $request)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Staff failed to create'];

            // Check if NIP already exists
            $existingStaff = Staff::where('nip', $request['nip'])->first();

            if ($existingStaff) {
                // NIP already exists, return an error
                $data = ['status' => false, 'code' => 'EC002', 'message' => 'NIP already exists'];
            } else {
                // Set default values for id_jabatan and id_golongan if they are empty
                $id_jabatan = $request['id_jabatan'] ?? '6';
                $id_golongan = $request['id_golongan'] ?? '3';

                // NIP does not exist, proceed with creating a new record
                $create = Staff::create([
                    'nip'         => $request['nip'],
                    'name'        => ucwords($request['name']),
                    'jenis'       => $request['jenis'],
                    'id_golongan' => $id_golongan,
                    'id_jabatan'  => $id_jabatan,
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

    public function show(Request $request, $nip)
    {
        try {
            $data = ['status' => false, 'message' => 'Staff failed to be found'];
            $data = Staff::with(['golongans', 'jabatans', 'instansis'])->where('nip', $nip)->first();
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
            $lainnya_id_instansi = Instansi::select('id') -> where('name', 'Lainnya') -> first() -> id;
            // // dd((int) $request->id_instansi == (int) $lainnya_id_instansi);

            // jika id_instansi lainnya maka create data
            if((int) $request->id_instansi == (int) $lainnya_id_instansi) {

                $cek_instansi = Instansi::where('name', $request->id_instansi) -> first();
                if(!$cek_instansi) {
                    $instansi = new Instansi();
                    $instansi->name = $request->instansi_other_id;
                    $instansi->save();
                    $instansiID = $instansi->id;
                } else {
                    $instansiID = $cek_instansi -> id;
                }

            } else {
                $instansiID = $request->id_instansi;
            }

            $update = Staff::where('nip', $request['nip'])->update([
                'nip' => $request['nip'],
                'name'        => ucwords($request['name']),
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
    public function destroy($nip)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Staff failed to delete'];
            $delete = Staff::where('nip', $nip)->update([
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
