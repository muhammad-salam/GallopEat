<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\Restaurant\OfferController;
use App\Http\Controllers\Restaurant\DiscountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});
// Route::get('/admin_dashboard', function ($e) {
// 	echo $e;
//     return;
// });
Route::post("/VerifyCode",[GeneralController::class,'VerifyOTP'])->name("VerifyCode");
Route::post("/StoreRegistration",[GeneralController::class,'StoreRegistration'])->name("StoreRegistration");
Route::post("/register_process",[GeneralController::class,'register_process']);
Route::post("/login_process",[GeneralController::class,'login_process']);
Route::get("/logout_page",[GeneralController::class,'logout_page']);
Route::get("/AccountVerification",[GeneralController::class,'AccountVerification']);
Route::post("/ResendOtp",[GeneralController::class,'ResendOtp'])->name("ResendOtp");
Route::get("/login_page",function()
{
	if(session()->has('users'))
	{
		$iRoleid = session()->get('users')['user_type'];
		if($iRoleid == 1)
			return redirect("/admin_dashboard");
		else if($iRoleid == 2)
			return redirect("/resturant_dashboard");
		else if($iRoleid == 3)
			return redirect("/rider_dashboard");
	}
	else
		return view("/login");
});
Route::view("/rider_complete_profile","Rider/CompleteProfile");
Route::view("/resturant_complete_profile","Resturant/CompleteProfile");
Route::view("/register_page","/register");
Route::view("/admin_dashboard","Admin/index")->middleware('admin.middleware');
Route::view("/add_stores","Admin/StoreRegistration")->middleware('admin.middleware');
Route::view("/admin_dashboard","Admin/index")->middleware('admin.middleware');

Route::view("/resturant_dashboard","Resturant/index")->middleware('resturant.middleware');
Route::post("/AddItem",[\App\Http\Controllers\RestaurantController::class,'AddItem'])->name("AddItem");
Route::put("/UpdateItem",[\App\Http\Controllers\RestaurantController::class,'UpdateItem'])->name("UpdateItem");
Route::get("/show_items",[App\Http\Controllers\RestaurantController::class,'index'])->middleware('resturant.middleware');
Route::get("/show_add_item_forms",[App\Http\Controllers\RestaurantController::class,'ShowAddItemForm'])->middleware('resturant.middleware')->name("ShowAddItemForm");
Route::get('/edit_item/{id}',[App\Http\Controllers\RestaurantController::class,'EditItemForm'])->middleware('resturant.middleware')->name('EditItemForm');
Route::post("delete_item",[App\Http\Controllers\AjaxController::class,'ItemDelete'])->name('ItemDelete');
// MUhammad SALAM CODE
Route::group(['middleware' => 'resturant.middleware'], function () {
	// Offer
	Route::get('offers',[OfferController::class,'offers'])->name('offers');
	Route::get('add_offer',[OfferController::class,'add_offer'])->name('add_offer');
	Route::post('add_offer_process',[OfferController::class,'add_offer_process'])->name('add_offer_process');
	Route::get('delete_offer/{id}',[OfferController::class,'delete_offer'])->name('delete_offer');
	Route::get('edit_offer/{id}',[OfferController::class,'edit_offer'])->name('edit_offer');
	Route::post('update_offer_process',[OfferController::class,'update_offer_process'])->name('update_offer_process');
	// Discount
	Route::get('discount',[DiscountController::class,'discount'])->name('discount');
	Route::get('add_discount',[DiscountController::class,'add_discount'])->name('add_discount');
	Route::post('add_discount_process',[DiscountController::class,'add_discount_process'])->name('add_discount_process');
	Route::get('edit_discount/{id}',[DiscountController::class,'edit_discount'])->name('edit_discount');
	Route::get('delete_discount/{id}',[DiscountController::class,'delete_discount'])->name('delete_discount');
	Route::post('update_discount_process',[DiscountController::class,'update_discount_process'])->name('update_discount_process');
});
//END MUhammad SALAM CODE
Route::view("/rider_dashboard","Rider/index")->middleware('rider.middleware');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
