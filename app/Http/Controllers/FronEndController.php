<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FronEndController extends Controller
{
    public function index(){
        $all_categori=Category::where('status',1)->latest()->get();
        $products=Product::where('status',1)->latest()->get();
        $lmt_p=Product::where('status',1)->latest()->limit(3)->get();
      

        return view('pages.index',compact('all_categori','products','lmt_p'));
    }
}
