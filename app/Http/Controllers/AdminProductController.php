<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Laravel\Ui\Presets\React;

class AdminProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


public function getindex(){
    $categories=Category::latest()->get();
    $brands=Brand::latest()->get();
    return view('admin.product.add',compact('categories','brands'));
}
// ==============================store producr======================
public function storeproduct(Request $request){
    $request->validate([

        'product_name'=>'required|max:255',
        'product_code'=>'required|max:255',
        'price'=>'required|max:255',
        'product_quantity'=>'required|max:255',
        'category_id'=>'required|max:255',
        'brand_id'=>'required|max:255',
        'short_description'=>'required',
        'long_description'=>'required',

        'image_one'=>'required|mimes:jpg,jpeg,png,gif',
        'image_two'=>'required|mimes:jpg,jpeg,png,gif',
        'image_three'=>'required|mimes:jpg,jpeg,png,gif',
    ],[
        'category_id.required'=>'select category name',
        'brand_id.required'=>'select brand name',
    ]);

    $first_image=$request->file('image_one');
    $name_gen=hexdec(uniqid()).'.'.$first_image->getClientOriginalExtension();
    Image::make($first_image)->resize(270.270)->save('frontend/img/new-product/'.$name_gen);
    $img_url1='frontend/img/new-product/'.$name_gen;

    $secend_image=$request->file('image_two');
    $name_gen=hexdec(uniqid()).'.'.$secend_image->getClientOriginalExtension();
    Image::make($secend_image)->resize(270.270)->save('frontend/img/new-product/'.$name_gen);
    $img_url2='frontend/img/new-product/'.$name_gen;


    $thired_image=$request->file('image_three');
    $name_gen=hexdec(uniqid()).'.'.$thired_image->getClientOriginalExtension();
    Image::make($thired_image)->resize(270.270)->save('frontend/img/new-product/'.$name_gen);
    $img_url3='frontend/img/new-product/'.$name_gen;


Product::insert([

'product_name'=>$request->product_name,
'product_slug'=>strtolower(str_replace(' ','-',$request->product_name)),
'product_code'=>$request->product_code,
'price'=>$request->price,
'product_quantity'=>$request->product_quantity,
'category_id'=>$request->category_id,
'brand_id'=>$request->brand_id,
'short_description'=>$request->short_description,
'long_description'=>$request->long_description,
'image_one'=>$img_url1,
'image_two'=>$img_url2,
'image_three'=>$img_url3,
'created_at'=> Carbon::now(),
 
]);


return redirect()->back()->with('succes' ,'Product Add successfully');
}


public function manageProducts(){
    $products=Product::latest()->get();
    return view('admin.product.manage',compact('products'));
}
public function productInactive($id){
    Product::find($id)->update(['status'=> 0]);
    return redirect()->back()->with('active','Inactive Successfully');


}
public function productActive($id){
    Product::find($id)->update(['status'=> 1]);
    return redirect()->back()->with('active','Active Successfully');

}

public function productEdit($id){
    $product=Product::findOrFail($id);
    $categories=Category::latest()->get();
    $brands=Brand::latest()->get();
    return view('admin.product.edit',compact('product','categories','brands'));
}


public function updateproduct(Request $request, $id){
    
Product::findOrFail($id)->update([

    'product_name'=>$request->product_name,
    'product_slug'=>strtolower(str_replace(' ','-',$request->product_name)),
    'product_code'=>$request->product_code,
    'price'=>$request->price,
    'product_quantity'=>$request->product_quantity,
    'category_id'=>$request->category_id,
    'brand_id'=>$request->brand_id,
    'short_description'=>$request->short_description,
    'long_description'=>$request->long_description,
    
    'created_at'=> Carbon::now(),
     
    ]);
    return redirect()->route('manage.product')->with('succes' ,'Product update successfully');

}

public function updateImage(Request $request){
    $product_id=$request->id;
    $old_one=$request->img_first;
    $old_two=$request->img_secend;
    $old_three=$request->img_third;



    if($request->has('image_three') && $request->has('image_two')){
        
        unlink($old_two);
        unlink($old_three);

        $secend_image=$request->file('image_two');
    $name_gen=hexdec(uniqid()).'.'.$secend_image->getClientOriginalExtension();
    Image::make($secend_image)->resize(270.270)->save('frontend/img/new-product/'.$name_gen);
    $img_url2='frontend/img/new-product/'.$name_gen;
    
    Product::findOrFail($product_id)->update([
    
        'image_two'=>$img_url2,
        'updated_at'=>Carbon::now(),
    ]);
    

        $secend_image=$request->file('image_three');
    $name_gen=hexdec(uniqid()).'.'.$secend_image->getClientOriginalExtension();
    Image::make($secend_image)->resize(270.270)->save('frontend/img/new-product/'.$name_gen);
    $img_url2='frontend/img/new-product/'.$name_gen;

    Product::findOrFail($product_id)->update([
 
        'image_three'=>$img_url2,
        'updated_at'=>Carbon::now(),

     
    ]);

    
 return redirect()->route('manage.product')->with('succes' ,'Riletate image updated successfully');

    }

    if($request->has('image_one')){
        unlink($old_one);

        $first_image=$request->file('image_one');
    $name_gen=hexdec(uniqid()).'.'.$first_image->getClientOriginalExtension();
    Image::make($first_image)->resize(270.270)->save('frontend/img/new-product/'.$name_gen);
    $img_url1='frontend/img/new-product/'.$name_gen;

    Product::findOrFail($product_id)->update([
 
        'image_one'=>$img_url1,
        'updated_at'=>Carbon::now(),
    ]);
    }

 return redirect()->route('manage.product')->with('succes' ,' Main Image updated successfully');

 
}

// ===========================delete====================
public function destroy($id){
    $image=Product::findOrFail($id);
    $img_one=$image->image_one;
    $img_two=$image->image_two;
    $img_three=$image->image_three;
    unlink($img_one);
    unlink($img_two);
    unlink($img_three);
    Product::findOrFail($id)->delete();

    return redirect()->route('manage.product')->with('succes' ,'Deleted successfully');

}


}
