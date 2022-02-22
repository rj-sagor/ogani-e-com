<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
class AdminBrandController extends Controller
{
    public function index(){
       
       $data=Brand::all();
        return view('admin.brand.index',compact('data'));
    }
    
    public function brandStore(Request $request){
        $request->validate([
            'brand_name'=>'required|unique:brands,brand_name',

        ]);
        Brand::insert([
          'brand_name'=> $request->brand_name,
          'created_at'=> Carbon::now()

        ]);
        return redirect()->back()->with('success','Brand added !!');

    }
    public function Edit($id){
        $data=Brand::find($id);

        return view('admin.brand.edit',compact('data'));
    }

    public function Update(Request $request,$id){
        Brand::find($id)->update([
            'brand_name'=> $request->brand_name,
            'updated_at'=> Carbon::now()
  
          ]);
          return redirect()->route('brand.index')->with('update','update success !!');

}

public function Delete($id){
    $data=Brand::find($id)->delete();
    return redirect()->route('brand.index')->with('delete','Delete brand success');

}
public function Inactive($id){
    Brand::find($id)->update(['status'=> 0]);
    return redirect()->back()->with('update' ,'Brand Inactive');

}
public function Active($id){
    Brand::find($id)->update(['status'=> 1]);
    return redirect()->back()->with('update' ,'Brand Active');

}

}
