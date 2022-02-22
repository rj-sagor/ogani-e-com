<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request,$id){
        $ceck=Cart::where('product_id',$id)->first();
        if($ceck){
            Cart::where('product_id',$id)->increment('qty');
            return Redirect()->back();
             }

        else{
            Cart::insert([
                'product_id'=>$id,
                'qty'=>1,
                'price'=>$request->price,
                'user_ip'=> request()->ip(),
    
            ]);
            return Redirect()->back();
        }
      
     

    }
}
