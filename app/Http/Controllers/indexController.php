<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;
use Session;

class indexController extends Controller
{
    public function index()
    {
        $data = array();
        if(Session::has('loginId'))
        {
            $data  = admin::where('id','=',Session::get('loginId'))->first();
        }
        return view('index',compact('data'));
    }
}
