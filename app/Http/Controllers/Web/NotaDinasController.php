<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DataStaffPerjalanan;
use App\Models\Kegiatan;
use App\Models\nd_tembusan;
use App\Models\NotaDinas;
use App\Models\Perjalanan;
use App\Models\Staff;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class NotaDinasController extends Controller
{
    public function index()
    {
        return view('pages.pre-perjalanan.nota_dinas.index');
    }

    public function indexDownload()
    {
        return view('pages.pre-perjalanan.nota_dinas.index-download');
    }

    public function getData(Request $request)
    {
        $keyword = $request['searchkey'];
        $userRole = Auth::user()->roles->pluck('name')[0];

        $query = Perjalanan::select()
            ->with('mak', 'tujuan.tempatBerangkat', 'tujuan.tempatTujuan', 'tujuan.staff', 'nota_dinas', 'kegiatan', 'data_staff_perjalanan.staff')
            ->where('status', true);

        // If the user is not a super admin, filter data based on user's ID
        if ($userRole != 'Super Admin') {
            $query->whereHas('data_staff_perjalanan.staff', function ($query) {
                $query->where('id_user', Auth::id());
            });
        }

        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->whereHas('mak', function ($query) use ($keyword) {
                    $query->where('kode_mak', 'like', '%' . $keyword . '%');
                })
                ->orWhereHas('mak', function ($query) use ($keyword) {
                    $query->where('kode_mak', 'like', '%' . $keyword . '%');
                })
                ->orWhereHas('kegiatan', function ($query) use ($keyword) {
                    $query->where('kegiatan', 'like', '%' . $keyword . '%');
                })
                ->orWhereHas('tujuan', function ($query) use ($keyword) {
                    $query->whereHas('tempatTujuan', function ($query) use ($keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%');
                    });
                })
                ->orWhereHas('tujuan', function ($query) use ($keyword) {
                    $query->where('tanggal_berangkat', 'like', '%' . $keyword . '%')
                          ->orWhere('tanggal_pulang', 'like', '%' . $keyword . '%');
                });
            });
        }

        $data = $query->get();

        return DataTables::of($data)->make(true);
    }

    public function create($id)
    {
        $perjalanan = Perjalanan::find($id);
        $staff = Staff::where('status', true)->get();
        return view('pages.pre-perjalanan.nota_dinas.create', compact('perjalanan', 'staff'));
    }

    public function edit($id)
    {
        $perjalanan = Perjalanan::with(['nota_dinas']) -> find($id);
        $notadinas = NotaDinas::with(['perjalanan', 'staff']) -> where('id_perjalanan', $id) -> first();
        $staff = Staff::where('status', true)->get();
        return view('pages.pre-perjalanan.nota_dinas.edit', compact('perjalanan', 'staff', 'notadinas'));
    }

    public function pdf($id)
    {
        $perjalanan = Perjalanan::with(['nota_dinas', 'tujuan', 'mak', 'tujuan.staff', 'tujuan.tempatBerangkat', 'tujuan.tempatTujuan', 'tujuan.uploadLaporan', 'tujuan.uploadGallery'])->find($id);
        $dataStaff = DataStaffPerjalanan::with(['perjalanan', 'staff', 'tujuan_perjalanan.tempatBerangkat', 'tujuan_perjalanan.tempatTujuan'])->where('id_perjalanan', $id)->get();
        $data = NotaDinas::with(['perjalanan', 'staff', 'tembusan'])->where('id_perjalanan', $id)->first();
        $staff = Staff::where('status', true)->get();
        //pdf
        if ($data) {
            $pdf = \PDF::loadView('pages.pre-perjalanan.nota_dinas.pdf', compact('perjalanan', 'staff', 'data', 'dataStaff'));
            return $pdf->stream();
        } else {
            //return redirect with Alert
            //css for alert
            alert()->warning('', 'Data Not Found');
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'nomor_nota_dinas' => 'required|string',
            'yth' => 'required|string',
            'dari' => 'required|string',
            'perihal' => 'required|string',
            'lampiran' => 'required|string',
            'tanggal_nota_dinas' => 'required|date',
            'isi_nota_dinas' => 'required|string',
            'nip_staff_penandatangan' => 'required|exists:staff,nip',
            'id_perjalanan' => 'required|exists:perjalanan,id',
            'status_nota_dinas_hidden' => 'required|boolean', // Ensure it's a boolean value
        ]);

        // Create a new NotaDinas instance
        $notaDinas = new NotaDinas();
        $notaDinas->nomor_nota_dinas = $validatedData['nomor_nota_dinas'];
        $notaDinas->yth = $validatedData['yth'];
        $notaDinas->dari = $validatedData['dari'];
        $notaDinas->perihal = $validatedData['perihal'];
        $notaDinas->lampiran = $validatedData['lampiran'];
        $notaDinas->tanggal_nota_dinas = $validatedData['tanggal_nota_dinas'];
        $notaDinas->isi_nota_dinas = $validatedData['isi_nota_dinas'];
        $notaDinas->nip_staff_penandatangan = $validatedData['nip_staff_penandatangan'];
        $notaDinas->id_perjalanan = $validatedData['id_perjalanan'];
        $notaDinas->status_nota_dinas = $validatedData['status_nota_dinas_hidden']; // Use the hidden field value

        // Save the NotaDinas instance
        $notaDinas->save();

        // Check if keterangan is provided and save to nd_tembusan
        if ($request->has('keterangan')) {
            $ndTembusan = new nd_tembusan();
            $ndTembusan->keterangan = $request->keterangan;
            $ndTembusan->id_nota_dinas = $notaDinas->id; // Set the id_nota_dinas
            $ndTembusan->save();
        }

        // Redirect back with success message
        return redirect()->back()->with('success', 'Nota Dinas saved successfully');
    }

    public function update(Request $request, $id)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Jabatan failed to create'];
            $create =  NotaDinas::find($id) -> update([
                'id_perjalanan' => $request->id_perjalanan,
                'nip_staff_penandatangan' => $request->nip_staff_penandatangan,
                'nomor_nota_dinas' => $request->nomor_nota_dinas,
                'yth' => $request->yth,
                'dari' => $request->dari,
                'perihal' => $request->perihal,
                'lampiran' => $request->lampiran,
                'tanggal_nota_dinas' => $request->tanggal_nota_dinas,
                'isi_nota_dinas' => $request->isi_nota_dinas,
                'status_nota_dinas' => $request->status_nota_dinas,
            ]);

            if ($create) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'Jabatan successfully edited'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }

        // return $data;
        return redirect() -> back() -> with('success', $data['message']);
    }

    public function updateStatus(Request $request, $id)
    {
        $notaDinas = NotaDinas::findOrFail($id);
        $notaDinas->status_nota_dinas = $request->status_nota_dinas;
        $notaDinas->save();

        return redirect()->route('nota-dinas')->with('success', 'Nota Dinas status updated successfully.');

    }

}
