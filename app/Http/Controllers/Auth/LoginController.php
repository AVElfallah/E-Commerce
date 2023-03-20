<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{

    public function viewLogin(){
     return view('auth.login');
     }
    

    public function doLogin(LoginRequest $request)
    {
      if (Auth::attempt(['email' => $request->email, 'password' => $request->password]) ){
        return redirect()->route('home')->with(
          'success',
          'log in Successfully'
      ); 
        }
        
    return redirect()->route('login');
  
    
  
  
  
    }

    public function logout(){
      Session::flush();
      Auth::logout();
      return redirect('/login');
      
      }
}
