<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);
        return view('pages.master-data.profile.profile', compact('user'));
    }

    public function update($id, Request $request)
    {
        $user = User::find($id);
        $user->name = ucwords($request->name);
        $user->username = $request->username;
        $user->email = $request->email;
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }
        if ($request->hasFile("photo")) {
            $photo = $request->file('photo');
            $fileName = $photo->getClientOriginalName();
            $photo->move(Storage::disk('public')->path('images/profile'), $fileName);
            $user->photo = $fileName;
        }
        $user->save();

        if ($user->save()) {
            Alert::success('Success', 'Profile has been updated');
        } else {
            Alert::error('Failed', 'Profile failed to update');
        }

        return redirect()->back();
    }

    public function updatePass($id, Request $request)
    {
        $user = User::find($id);
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        if ($user->save()) {
            Alert::success('Success', 'Password has been updated');
        } else {
            Alert::error('Failed', 'Password failed to update');
        }

        return redirect()->back();
    }




}
