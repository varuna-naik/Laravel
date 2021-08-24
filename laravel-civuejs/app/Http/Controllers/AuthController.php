<?php

namespace App\Http\Controllers;

use App\Models\Users_new;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Closure;
use Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // use ApiResponser;
    // protected $redirectTo = RouteServiceProvider::HOME;

    public function login(Request $request)
    {
        // $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required',
        //     'device_name' => 'required',
        // ]);

        $validator=Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ],
        $messages = [
            
        ]);

        if($validator->fails()){
            return response()->json(['result'=>$validator->messages(),'status'=>'error','success'=>false]);
        }
        else{
            // $user = Users_new::where('email', $request->email)->first();
            
            // if (! $user || ! Hash::check($request->password, $user->password)) {
            //     throw ValidationException::withMessages([
            //         'credentials' => 'The provided credentials are incorrect.',
                    
            //         'success'=>false
            //     ]);
            // }
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'active' => 1])) {
                // Authentication was successful...
                $user = Users_new::where('email', $request->email)->first();
                $nextpage='dashboard';

                if($user->role==1){
                    $nextpage='adminDashboard';
                }
                $token=$user->createToken($request->device_name)->plainTextToken ;
                $response=[
                    'success'=>true,
                    'user'=>$user,
                    'token'=>$token,
                    'role'=>$user->role,
                    'nextpage'=>$nextpage
                ];
                return response($response,201);
            }
            else{   
                throw ValidationException::withMessages([
                            'credentials' => 'The provided credentials are incorrect or your ID is not verified by Admin',
                            
                            'success'=>false
                        ]);
                    }
            //     $nextpage='dashboard';

            //     if($user->role==1){
            //         $nextpage='adminDashboard';
            //     }
            //     $token=$user->createToken($request->device_name)->plainTextToken ;
            //     $response=[
            //         'success'=>true,
            //         'user'=>$user,
            //         'token'=>$token,
            //         'role'=>$user->role,
            //         'nextpage'=>$nextpage
            //     ];
            //     return response($response,201);
        }
        // return back()->withErrors([
        //     'credentials' => 'The provided credentials do not match our records.',
        //     'success'=>false
        // ]);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return json_encode(['message' => 'Tokens Revoked']);
    
    }
}
