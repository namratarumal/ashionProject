<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\subcategory;
use App\Models\product;
use App\Models\checkout;
use App\Models\order_table;
use App\Models\product_stock;
use App\Mail\shippingMail;
use App\Models\contact;
use DB;
use Session;
use Mail;
class FrontendIndexController extends Controller
{
    public function indexpage(Request $request)
    {
      $user=$request->session()->get('user');
        $username=DB::table('registers')->where('registers.email','=',$user)->select('registers.name as uname')->get();
        $res=$request->session()->get('cart');
      
      $view=0;
      if($res=="")
      {
        $view=0;
      }else{
        $view=count($res);
      }
        $category=category::get();
        $sub=subcategory::get();
        return view('indexpage',compact('category','sub','view','username'));
    }


    public function shop(Request $request)
    {
        $res=$request->session()->get('cart');
        $user=$request->session()->get('user');
        $username=DB::table('registers')->where('registers.email','=',$user)->select('registers.name as uname')->get();
      $view=0;
      if($res=="")
      {
        $view=0;
      }else{
        $view=count($res);
      }
        $sub=subcategory::get();
        $category=category::get();
        // $cate=DB::table('categories')
        // ->join('subcategories','categories.id','=','subcategories.cid')
        // ->select('categories.id as cid','categories.name as cname')
        // ->get();
        return view('shop',compact('sub','category','view','username'));
    }


    public function subProduct(Request $request, $id)
    {
        $res=$request->session()->get('cart');
        $user=$request->session()->get('user');
        $username=DB::table('registers')->where('registers.email','=',$user)->select('registers.name as uname')->get();
      $view=0;
      if($res=="")
      {
        $view=0;
      }else{
        $view=count($res);
      }
        $sub=subcategory::get();
        //$product=product::find($id);
        $product=DB::table('products')->where('products.sid','=',$id)->get();
        // echo $product;
        // exist();
        return view('product_fetch',compact('product','sub','view','username'));
    }


    public function productDetail(Request $request, $id)
    {
        $res=$request->session()->get('cart');
        $user=$request->session()->get('user');
        $username=DB::table('registers')->where('registers.email','=',$user)->select('registers.name as uname')->get();
      $view=0;
      if($res=="")
      {
        $view=0;
      }else{
        $view=count($res);
      }
        $detail=DB::table('products')->where('products.id','=',$id)->first();
        return view('product_detail',compact('detail','view','username'));
    }


    public function AddtoCart(Request $request, $id)
    {
        $product=product::find($id);
        
        $productStock=product_stock::find($id);
        $currentQty=$productStock->total_stock;
        // $updateQty=$currentQty - $qty;
        // $productStock->total_stock = $updateQty;
        // $productStock->save();
        $cart=$request->session()->get('cart',[]);
        if($currentQty==0)
        {
          echo "<script>alert('product is out of stock')
          </script>";   
        }
        else
        {
          if(isset($cart[$id]))
          {
              echo "<script>alert('product already added')
          </script>";   
          }
          else
          {
              $cart[$id]=[
                  'id'=>$id,
                  'name'=>$product->name,
                  'price'=>$product->price,
                  'quantity'=>1,
                  'image'=>$product->image
              ];
              $request->session()->put('cart',$cart);
              echo "<script>alert('product added')
              window.location.href='/viewcart';
              </script>";
          }
        }
       
        
        //return view('cart');
    }


    public function viewcart(Request $request)
    {
        $res=$request->session()->get('cart');
        $viewcart=$request->session()->get('cart');
        $user=$request->session()->get('user');
        $username=DB::table('registers')->where('registers.email','=',$user)->select('registers.name as uname')->get();
      $view=0;
      if($res=="")
      {
        $view=0;
      }else{
        $view=count($res);
      }

       
       return view('viewcart',compact('viewcart','view','username'));
    }


    public function removecart(Request $request, $id)
    {
        $remove=$request->session()->get('cart');  
        if(isset($remove[$id]))
        {
            unset($remove[$id]);
            session()->put('cart',$remove);
        }  
       // return redirect()->back();
        echo "<script>alert('product removed')
        window.location.href='/viewcart';
        </script>";
    }


    public function contact(Request $request)
    {

      
      $res=$request->session()->get('cart');
      $user=$request->session()->get('user');
      $username=DB::table('registers')->where('registers.email','=',$user)->select('registers.name as uname')->get();
      $view=0;
      if($res=="")
      {
        $view=0;
      }else{
        $view=count($res);
      }
        return view('contact',compact('username','view'));
    }
    
    public function contactinsert(Request $request)
    {
      $request->validate([
        'name'=>'required',
        'email'=>'required|email',
        'message'=>'required'
      ]);
        $name=$request->get('name');
        $email=$request->get('email');
        $msg=$request->get('message');

        $insert=new contact([
          'name'=>$name,
          'email'=>$email,
          'message'=>$msg
        ]);
        $insert->save();
        echo "<script>alert('Message send successfully..')
        window.location.href='/contact';
        </script>";
    }

    public function checkout(Request $request)
    {
      $user=$request->session()->get('user');
      $username=DB::table('registers')->where('registers.email','=',$user)->select('registers.name as uname')->get();
      $res=$request->session()->get('cart');
      $viewcart=$request->session()->get('cart');
      $view=0;
      if($res=="")
      {
        $view=0;
      }else{
        $view=count($res);
      }
      $email=$request->session()->get('user');
      $register=DB::table('registers')->where('registers.email','=',$email)->first();
      return view('checkout',compact('view','register','viewcart','username'));
    }


    public function checkoutstore(Request $request)
    {
      $user=$request->session()->get('user');
      $uid=DB::table('registers')->where('registers.email','=',$user)->select('registers.id as uid')->get();
     
      $total=0;
        $name=$request->get('rname');
        $country=$request->get('country');
        $address=$request->get('address');
        $saddress=$request->get('streetaddress');
        $city=$request->get('city');
        $state=$request->get('state');
        $pincode=$request->get('pincode');
        $contact=$request->get('contact');
        $email=$request->get('email');
        $payment=$request->get('payment');
        $cart=$request->session()->get('cart');
       
        $productname=[];
       

        foreach($cart as $c)
        {
          $productname[]=[$c['name']];
          $qty=$c['quantity'];
          $price=$c['price'];
          $pid=$c['id'];
           $total += $c['price'] * $c['quantity'];
         
         $order=new order_table([
             'uid'=>$uid[0]->uid,
             'pid'=>$pid,
             'price'=>$price,
             'quantity'=>$qty
         ]);
         $order->save();
        }

        $productStock=product_stock::find($pid);
        $currentQty=$productStock->total_stock;
        $updateQty=$currentQty - $qty;
        $productStock->total_stock = $updateQty;
        $productStock->save();
        
        $pname1= json_encode($productname);
       
        $insert= new checkout([
            'name'=>$name,
            'country'=>$country,
            'address'=>$address,
            'streetaddress'=>$saddress,
            'city'=>$city,
            'state'=>$state,
            'pincode'=>$pincode,
            'contact'=>$contact,
            'email'=>$email,
            'product_name'=>$pname1,
            'total_bill'=>$total,
            'payment'=>$payment
        ]);
       
        Session::pull('cart');
        $mailData = [
          'title' => 'Mail from NamrataRumal',
          'body' => 'Thankyou from Ashion online shopping...<br>
                      Your order placed successfully',
        ];
        Mail::to($user)->send(new shippingMail($mailData));

        $insert->save();
        echo "<script>alert('Your order placed successfully..')
        window.location.href='/indexpage';
        </script>";

       

        
    }

    public function cartQtyUpdate(Request $request)
    {
        $updateqty=$request->session()->get('cart');
        if(isset($updateqty))
        {
            update($updateqty->id,$updateqty->quantity);
            $request->session()->put('cart',$updateqty);
        }
    }
}
