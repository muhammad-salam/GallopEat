<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant\Offer;
use App\Models\Item;
class OfferController extends Controller
{
    public function offers(){
        $restaurent_id = 	session()->get('users')['user_id'];
        $data['offers'] = Offer::with('item')->where('restaurent_id',$restaurent_id)->orderBy('offer_id','desc')->get()->toArray();
        return view("Resturant.offer.show",$data);
    }
    public function add_offer(){
        $restaurent_id = 	session()->get('users')['user_id'];
    //dd(session()->get('users')['store_id']);
        $items = Item::where('restaurent_id',$restaurent_id)->get()->toArray();
        return view("Resturant.offer.add",compact('items'));
    }
    public function delete_offer($id){
        Offer::where('offer_id',$id)->delete();
        return redirect()->route('offers')->with(['toast_type'=>'success','toast_msg'=>'Offer Deleted Successfully']);
    }
    public function edit_offer($id){
        $restaurent_id = 	session()->get('users')['user_id'];
        $offer = offer::where('offer_id',$id)->first()->toArray();
        $items = Item::where('restaurent_id',$restaurent_id)->get()->toArray();
        // dd($offer);
        return view("Resturant.offer.update",compact('offer','items'));
    }
    public function add_offer_process(Request $request){
       // dd($request->offer_startdate);
        $restaurent_id = 	session()->get('users')['user_id'];
        $data = [
            'restaurent_id'     => $restaurent_id,
            'item_id'           => $request->item_id,
            'offer_title'       => $request->offer_title,
            'offer_description' => $request->offer_description,
            'offer_startdate'   => $request->offer_startdate,
            'offer_enddate'     => $request->offer_enddate,
        ];
        $insert = offer::create($data);
        if($insert){
            return response()->json("Offer Added Successfully");
        }
    }
    public function update_offer_process(Request $request){
         $data = [
             'item_id'           => $request->item_id,
             'offer_title'       => $request->offer_title,
             'offer_description' => $request->offer_description,
             'offer_startdate'   => $request->offer_startdate,
             'offer_enddate'     => $request->offer_enddate,
         ];
         $update = offer::where('offer_id',$request->offer_id)->update($data);
         if($update){
             return response()->json("Offer Updated Successfully");
         }
     }
}
