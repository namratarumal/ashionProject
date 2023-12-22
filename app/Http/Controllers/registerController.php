<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\register;
use DB;

class registerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'country'=>'required',
            'address'=>'required',
            'streetaddress'=>'required',
            'city'=>'required',
            'state'=>'required',
            'pincode'=>'required',
            'contact'=>'required',
            'email'=>'required'
        ]);

        $name=$request->get('name');
        $country=$request->get('country');
        $address=$request->get('address');
        $saddress=$request->get('streetaddress');
        $city=$request->get('city');
        $state=$request->get('state');
        $pincode=$request->get('pincode');
        $contact=$request->get('contact');
        $email=$request->get('email');
        // $query=DB::table('registers')->select('registers.email','=',$email)->count();
        // if($query=='1')
        // {
        //     echo "<script>alert('user already registerd...Please login!!!')
        // window.location.href='/register';
        // </script>";
        // }
        // else
        // {
            $insert=new register([
                'name'=>$name,
                'country'=>$country,
                'address'=>$address,
                'streetaddress'=>$saddress,
                'city'=>$city,
                'state'=>$state,
                'pincode'=>$pincode,
                'contact'=>$contact,
                'email'=>$email
            ]);
            $insert->save();
            echo "<script>alert('registration completed successfully')
            window.location.href='/register';
            </script>";
      //  }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
