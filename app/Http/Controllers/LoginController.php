<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Session;
use Auth;

use App\Models\User;

class LoginController extends Controller
{
    function login() {
        return view('login');
    }
    function submitlogin(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);
            $errorlist = [];
            foreach ($validator->errors()->all() as $error) {
                $errorlist[] = $error;
            }
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors(['error' => $errorlist]);
            }
            $email = $request->email; 
            $password = $request->password;
            $checklogin = User::select('*')->where('email',$email)->count();
            if($checklogin > 0) {
                $adminlogin = User::where('email','=',$email)->first();
                if(Hash::check( $password, $adminlogin->password)){
                    session()->put('login', $adminlogin);
                    return redirect()->route('customers.index');
                } else {
                    return redirect()->back()->withInput()->with('error2', 'Login credential wrong!');
                }
            } else {
                return redirect()->back()->withInput()->with('error', 'Emai or password is wrong!');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    function logout(){
        Session::flush();
		return redirect()->route('login');
    }
}
