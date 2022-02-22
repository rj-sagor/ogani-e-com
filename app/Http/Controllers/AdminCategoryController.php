<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index(){
        $data=Category::all();

        return view('admin.category.index',compact('data'));
    }

    public function categoryStore(Request $request){
        $request->validate([
            'category_name'=>'required|unique:categories,category_name',

        ]);
        Category::insert([
          'category_name'=> $request->category_name,
          'created_at'=> Carbon::now()

        ]);
        return redirect()->back()->with('success','insert success !!');

    }

    public function Edit($id){
        $data=Category::find($id);

        return view('admin.category.edit',compact('data'));
    }
    public function Update(Request $request,$id){
        Category::find($id)->update([
            'category_name'=> $request->category_name,
            'updated_at'=> Carbon::now()
  
          ]);
          return redirect()->route('category.index')->with('update','update success !!');
  

    }
    public function Delete($id){
        $data=Category::find($id)->delete();
        return redirect()->route('category.index')->with('delete','Delete category success');

    }

    public  function Inactive($id){
        Category::find($id)->update(['status' => 0]);
        return redirect()->back()->with('update','Inactive success');


        
    }
    public  function Active($id){
        Category::find($id)->update(['status' => 1]);
        return redirect()->back()->with('update','Active success');


        
    }
}
