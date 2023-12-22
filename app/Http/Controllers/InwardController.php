<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\inward;
use App\Models\product;
use App\Models\product_stock;
use App\Models\admin;
use Session;
use DB;


class InwardController extends Controller
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
       $inward=DB::table('products')
       ->join('inwards','products.id','=','inwards.pid')
     //  ->select('*','inwards.id as iId')
       ->get();
       return view('inward_table',compact('inward','data'));
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
        $product=product::get();
        return view('inward_form',compact('product','data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pid=$request->get('pid');
        $stock=$request->get('stock');
        $date=date('Y-m-d');
        $date=$request->get('date');

      

    $productStock=product_stock::find($pid);
    $currentQty=$productStock->total_stock;
    $updateQty=$currentQty + $stock;
    $productStock->total_stock = $updateQty;
    $productStock->save();
    // echo $updateQty;
    // exit();
    
    $insert=new inward([
            'pid'=>$pid,
            'stock'=>$stock,
            'date'=>$date
        ]);
        $insert->save();
        echo "<script>alert('stock added')
        window.location.href='/inward';
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
        $inward=DB::table('products')
       ->join('inwards','products.id','=','inwards.pid')
       ->select('*','inwards.id as iId')
       ->where('inwards.id','=',$id)
       ->first();
        $product=product::get();
        return view('inward_update',compact('inward','product','data'));
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
        $pid=$request->get('pid');
        $stock=$request->get('stock');
        $date=date('Y-m-d');
        $date=$request->get('date');

        $update=inward::find($id);
        $update->pid=$pid;
        $update->stock=$stock;
        $update->date=$date;
        $update->update();
        echo "<script>alert('stock updated')
        window.location.href='/inward';
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
        $delete=inward::find($id);
        $delete->delete();
        echo "<script>alert('stock removed')
        window.location.href='/inward';
        </script>";
    }
}
