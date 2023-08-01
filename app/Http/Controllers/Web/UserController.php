<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.master.user.index');
    }

    public function getData(Request $request)
    {
        $keyword = $request['searchkey'];

        $users = User::select()
            ->with(['roles'])
            ->offset($request['start'])
            ->limit(($request['length'] == -1) ? User::count() : $request['length'])
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->oldest('name')
            ->get();

        $usersCounter = User::select()
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->count();

            // $roles = "";
            // foreach($users as $users) {
            //     foreach($users->roles as $role) {
            //         $roles .= $role->name;

            //         if($role != $users->roles->last()) {
            //             $roles .= ", ";
            //         }
            //     }

            //     $users->roles_concated = $roles;
            // }

        $response = [
            'status'          => true,
            'code'            => '',
            'message'         => '',
            'draw'            => $request['draw'],
            'recordsTotal'    => User::count(),
            'recordsFiltered' => $usersCounter,
            'data'            => $users,
        ];
        return $response;
    }
    public function show($id)
    {
        try {
            $data = ['status' => false, 'message' => 'User failed to be found'];
            $user = User::with(['roles'])->where('id', $id)->first();
            if ($user) {
                $data = ['status' => true, 'message' => 'User was successfully found', 'data' => $user];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;
    }
    public function store(Request $request)
    {
        //     dd($request->all());
        $fileName = Str::random(20);
        $path = 'images/user/';
        try {
            DB::beginTransaction();
            $data = ['status' => false, 'message' => 'User failed to create'];
            if (User::where('email', $request['email'])->exists()) {
                return $data = ['status' => false, 'message' => 'Email already exists'];
            }
            if (User::where('username', $request['username'])->exists()) {
                return $data = ['status' => false, 'message' => 'Username already exists'];
            }
            $validator = Validator::make($request->all(), [
                'photo' => 'image|mimes:jpg,jpeg,png|max:2048',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => 'Files cannot be larger than 2MB, in the format of jpg, jpeg, png']);
            }
            if ($request->file('photo') != null) {
                $extension = $request->file('photo')->extension();
                $photoName = $fileName . '.' . $extension;
                Storage::disk('public')->putFileAs($path, $request->file('photo'), $fileName . "." . $extension);
            } else {
                $photoName = null;
            }
            $user                = new User;
            $user->username      = $request['username'];
            $user->name          = ucwords($request['name']);
            $user->email         = $request['email'];
            $user->photo         = $photoName;
            $user->password      = Hash::make($request['password']);
            $user->save();

            $user->assignRole($request->role_id);

            if ($user) {
                DB::commit();
                $data = ['status' => true, 'message' => 'User successfully created'];
            }
        } catch (\Exception $ex) {
            DB::rollback();
            $data = ['status' => false, 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;
    }
    public function update(Request $request)
    {
        // dd($request->all());
        $fileName = Str::random(20);
        $path = 'images/user/';
        $user = User::find($request->id);
        try {
            DB::beginTransaction();
            $data = ['status' => false, 'message' => 'User failed to update'];
            if ($user->email != $request['email']) {
                if (User::where('email', $request['email'])->exists()) {
                    return $data = ['status' => false, 'code' => 'EC002', 'message' => 'Email already exists'];
                }
            }
            if ($user->username != $request['username']) {
                if (User::where('username', $request['username'])->exists()) {
                    return $data = ['status' => false, 'message' => 'Username already exists'];
                }
            }
            $validator = Validator::make($request->all(), [
                'photo' => 'image|mimes:jpg,jpeg,png|max:2048',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => 'Files cannot be larger than 2MB, in the format of jpg, jpeg, png']);
            }
            if ($request->file('photo') != null) {
                $extension = $request->file('photo')->extension();
                $photoName = $fileName . '.' . $extension;
                Storage::disk('public')->putFileAs($path, $request->file('photo'), $fileName . "." . $extension);
            } else {
                $photoName = null;
            }
            $user->username      = $request['username'];
            $user->name          = ucwords($request['name']);
            $user->email         = $request['email'];
            $user->photo         = $photoName;
            $user->save();

            if ($user) {
                DB::commit();
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'User updated successfully'];
            }
        } catch (\Exception $ex) {
            DB::rollback();
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;
    }
    public function changePassword(Request $request)
    {
        try {
            $data = ['status' => false, 'message' => 'Password failed to update'];

            $update = User::where('id', $request['id'])->update([
                'password' => Hash::make($request['password']),
            ]);
            if ($update) {
                $data = ['status' => true, 'message' => 'Password successfully updated'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;
    }
    public function updateActive(Request $request)
    {
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'User failed to update'];
            $is_active = ($request['is_active'] == "true") ? 1 : 0;

            $update = User::where('id', $request['id'])->update([
                'is_active'        => $is_active,
            ]);
            if ($update) {
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'User successfully updated'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;
    }
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $data = ['status' => false, 'message' => 'User failed to delete'];

            $user = User::find($id);
            $user->removeRole($user->roles->first());
            $user->delete();
            if ($user) {
                DB::commit();
                $data = ['status' => true, 'code' => 'SC001', 'message' => 'User deleted successfully'];
            }
        } catch (\Exception $ex) {
            $data = ['status' => false, 'code' => 'EEC001', 'message' => 'A system error has occurred. please try again later. ' . $ex];
        }
        return $data;
    }

    public function createUser(Request $request, $id)
    {
        $staff = Staff::find($id);
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'Staff failed to create'];
            $create = User::create([
                'name' => $staff->name,
                'username' => $staff->nip,
                'email' => $request['email'],
                'password' => bcrypt('12345678'),
            ]);
            if ($create) {
                Alert::success('Success', 'User successfully created');
            }
        } catch (\Exception $ex) {
            Alert::error('Error', 'A system error has occurred. please try again later. ' . $ex);
        }
        return $data;
    }

    public function status(Request $request, $id)
    {
        $user = User::find($id);
        try {
            $data = ['status' => false, 'code' => 'EC001', 'message' => 'User failed to update'];
            $user->is_active = !$user->is_active;
            $update = $user->save();

            // if ($update) {
            //     Alert::success('Success', 'User successfully updated');
            // }
        } catch (\Exception $ex) {
            Alert::error('Error', 'A system error has occurred. please try again later. ' . $ex);
        }
        return redirect()->back();
    }
}
