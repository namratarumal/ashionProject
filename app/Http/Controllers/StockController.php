<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\product_stock;
use App\Models\inward;
use App\Models\admin;
use Session;
use DB;

class StockController extends Controller
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
      $stock=DB::table('products')
      ->join('product_stocks','products.id','=','product_stocks.pid')
      //->select('*','inwards.id as iId')
      ->get();
       return view('stock_table',compact('stock','data'));
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

        return view('stock_form',compact('product','data'));
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
        // $inward=DB::table('inwards')->select('inwards.stock as totalstock')->where('inwards.pid','=',$pid)->get();
        $insert=new product_stock([
            'pid'=>$pid,
            'total_stock'=>$stock
        ]);
        $insert->save();
        echo "<script>alert('stock added')
        window.location.href='/stock';
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
        $delete=product_stock::find($id);
        $delete->delete();
        echo "<script>alert('stock deleted')
        window.location.href='/stock';
        </script>";
    }
}
