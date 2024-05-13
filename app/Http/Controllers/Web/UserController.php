<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.management-user.user.index');
    }

    public function getData(Request $request)
    {
        $keyword = $request->input('searchkey');

        $usersQuery = User::with('roles')->orderBy('name');

        if ($keyword) {
            $usersQuery->where('name', 'like', '%' . $keyword . '%');
        }

        $users = $usersQuery->paginate($request->input('length', User::count()));

        return [
            'status'          => true,
            'code'            => '',
            'message'         => '',
            'draw'            => $request->input('draw'),
            'recordsTotal'    => User::count(),
            'recordsFiltered' => $users->total(),
            'data'            => $users->items(),
        ];
    }

    public function show($id)
    {
        try {
            $user = User::with('roles')->find($id);
            if ($user) {
                return ['status' => true, 'message' => 'User was successfully found', 'data' => $user];
            } else {
                return ['status' => false, 'message' => 'User not found'];
            }
        } catch (\Exception $ex) {
            return ['status' => false, 'message' => 'A system error has occurred. Please try again later.', 'error' => $ex->getMessage()];
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Files cannot be larger than 2MB, in the format of jpg, jpeg, png']);
        }

        try {
            DB::beginTransaction();

            if (User::where('email', $request['email'])->exists()) {
                return ['status' => false, 'message' => 'Email already exists'];
            }

            if (User::where('username', $request['username'])->exists()) {
                return ['status' => false, 'message' => 'Username already exists'];
            }

            $fileName = Str::random(20);
            $path = 'images/user/';
            $photoName = null;

            if ($request->hasFile('photo')) {
                $photoName = $fileName . '.' . $request->file('photo')->extension();
                $request->file('photo')->storeAs($path, $photoName, 'public');
            }

            $user = User::create([
                'username' => $request['username'],
                'name' => ucwords($request['name']),
                'email' => $request['email'],
                'photo' => $photoName,
                'password' => Hash::make($request['password']),
            ]);

            $user->assignRole($request->role_id);

            DB::commit();

            return ['status' => true, 'message' => 'User successfully created'];
        } catch (\Exception $ex) {
            DB::rollback();
            return ['status' => false, 'message' => 'A system error has occurred. Please try again later.', 'error' => $ex->getMessage()];
        }
    }



    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Files cannot be larger than 2MB, in the format of jpg, jpeg, png']);
        }

        $user = User::find($request->id);

        if (!$user) {
            return ['status' => false, 'message' => 'User not found'];
        }

        try {
            DB::beginTransaction();

            if ($user->email != $request['email'] && User::where('email', $request['email'])->exists()) {
                return ['status' => false, 'message' => 'Email already exists'];
            }

            if ($user->username != $request['username'] && User::where('username', $request['username'])->exists()) {
                return ['status' => false, 'message' => 'Username already exists'];
            }

            $fileName = Str::random(20);
            $path = 'images/user/';
            $photoName = null;

            if ($request->hasFile('photo')) {
                $photoName = $fileName . '.' . $request->file('photo')->extension();
                $request->file('photo')->storeAs($path, $photoName, 'public');
            }

            // Update user data
            $user->username = $request['username'];
            $user->name = ucwords($request['name']);
            $user->email = $request['email'];
            $user->photo = $photoName;
            $user->save();

            // Update user role
            $roles = $request->input('role_id'); // Assuming the input name is 'role_id'
            $user->syncRoles($roles); // This will sync the user's roles with the provided role IDs

            DB::commit();

            return ['status' => true, 'message' => 'User updated successfully'];
        } catch (\Exception $ex) {
            DB::rollback();
            return ['status' => false, 'message' => 'A system error has occurred. Please try again later.', 'error' => $ex->getMessage()];
        }
    }

    public function changePassword(Request $request)
    {
        try {
            $user = User::find($request['id']);

            if (!$user) {
                return ['status' => false, 'message' => 'User not found'];
            }

            $user->password = Hash::make($request['password']);
            $user->save();

            return ['status' => true, 'message' => 'Password successfully updated'];
        } catch (\Exception $ex) {
            return ['status' => false, 'message' => 'A system error has occurred. Please try again later.', 'error' => $ex->getMessage()];
        }
    }

    public function updateActive(Request $request)
    {
        try {
            $user = User::find($request['id']);

            if (!$user) {
                return ['status' => false, 'message' => 'User not found'];
            }

            $user->is_active = !$user->is_active;
            $user->save();

            return ['status' => true, 'message' => 'User updated successfully'];
        } catch (\Exception $ex) {
            return ['status' => false, 'message' => 'A system error has occurred. Please try again later.', 'error' => $ex->getMessage()];
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return ['status' => false, 'message' => 'User not found'];
            }

            DB::beginTransaction();

            $user->removeRole($user->roles->first());
            $user->delete();

            DB::commit();

            return ['status' => true, 'message' => 'User deleted successfully'];
        } catch (\Exception $ex) {
            DB::rollback();
            return ['status' => false, 'message' => 'A system error has occurred. Please try again later.', 'error' => $ex->getMessage()];
        }
    }

    public function createUser(Request $request, $nip)
    {
        $staff = Staff::find($nip);

        if (!$staff) {
            return response()->json(['status' => false, 'message' => 'Staff tidak ditemukan']);
        }

        // Check if user with the same username already exists
        $existingUser = User::where('username', $staff->nip)->first();

        if ($existingUser) {
            return response()->json(['status' => false, 'message' => 'Pengguna dengan username ini sudah ada']);
        }

        // Create user
        $user = User::create([
            'name' => $staff->name,
            'username' => $staff->nip,
            'email' => $staff->email,
            'password' => Hash::make('12345678'), // Default password
            'is_active' => false,
        ]);

        if ($user) {
            // Assigning role
            $user->assignRole(4); // 4 is the role id for staff

            // Update staff with the user id
            $staff->id_user = $user->id;
            $staff->save();

            // Berhasil membuat user
            return response()->json(['status' => true, 'message' => 'Pengguna berhasil dibuat']);
        } else {
            // Gagal membuat user
            return response()->json(['status' => false, 'message' => 'Gagal membuat pengguna']);
        }
    }

    public function status(Request $request, $id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return ['status' => false, 'message' => 'User not found'];
            }

            $user->is_active = !$user->is_active;
            $user->save();

            return redirect()->back()->with('success', 'User successfully updated');
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', 'A system error has occurred. Please try again later. ' . $ex->getMessage());
        }
    }
}
