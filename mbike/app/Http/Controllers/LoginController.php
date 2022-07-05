<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    public function login()
    {
       
        return view('login');
    }
    public function postLogin(Request $request)
    {

        $check = [
            'email'=>$request->email,
            'password'=>$request->password
        ];
        if(Auth::attempt($check))
        {
            return redirect()->route('home');
        }else{
            return redirect()->route('get-login')->with('error','email hoac mat khau khong chinh xac');
        }
     
            
    }
    public function register()
    {
        return view('register');
    }
    public function postRegister(LoginRequest $request)
    {
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'role' => 'admin',
            'password'=>bcrypt($request->password),
        ]);
        return redirect()->route('get-register')->with('success','Đăng kí thành công');
    }
    public function home()
    {
       
            $user = User::where('id',auth()->user()->id)->first();
            $name = Session::put('name',$user->name);
            return view('home',compact('user','name'));
       
       
           
    }
    public function logout()
    {
        
        auth::logout();
        return redirect()->route('get-login');
    }
    
}
