<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class AdminCouponController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    $coupons=Coupon::all();
        return view('admin.coupon.index',compact('coupons'));
    }

    public function Store(Request $request){
        $request->validate([
'coupon_name'=>'required|unique:coupons,coupon_name',
        ]);
        Coupon::insert([
        'coupon_name'=>strtoupper($request->coupon_name),
        'created_at'=>Carbon::now(),
        ]);
        
        return redirect()->back()->with('success','coupon add successfully');

    }

    public function Delete($id){
        Coupon::find($id)->delete();

        return redirect()->back()->with('delete','delete successfully');

    }

    public function Edit($id){
       $coupons= Coupon::find($id);
       return view('admin.coupon.edit',compact('coupons'));


    }

    public function Update(Request $request,$id){
        Coupon::find($id)->Update([
            'coupon_name'=>strtoupper($request->coupon_name),
        'created_at'=>Carbon::now(),

        ]);
        return redirect()->route('coupon.index')->with('success','coupon updatet successfully');

    }
    public function Inactive($id){
        Coupon::find($id)->Update(['status'=>0]);
        return redirect()->route('coupon.index')->with('update','Inactive successfully');

    }
    public function Active($id){
        Coupon::find($id)->Update(['status'=>1]);
        return redirect()->route('coupon.index')->with('update','Active successfully');
    }
}
