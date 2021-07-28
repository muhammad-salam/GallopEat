<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Foundatxion\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Store;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class GeneralController extends Controller
{
	public function index(Request $req)
	{
		return view("index");
	}
    public function register_process(Request $request)
    {
    	$controls = $request->all();
    	$dRandNo = rand(1000, 9999);
		// dd($_FILES);
		// dd($controls);
		$rules = array(
			"firstname" => "required",
			"lastname" => "required",
			"user_type" => "required",
			"email" => "required",
			"password" => "required|min:8",
			"confirm_password" => "required|same:password",
			"contactno" => "required|min:11"
		);

		$message = array(
			"required" => "Required*"
		);

		$validator = Validator::make($controls, $rules, $message);

		if($validator->fails())
		{
			return redirect("/register_page")->withErrors($validator)->withInput();
		}
		else
		{
			$password = bcrypt($request->input("password"));
			$data = array(
				"first_name" =>$request->input("firstname"),
				"user_type" =>$request->input("user_type"),
				"last_name" =>$request->input("lastname"),
				"email" =>$request->input("email"),
				"password" => $password,
				"otpcode" => $dRandNo,
				// "password" => Hash::make($request->input('password')),
				"contact_no" =>$request->input("contactno")
			);

			 // dd($_FILES);

			// $upload_path = Storage::putFileAs("public/images", $request->file("file"), $request->file("file")->getClientOriginalName());

			$result=User::create($data);

			if($result)
			{
				return redirect("/register_page")->with(array("msg"=>"User Has Been Registerd Successfully!", "class"=>"success"));
			}
			else
			{
				return redirect("/register_page")->with(array("msg"=>"User Has Not Been Registerd Please Try Again Later!", "class"=>"danger"));
			}
		}
    }

    public function login_process(Request $request)
    {
    	$controls = $request->all();
    	// dd($controls);
    	$email = $request->input("email");
    	$password = $request->input("password");

    	/*$credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);*/

    	$attempt = Auth::attempt(['email'=> $email, 'password'=> $password,'is_profile_complete'=>1]);
    	// $user = User::where('email', '=', $request->input('email'))->first();
        // $attempt = Hash::check($request->input('password'),$user['password']);
		// dd($attempt);
		// if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
		if($attempt)
		{
			$user_data = array(
				"id" => Auth::user()->id,
			);
			$request->session()->put("users", Auth::user()->toArray());
			$request->session()->put("login_user_id", $user_data);
        	$aStoreId = Store::select('store_id')
            	->where('stores.user_id','=',Auth::user()->id)
                ->get()->first();
            	if($aStoreId <> null)
            	{
                	$sStoreId = $aStoreId['store_id'];
                	// $request->session()->push('user.store_id',$sStoreId);
                	session(['users.store_id' => $sStoreId]);
            	}
			if(Auth::user()->user_type == 1)
				return redirect("/admin_dashboard");
			else if(Auth::user()->user_type == 2)
				return redirect("/resturant_dashboard");
			else if(Auth::user()->user_type == 3)
				return redirect("/rider_dashboard");

		}
		elseif (Auth::attempt(['email'=> $email, 'password'=> $password,'is_profile_complete'=>0])) {
			Auth::attempt(['email'=> $email, 'password'=> $password]);
			$request->session()->put("users", Auth::user()->toArray());
			return redirect("/AccountVerification");
		}
		else
			return redirect("/login_page")->with(array("msg"=>"Sorry! Its a Invalid Login!", "class"=>"danger"));
    }

    public function VerifyOTPCodeold(Request $request)
	{
		$email = session()->get('users')['email'];
		$password = session()->get('users')['password'];
		$otpcode = 	session()->get('users')['otpcode'];
		return $email."__".$password."__".$otpcode;
		$attempt = Auth::attempt(['email'=> $email, 'password'=> $password,'otpcode'=>$otpcode]);
		if($attempt)
		{
			if(Auth::user()->user_type == 1)
				return redirect("/admin_dashboard");
			else if(Auth::user()->user_type == 2)
				return redirect("/resturant_complete_profile");
			else if(Auth::user()->user_type == 3)
				return redirect("/rider_complete_profile");
		}
	}
	public function AccountVerification()
    {
        $otpcode = 	session()->get('users')['otpcode'];
        $email = 	session()->get('users')['email'];

        $details = [
            'title' => 'Mail from GallopEat',
            'body' => 'Your OTP Code is ',
            'OTPCode' => $otpcode
        ];

        $bMailCheck =   Mail::to($email)->send(new \App\Mail\GallopEatMaller($details));
        $data["message"] = "OTP Code Has been sent Successfully!";
        $data['class'] = "success";

        return view("OTPCode", $data);
    }

    public function VerifyOTP(Request $request)
    {
        $Users = User::select('*')
            ->where('users.user_id',$request->input("user_id"))
            ->get()->toArray();

        $email = $Users[0]['email'];
        $password = $Users[0]['password'];
        $otpcode = 	$Users[0]['otpcode'];
        $skey = $email."___".$password."___".$otpcode;
        $sSession = session()->get('users')['email']."___".session()->get('users')['password']."___".$request->input("otpcode");
        $attempt = false;
        if($skey ==$sSession )
            $attempt = true;

//        $attempt = Auth::attempt(['email'=> "xeeshanmahar@gmail.com", 'password'=> '$2y$10$cw2KeA1mRHB3Hy3Mn9eKhOKcuuqgunJWR9tQXgUCuGW5b42EQVQ1K','otpcode'=>"4699"]);
//        return $a;
        $data = [];
        if($attempt)
        {
            
            if($Users[0]['user_type'] == 1)
               $data["url"] = "/admin_dashboard";
//            return redirect("/admin_dashboard");
            else if($Users[0]['user_type'] == 2)
               $data["url"] = "/resturant_complete_profile";
//           return redirect("/resturant_complete_profile");
            else if($Users[0]['user_type'] == 3)
              $data["url"] = "/rider_complete_profile";
//                    return redirect("/rider_complete_profile");
            
        }
        else
        {
            $data["message"] = "Verified Failed! Request For New OTP Code";
            $data["class"] = "alert alert-danger";
        }
        return $data;

    }

    public function ResendOtp(Request $request)
    {
        $dRandNo = rand(1000, 9999);

        $data = array(
            "otpcode"	=>$dRandNo
        );

        $sOTPUpdated = User::where("user_id", "=",$request->input("user_id"))->update($data);
        if($sOTPUpdated)
        {
            /*$data["user"] = DB::table("users")
                ->where("user_id","=",$request->input("user_id"))
                ->get()
                ->first();*/
            $Users = User::select('*')
                ->where('users.user_id',$request->input("user_id"))
                ->get()->toArray();
            $request->session()->put("NewUsersSession", $Users);
            $otpcode = 	session()->get('NewUsersSession')[0]['otpcode'];
            $email = 	session()->get('NewUsersSession')[0]['email'];
            $details = [
                'title' => 'Mail from GallopEat',
                'body' => 'Your OTP Code is ',
                'OTPCode' => $otpcode
            ];

            $bMailCheck =   Mail::to($email)->send(new \App\Mail\GallopEatMaller($details));
            $data["message"] = "New OTP Code Has been sent Successfully!";
            $data['class'] = "alert alert-success";
        }
        else
        {
            $data["message"] = "Something Went Wrong!";
            $data['class'] = "alert alert-danger";
        }
        return $data;
    }


    public function logout_page(Request $request)
	{
		Auth::logout();

		$request->session()->flush();

		return redirect("login_page");
	}

    public function StoreRegistration(Request $request)
    {        

        $iUserId = 	session()->get('users')['user_id'];
        
        $sStoreCode = $this->GetStoreCode();
        
        //$upload_path_UserProfile    = Storage::putFileAs('/public/uploads', $request->file("userProfileImage"), $request->file("userProfileImage")->getClientOriginalName());
        
        $photo          = $request->file('userProfileImage')->getClientOriginalName();
        $destination    = base_path() . '/public/uploads';
        $request->file('userProfileImage')->move($destination, $photo);
        $data['profile_image'] = $photo; 

        $data['user_address']       = $request->input('userAddress');
        $data['is_profile_complete'] = 1;

        $sUserUpdated = User::where("user_id", "=",$iUserId)->update($data);
    	// session()->get('users')['is_profile_complete']
        // $request->session()->push('users.is_profile_complete','1');
    	session(['users.is_profile_complete' => '1']);
    	
    	// $request->session()->push('user.teams', 'developers');
        unset($data);

        if($sUserUpdated)
        {
            // $upload_path_BankStatement  = Storage::putFileAs('/public/uploads', $request->file("bankstatement"), $request->file("bankstatement")->getClientOriginalName());
            // $upload_path_CNICFront      = Storage::putFileAs('/public/uploads', $request->file("cnicfrontimage"), $request->file("cnicfrontimage")->getClientOriginalName());
            // $upload_path_CNICBack       = Storage::putFileAs('/public/uploads', $request->file("cnicbackimage"), $request->file("cnicbackimage")->getClientOriginalName());

            $photo          = $request->file('bankstatement')->getClientOriginalName();
            $destination    = base_path() . '/public/uploads';
            $request->file('bankstatement')->move($destination, $photo);
            $data['bank_statement_image'] = $photo;

            $photo          = $request->file('cnicfrontimage')->getClientOriginalName();
            $destination    = base_path() . '/public/uploads';
            $request->file('cnicfrontimage')->move($destination, $photo);
            $data['id_card_front_image']   =  $photo;
            
            $photo          = $request->file('cnicbackimage')->getClientOriginalName();
            $destination    = base_path() . '/public/uploads';
            $request->file('cnicbackimage')->move($destination, $photo);
            $data['id_card_back_image']    =   $photo;
            
            $data['store_name']          = $request->input('BusinessName');
            $data['store_type']          = $request->input('BusinessType');
            $data['store_address']       = $request->input('BusinessAddress');
            $data['store_contact']       = $request->input('BusinessContact');
            $data['store_code']          = $sStoreCode;
            $data['user_id']             = $iUserId;
            
            $result=Store::create($data);

			if($result)
			{
            	$aStoreId = Store::select('store_id')
                ->get()->last();
            	if($aStoreId <> null)
            	{
                	$sStoreId = $aStoreId['store_id'];
                	// $request->session()->push('user.store_id',$sStoreId);
                	session(['users.store_id' => $sStoreId]);
                	return true;
            	}
            }
			else
			{
                return false;
			}

        }
        else
        {
            return false;
        }
    }


    function GetStoreCode()
    {
        
        $aStoreCode = store::select('store_code')
                        ->get()->last();
                
        if($aStoreCode <> null)
        {
            $sStoreCode = $aStoreCode['store_code']; 
            $sStoreCode++;
            
            return($sStoreCode);
        }
        else
        return("RES00001");
    }
}
