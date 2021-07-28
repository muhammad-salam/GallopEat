<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ItemType;
use App\Models\Item;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class RestaurantController extends Controller
{

    public function index(Request $request)
    {
    	$store_id = session()->get('users')['store_id'];
        $data['products'] = Item::select('items.*','categories.category_name','item_types.item_type_name')
            ->join('categories','items.category_id','=','categories.category_id')
            ->join('item_types','item_types.item_type_id','=','items.item_type_id')
        	->where('items.store_id','=',$store_id)
            ->get()->toArray();
    
        return view('Resturant/Items',$data);
    }
    public function ShowAddItemForm(Request $request)
    {
        $data['categories'] = Category::select('*')
            ->get()->toArray();
        $data['itemtypes'] = ItemType::select('*')
            ->get()->toArray();

        return view("Resturant/AddItem",$data);

    }
    public function EditItemForm($id)
    {
        $data['products'] = Item::select('items.*','categories.category_name','item_types.item_type_name')
            ->join('categories','items.category_id','=','categories.category_id')
            ->join('item_types','item_types.item_type_id','=','items.item_type_id')
            ->where('items.item_id','=',"$id")
            ->get()->toArray();
        $data['categories'] = Category::select('*')
            ->get()->toArray();;
        $data['itemtypes'] = ItemType::select('*')
            ->get()->toArray();

        //dd($data);
        return view("Resturant/AddItem",$data);
    }

    public function AddItem(Request $request)
    {
		$user_id = $request->input('user_id');
    	$store_id = session()->get('users')['store_id'];
    	// $aUsers = Store::select('store_id')->where('user_id','=',$user_id)
    	// ->get()->last();
    	    
        $sItemCode = $this->GetItemCode();
        $photo          = $request->file('val-image')->getClientOriginalName();
        $destination    = base_path() . '/public/uploads/items/';
        $request->file('val-image')->move($destination, $photo);
        $data['image_path'] = $photo;

        $data['item_type_id']          = $request->input('val-type');
        $data['category_id']      = $request->input('val-category');
        $data['item_code']          = $sItemCode;
        $data['item_name']          = $request->input('val-item-title');	
    	$data['item_price']          = $request->input('val-item-price');
        $data['item_short_desc']    = $request->input('val-item-short-desc');
        $data['item_description']   = $request->input('val-item-desc');
        $data['item_status']        = $request->input('val-status');
    	$data['store_id'] 			= $store_id;
    	$data['restaurent_id'] 		= session()->get('users')['user_id'];

        $result=Item::create($data);

        if($result)
        {
            return redirect("/show_items")->with(array("msg"=>"Your Item Has Been Added Successfully!", "class"=>"success"));
        }
        else
        {
            return redirect("/show_items")->with(array("msg"=>"Your Item Has Not Been Added Please Try Again Later!", "class"=>"danger"));
        }
    }
    public function UpdateItem(Request $request)
    {
    	$store_id = session()->get('users')['store_id'];
    	$sItemCode = $this->GetItemCode();
        $photo          = $request->file('val-image')->getClientOriginalName();
        $destination    = base_path() . '/public/uploads/items';
        $request->file('val-image')->move($destination, $photo);
        $data['image_path'] = $photo;
        

        $data['item_type_id']          = $request->input('val-type');
        $data['category_id']      = $request->input('val-category');
        $data['item_code']          = $sItemCode;
        $data['item_name']          = $request->input('val-item-title');	
    	$data['item_price']          = $request->input('val-item-price');
        $data['item_short_desc']    = $request->input('val-item-short-desc');
        $data['item_description']   = $request->input('val-item-desc');
        $data['item_status']        = $request->input('val-status');
    	$data['store_id'] 			= $store_id;

        $result=Item::where("item_id","=",$request->input('item_id'))->update($data);

        if($result)
        {
            return redirect("/show_items")->with(array("msg"=>"Your Item Has Been Updated Successfully!", "class"=>"success"));
        }
        else
        {
            return redirect("/show_items")->with(array("msg"=>"Your Item Has Not Been Updated Please Try Again Later!", "class"=>"danger"));
        }
    }
    function GetItemCode()
    {

            $aItemCode = Item::select('item_code')
            ->get()->last();

        if($aItemCode <> null)
        {
            $sItemCode = $aItemCode['item_code'];
            $sItemCode++;

            return($sItemCode);
        }
        else
            return("SKU00001");
    }
}
