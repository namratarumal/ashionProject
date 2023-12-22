<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\admin;
use Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        if(Session::has('loginId'))
        {
            $data  = admin::where('id','=',Session::get('loginId'))->first();
        }

         $table=category::get();
        return view('category_table',compact('table','data'));
        //return response()->json($table);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        if(Session::has('loginId'))
        {
            $data  = admin::where('id','=',Session::get('loginId'))->first();
        }
        return view('category_form',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name=$request->get('name');
        $img=$request->file('image');
        $imgtemp=$img->getClientOriginalName();
        $img->move('admin/image',$imgtemp);
        $insert=new category([
            'name'=>$name,
            'image'=>$imgtemp
        ]);
        $insert->save();
        echo "<script>alert('data added')
        window.location.href='/category';
        </script>";
       // return response()->json(['status'=>'pass','msg'=>'added']);
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
        $data = array();
        if(Session::has('loginId'))
        {
            $data  = admin::where('id','=',Session::get('loginId'))->first();
        }
        $cate=category::find($id);
        return view('category_update',compact('cate','data'));
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
        $name=$request->get('name');
        $img=$request->file('image');
        if($img!="")
        {
            $imgtemp=$img->getClientOriginalName();
        $img->move('admin/image',$imgtemp);
        $update=category::find($id);
        $update->name=$name;
        $update->image=$imgtemp;
        $update->update();
        echo "<script>alert('data updated')
        window.location.href='/category';
        </script>";
        }
        else
        {         
        $update=category::find($id);
        $update->name=$name;       
        $update->update();
        echo "<script>alert('data updated')
        window.location.href='/category';
        </script>";
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cate=category::find($id);
        $cate->delete();
        echo "<script>alert('record deleted')
        window.location.href='/category';
        </script>";
    }
}
