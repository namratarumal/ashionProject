<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\register;
use DB;
use Session;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function loginpage(Request $request)
    {
       $name=$request->get('name');
       $email=$request->get('email');

       $loginquery = DB::table('registers')->where('registers.name','=',$name)->where('registers.email','=',$email)->count();
       if($loginquery=='1')
       {
           $request->session()->put('user',$email);
           $user=$request->session()->get('user');
           echo "<script>alert('login successfully')
           window.location.href='/indexpage';
           </script>";
       }
       else
       {
        echo "<script> alert('user not found')
        window.location.href='/login';
        </script>";
       }
    }
    public function logout(Request $request)
    { 
        $request->session()->flush();
        echo "<script>alert('logout successfully')
        window.location.href='/indexpage';
        </script>";

    }
}
