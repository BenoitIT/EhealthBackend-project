<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

class hospitalWorkerController extends Controller
{
    public function loginUser(Request $request)
    {
    $request->validate([
       'email'=>'required|email',
       'password'=>'required'
     ]);


     if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'user'=>$user->name,
                'assigned_role'=>$user->role()->role_name,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken('sanctumToken')->plainTextToken
            ], 200);

        }



    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request) {
        if ($request->user()) {
            $request->user()->tokens()->delete();
        }

        return response()->json(['message' => 'you are logged out'], 200);
    }

public function store(Request $request)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required'],
        'role'=>'required'
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role'=>$request->role,
    ]);

    event(new Registered($user));

    Auth::login($user);

    return response([
        'status'=>'user created'
    ]);
}
public function rolestore(request $request){
$request->validate([
    'role_name'=>'required'
]);
Role::create([
    'role_name'=>$request->role_name
]);
return response([
'message'=>'new role added'
]);
}
public function allusers()
{
    $users= User::all();
    return response([
     'message'=>$users
    ]);
}

}
