<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('master.users.index', compact('user'));
    }

    public function create()
    {
        $prodi = Prodi::all();
        return view('master.users.create', compact('prodi'));
    }

    public function store(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'type' => 'required',
                'username' => 'required',
                'prodi' => 'required'
            ], [
                'name.required' => 'Nama tidak boleh kosong',
                'type.required' => 'Tipe tidak boleh kosong',
                'username.required' => 'Username tidak boleh kosong',
                'prodi.required' => 'Prodi tidak boleh kosong'
            ]);
            if ($validator->fails()) {

                return back()->withErrors($validator->errors());
            }
            $user = new User;
            $user->name  = $request->name;
            $user->phone = $request->phone;
            $user->type = $request->type;
            $user->prodi = $request->prodi;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = $request->password ? Hash::make($request->password) : Hash::make($request->username);
            $user->save();

            return redirect()->route('master.users');
        } catch (\Throwable $th) {
            if ($th->getCode() == 400) {
                return back()->withErrors($th->getMessage());
            } else {
                return abort(500);
            }
        }
    }

    public function delete($id)
    {
        try {
            $user = User::find($id);
            $user->delete();
            return back();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function loginWeb(Request $request)
    {
        try {
            $credentials = Validator::make(
                $request->all(),
                [
                    'username' => ['required'],
                    'password' => ['required'],
                ],
                [
                    'username.required' => 'Username tidak boleh kosong',
                    'password.required' => 'Password tidak boleh kosong'
                ]
            );


            if ($credentials->fails()) {
                return back()->with('fail', $credentials->errors()->first());
            }
            $user = user::where('username', $request->username)->first();
            if (!$user) {
                return back()->with('fail', 'Pengguna tidak ditemukan');
            }

            $credentialsx = ($request->only('username', 'password'));
            $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            if (Auth::attempt($credentialsx)) {
                $request->session()->regenerate();

                return redirect()->intended('dashboard');
            } else {
                return back()->with('fail', 'Password salah');
            }
        } catch (\Throwable $th) {
            return back()->with('error', 'Mohon maaf terjadi kesalahan' . $th->getMessage());
        }
    }
    // Api 
    public function login(Request $request)
    {
        $message = 'User tidak ditemukan';
        $user = user::where('username', $request->username)->first();
        if (!$user) {
            $message = 'User tidak ditemukan';
            return response()->json([
                'status' => 'fail',
                'message' => $message
            ], 400);
        }
        if ($user && Hash::check($request->password, $user->password)) {

            $cred = $user->createToken($user->name . ' Login')->plainTextToken;
            return response()->json([
                'status' => 'success',
                'user_id' => $user->u_id,
                'data' => $user,
                'credential' => $cred,
            ]);
        } else {
            $message = 'Password anda salah';
        }

        return response()->json([
            'status' => 'fail',
            'message' => $message
        ], 400);
    }
}
