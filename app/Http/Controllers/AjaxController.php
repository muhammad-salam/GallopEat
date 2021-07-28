<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Store;
use App\Models\Item;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;


class AjaxController extends Controller
{
    public function AddItem(Request $request){

        return "heeki";
        $sItemCode = $this->GetItemCode();

        $photo          = $request->file('ItemImage')->getClientOriginalName();
        $destination    = base_path() . '/public/uploads';
        $request->file('ItemImage')->move($destination, $photo);
        $data['image_path'] = $photo;

        $data['item_type']          = $request->input('ItemType');
        $data['item_category']      = $request->input('ItemCategory');
        $data['item_code']          = $sItemCode;
        $data['item_name']          = $request->input('ItemTitle');
        $data['item_short_desc']    = $request->input('ItemShortDesc');
        $data['item_description']   = $request->input('ItemDescription');
        $data['item_status']        = $request->input('ItemStatus');

        $result=Item::create($data);

        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function ItemDelete(Request $request)
    {
        $user_delete = Item::where("item_id", "=",$request->input("item_id"))->delete();

        if($user_delete)
        {
            $data["message"]	=  "Item Has Been Delete Successfully";
            $data["class"]		= "alert alert-success";
        }
        else
        {
            $data["message"]	=  "Item Has Not Been Deleted Please Try Again Later";
            $data["class"]		= "alert alert-danger";
        }

        return $data;
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
