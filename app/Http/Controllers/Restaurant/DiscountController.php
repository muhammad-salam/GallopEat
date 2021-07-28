<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant\Discount;
use App\Models\Item;
class DiscountController extends Controller
{
    public function discount(){
        $restaurent_id = 	session()->get('users')['user_id'];
        $data['discounts'] = Discount::with('item')->where(['restaurent_id'=>$restaurent_id,'is_deleted'=>1])->orderBy('discount_id','desc')->get()->toArray();
        return view("Resturant.discount.show",$data);
    }
    public function add_discount(){
        $restaurent_id = 	session()->get('users')['user_id'];
        $items = Item::where('restaurent_id',$restaurent_id)->get()->toArray();
        return view("Resturant.discount.add",compact('items'));
    }
    public function add_discount_process(Request $request){
        // dd($request->offer_startdate);
         $restaurent_id = 	session()->get('users')['user_id'];
         $data = [
             'restaurent_id'     => $restaurent_id,
             'item_id'           => $request->item_id,
             'discount'          => $request->discount,
             'discount_type'     => $request->discount_type,
             'discount_startdate'=> $request->discount_startdate,
             'discount_enddate'  => $request->discount_enddate,
         ];
         $insert = Discount::create($data);
         if($insert){
             return response()->json("Discount Added Successfully");
         }
     }
     public function edit_discount($id){
        $restaurent_id = 	session()->get('users')['user_id'];
        $discount = Discount::where('discount_id',$id)->first()->toArray();
        $items = Item::where('restaurent_id',$restaurent_id)->get()->toArray();
        return view("Resturant.discount.update",compact('discount','items'));
    }
    public function update_discount_process(Request $request){
        $data = [
            'item_id'           => $request->item_id,
            'discount'          => $request->discount,
            'discount_type'     => $request->discount_type,
            'discount_startdate'=> $request->discount_startdate,
            'discount_enddate'  => $request->discount_enddate,
        ];
        $update = Discount::where('discount_id',$request->discount_id)->update($data);
        if($update){
            return response()->json("Discount Updated Successfully");
        }
    }
    public function delete_discount($id){
        $data = [
            'is_deleted'        => 0,
        ];
        $update = Discount::where('discount_id',$id)->update($data);
        if($update){
            return redirect()->route('discount')->with(['toast_type'=>'success','toast_msg'=>'Offer Deleted Successfully']);
        }
    }

}
