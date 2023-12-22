<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\subcategory;
use App\Models\category;
use App\Models\admin;
use Session;
use DB;

class SubCategoryController extends Controller
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
        $sub=DB::table('subcategories')
        ->join('categories','categories.id','=','subcategories.cid')
        ->select('*','subcategories.name as sname','subcategories.image as simage','subcategories.id as sid')
        ->get();
        return view('subcategory_table',compact('sub','data'));
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
        $category=category::get();
        return view('subcategoryForm',compact('category','data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cid=$request->get('cid');
        $name=$request->get('name');       
        $img=$request->file('image');
        $imgtemp=$img->getClientOriginalName();
        $img->move('admin/image',$imgtemp);
        $insert=new subcategory([
            'cid'=>$cid,
            'name'=>$name,
            'image'=>$imgtemp
        ]);
        $insert->save();
        echo "<script>alert('product added')
        window.location.href='/subcategory';
        </script>";
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
        $sub=subcategory::find($id);
        $category=category::get();
        return view('subcategory_update',compact('sub','category','data'));
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
        $cid=$request->get('cid');
        $name=$request->get('name');       
        $img=$request->file('image');
        $imgtemp=$img->getClientOriginalName();
        $img->move('admin/image',$imgtemp);
        $update=subcategory::find($id);
        $update->cid=$cid;
        $update->name=$name;
        $update->image=$imgtemp;
        $update->update();
        echo "<script>alert('product updated')
        window.location.href='/subcategory';
        </script>";
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cate=subcategory::find($id);
        $cate->delete();
        echo "<script>alert('record deleted')
        window.location.href='/subcategory';
        </script>";
    }
}
