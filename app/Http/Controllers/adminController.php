<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;
use Hash;
use Session;

class adminController extends Controller
{
    public function adminlogin()
    {
        return view('adminlogin');
    }
    public function adminregister()
    {
        return view('adminregister');
    }

    public function registeruser(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:admins',
            'password'=>'required|min:3|max:6' //admin1
        ]);
 
            $insert=new admin();
            $insert->name = $request->name;
            $insert->email = $request->email;
            $insert->password = Hash::make($request->password);
            $res=$insert->save();
            if($res)
            {
                return back()->with('success','You have registerd successfully');
            }
            else
            {
                return back()->with('fail','something wrong');
            }
    }

    public function LoginUser(Request $request)
    {
        $request->validate([
            'email'=>'required|email|',
            'password'=>'required|min:3|max:6' //admin1
        ]);
        $user = admin::where('email','=',$request->email)->first();
        if($user)
        {
           if(Hash::check($request->password, $user->password)) 
           {
              $request->session()->put('loginId', $user->id);
              return redirect('/index');
           }
           else
           {
            return back()->with('fail','Password not matched');
           }  
        }
        else
        {
            return back()->with('fail','This email is not registerd');
        }
    }

    public function adminlogout()
    {
        if(Session::has('loginId'))
        {
            Session::pull('loginId');
            return redirect('/adminlogin');
        }
    }
}
