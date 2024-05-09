<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DataStaffPerjalanan;
use App\Models\Geotaging;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class GeoTaggingController extends Controller
{
    public function index()
    {
        return view('pages.pra-perjalanan.dokumentasi.geotagging.index');
    }

    public function getData(Request $request)
    {
        $keyword = $request['searchkey'];
        $userRole = Auth::user()->roles->pluck('name')[0];

        $query = DataStaffPerjalanan::with(['staff', 'perjalanan', 'perjalanan.mak', 'tujuan_perjalanan.tempatTujuan', 'spd', 'kwitansi', 'geotaging', 'perjalanan.kegiatan'])
            ->where('status', true);

        // If the user is not a super admin, filter data based on user's ID
        if ($userRole != 'Super Admin') {
            $query->whereHas('staff', function ($query) {
                $query->where('id_user', Auth::id());
            });
        }

        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->whereHas('staff', function ($query) use ($keyword) {
                    $query->where('name', 'like', '%' . $keyword . '%');
                })
                ->orWhereHas('staff', function ($query) use ($keyword) {
                    $query->where('nip', 'like', '%' . $keyword . '%');
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
                ->orWhereHas('tujuan_perjalanan', function ($query) use ($keyword) {
                    $query->whereHas('tempatTujuan', function ($query) use ($keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%');
                    });
                })
                ->orWhereHas('spd', function ($query) use ($keyword) {
                    $query->where('nomor_spd', 'like', '%' . $keyword . '%');
                })
                ->orWhereHas('tujuan_perjalanan', function ($query) use ($keyword) {
                    $query->where('tanggal_berangkat', 'like', '%' . $keyword . '%')
                          ->orWhere('tanggal_pulang', 'like', '%' . $keyword . '%');
                });
            });
        }

        $data = $query->offset($request['start'])
            ->limit(($request['length'] == -1) ? DataStaffPerjalanan::where('status', true)->count() : $request['length'])
            ->get();

        $dataCounter = $query->count();

        $response = [
            'status'          => true,
            'draw'            => $request['draw'],
            'recordsTotal'    => DataStaffPerjalanan::where('status', true)->count(),
            'recordsFiltered' => $dataCounter,
            'data'            => $data,
        ];

        return $response;
    }

    public function create($id)
    {
        $dataStaff = DataStaffPerjalanan::findOrFail($id);
        return view('pages.pra-perjalanan.dokumentasi.geotagging.create', compact('dataStaff'));
    }

    public function show($id)
    {
        $geoTagging = Geotaging::findOrFail($id);
        return view('pages.pra-perjalanan.dokumentasi.geotagging.view', compact('geoTagging'));
    }

    public function store(Request $request)
{
    // Check if image data is provided
    if ($request->has('image')) {
        // Get the base64 image data
        $image = $request->image;

        // Check if the base64 data is valid
        if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
            $data = substr($image, strpos($image, ',') + 1);
            $type = strtolower($type[1]); // png, jpeg, gif

            // Check if the image type is supported
            if (in_array($type, ['png', 'jpeg', 'gif'])) {
                // Generate a unique image name
                $imageName = time() . '.' . $type;

                // Store the image
                Storage::disk('public')->put('images/' . $imageName, base64_decode($data));

                // Create a new Geotaging instance and save it
                $photo = new Geotaging();
                $photo->user_id = auth()->id();
                $photo->id_staff_perjalanan = $request->id_staff_perjalanan;
                $photo->image_path = $imageName;
                $photo->latitude = $request->latitude;
                $photo->longitude = $request->longitude;
                $photo->save();

                // Redirect with success message
                return redirect()->route('geo-tagging')->with('success', 'Image uploaded successfully!');
            } else {
                // Unsupported image format
                return redirect()->route('geo-tagging')->with('error', 'Unsupported image format!');
            }
        } else {
            // Invalid base64 data
            return redirect()->route('geo-tagging')->with('error', 'Invalid image data!');
        }
    } else {
        // No image data provided
        return redirect()->route('geo-tagging')->with('error', 'No image uploaded!');
    }
}

    // public function storeGeotagging(Request $request)
    // {
    //     $img = $request->image_path;

    //     if (strpos($img, ';base64,') !== false) {
    //         $image_parts = explode(";base64,", $img);
    //         $image_type_aux = explode("image/", $image_parts[0]);
    //         $image_type = $image_type_aux[1] ?? null;

    //         if ($image_type && isset($image_parts[1])) {
    //             $image_base64 = base64_decode($image_parts[1]);
    //             $fileName = uniqid() . '.png';

    //             // Save image to storage
    //             Storage::put('uploads/' . $fileName, $image_base64);

    //             return 'Image uploaded successfully: ' . $fileName;
    //         } else {
    //             return 'Invalid image format';
    //         }
    //     } else {
    //         return 'Invalid image data';
    //     }
    // }
}
