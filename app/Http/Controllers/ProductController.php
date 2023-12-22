<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\subcategory;
use App\Models\admin;
use Session;
use DB;

class ProductController extends Controller
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
        $product=DB::table('products')->join('subcategories','subcategories.id','=','products.sid')
        ->select('*','products.name as pname','products.image as piamge','products.id as pid')
        ->get();
        return view('product_table',compact('product','data'));
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
        $subcategory=subcategory::get();
        return view('product_form',compact('subcategory','data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sid=$request->get('sid');
        $name=$request->get('name');
        $img=$request->file('image');
        $imgtemp=$img->getClientOriginalName();
        $img->move('admin/image',$imgtemp);
        $desc=$request->get('description');
        $price=$request->get('price');
        $filename=[];
        foreach($request->file('mulimage') as $image)
        {
            $imgname = $image->getClientOriginalName();
            $image->move('admin/image',$imgname);
            $filename[]=$imgname;
        }
        $imagejson = json_encode($filename);
        $insert=new product([
            'sid'=>$sid,
            'name'=>$name,
            'image'=>$imgtemp,
            'description'=>$desc,
            'price'=>$price,
            'mulimage'=>$imagejson
        ]);
        $insert->save();
        echo "<script>alert('product added')
        window.location.href='/product';
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
        $data = array();
        if(Session::has('loginId'))
        {
            $data  = admin::where('id','=',Session::get('loginId'))->first();
        }
        $product=DB::table('products')->join('subcategories','subcategories.id','=','products.sid')
        ->select('*','products.name as pname','products.image as piamge','products.id as pid')
        ->where('products.id','=',$id)
        ->first();
        return view('product_view',compact('product','data'));
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
        $product=product::find($id);
        $subcategory=subcategory::get();
        return view('product_update',compact('product','subcategory','data'));
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
        
        $sid=$request->get('sid');
        $name=$request->get('name');
        $img=$request->file('image');
        $imgtemp=$img->getClientOriginalName();
        $img->move('admin/image',$imgtemp);
        $desc=$request->get('description');
        $price=$request->get('price');
        $filename=[];
        foreach($request->file('mulimage') as $image)
        {
            $imgname = $image->getClientOriginalName();
            $image->move('admin/image',$imgname);
            $filename[]=$imgname;
        }
        $imagejson = json_encode($filename);
        $update=product::find($id);
        $update->sid=$sid;
        $update->name=$name;
        $update->image=$imgtemp;
        $update->description=$desc;
        $update->price=$price;
        $update->mulimage=$imagejson;
        $update->update();
        echo "<script>alert('product updated')
        window.location.href='/product';
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
        $delete=product::find($id);
        $delete->delete();
        echo "<script>alert('product deleted')
        window.location.href='/product';
        </script>";
    }
}
