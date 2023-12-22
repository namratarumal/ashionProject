<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\register;
use App\Models\products;
use App\Models\checkout;
use App\Models\order_table;
use App\Models\admin;
use DB;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\registerExport;

class tableController extends Controller
{
   public function registerdetails()
   {
    $data = array();
        if(Session::has('loginId'))
        {
            $data  = admin::where('id','=',Session::get('loginId'))->first();
        }

       $register=register::get();
       return view('register_table',compact('register','data'));
   }
   public function shippingdetails()
   {
    $data = array();
    if(Session::has('loginId'))
    {
        $data  = admin::where('id','=',Session::get('loginId'))->first();
    }
       $checkout=checkout::get();
       return view('shipping_table',compact('checkout','data'));
   }   
   public function shppingShow($id)
   {
    $data = array();
        if(Session::has('loginId'))
        {
            $data  = admin::where('id','=',Session::get('loginId'))->first();
        }

       $checkout=checkout::find($id);
       return view('shopping_view',compact('checkout','data'));
   }
   public function shoppingDelete($id)
   {
      
      $delete=checkout::find($id);
      $delete->delete();
    
      echo "<script>alert('recorde deleted')
      window.location.href='/shippingdetails';
      </script>";
   }

   public function orderdetails()
   {
    $data = array();
        if(Session::has('loginId'))
        {
            $data  = admin::where('id','=',Session::get('loginId'))->first();
        }

      $order=DB::table('order_tables')
      ->join('registers','order_tables.uid','=','registers.id')
      ->join('products','order_tables.pid','=','products.id')
      ->select('*','products.name as pname','registers.name as username','order_tables.id as orderid')
      ->get();
      return view('order_table',compact('order','data'));
   }

   public function orderDelete($id)
   {
      
      $delete=order_table::find($id);
      $delete->delete();
    
      echo "<script>alert('recorde deleted')
      window.location.href='/orderdetails';
      </script>";
   }
   public function registerDelete($id)
   {
      
      $delete=register::find($id);
      $delete->delete();
    
      echo "<script>alert('recorde deleted')
      window.location.href='/registerdetails';
      </script>";
   }
    public function registerview()
    {
        return view('registerExport');
    }
   public function registerexport()
   {
    return Excel::download(new registerExport, 'exported-data.xlsx');
   }
}
