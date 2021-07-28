<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>GallopEat - Restaurant Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
	<link href="./vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">

</head>
<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-lg-6 col-md-8">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
                                        <h1>GallopEat</h1>
										<!-- <a href="index.html"><img src="" alt="GallopEat"></a> -->
									</div>
									    @if(Session::get("msg") && Session::get("class"))
							              <p class="alert alert-{{ session::get('class') }} register-heading text-center
							              ">{{ session::get('msg') }}</p>
							              @else
							              <h4 class="text-center mb-4">Sign up your account</h4>
							            @endif
                                    <form action="{{ '/register_process' }}" method = "POST" enctype="multipart/form-data">
                                    	<div class="form-group">
                                            <label class="mb-1"><strong>First Name</strong></label>
                                            <input type="text" name= "firstname" class="form-control" placeholder="firstname" value="{{ old('firstname') }}">
                                              @if($errors->has("firstname"))
							                    @foreach($errors->get("firstname") as $error)
							                      <span class="alert alert-danger form-control">{{ $error }}</span>
							                    @endforeach
							                  @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Last Name</strong></label>
                                            <input type="text" class="form-control" name = "lastname" placeholder="lastname" value="{{ old('lastname') }}">
                                            @if($errors->has("lastname"))
							                    @foreach($errors->get("lastname") as $error)
							                      <span class="alert alert-danger form-control">{{ $error }}</span>
							                    @endforeach
							                @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Store Type</strong></label>
                                                <div class="form-group mb-0">
                                                    <label class="radio-inline mr-3"><input type="radio" name="user_type" value="2" @if(old('user_type') == '2') {{ 'Checked' }} @endif> <img src="{{asset('images/iconstore.png')}}" width="30px" height="30px" ></label>
                                                    <label class="radio-inline mr-3"><input type="radio" name="user_type" value="3" @if(old('user_type') == '3') {{ 'Checked' }} @endif> <img src="{{asset('images/iconrider.png')}}" width="30px" height="30px" ></label>
                                                </div>
                                            @if($errors->has("user_type"))
                                                @foreach($errors->get("user_type") as $error)
                                                  <span class="alert alert-danger form-control">{{ $error }}</span>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Email</strong></label>
                                            <input type="email" class="form-control" name="email" placeholder="hello@example.com" value="{{ old('email') }}">
                                            @if($errors->has("email"))
							                    @foreach($errors->get("email") as $error)
							                      <span class="alert alert-danger form-control">{{ $error }}</span>
							                    @endforeach
							                @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" class="form-control" name ="password">
                                            @if($errors->has("password"))
							                    @foreach($errors->get("password") as $error)
							                      <span class="alert alert-danger form-control">{{ $error }}</span>
							                    @endforeach
							                @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Confirm Password</strong></label>
                                            <input type="password" class="form-control" name ="confirm_password">
                                            @if($errors->has("confirm_password"))
                                                @foreach($errors->get("confirm_password") as $error)
                                                  <span class="alert alert-danger form-control">{{ $error }}</span>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Contact No</strong></label>
                                            <input type="text" class="form-control" name ="contactno" placeholder="03001234567" value="{{ old('contactno') }}">
                                            @if($errors->has("contactno"))
							                    @foreach($errors->get("contactno") as $error)
							                      <span class="alert alert-danger form-control">{{ $error }}</span>
							                    @endforeach
							                @endif
                                        </div>
                                        <div class="form-group">
							              <input type="hidden" name = "_token" value="{{ csrf_token() }}"/>
							            </div>
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary btn-block">Sign me up</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Already have an account? <a class="text-primary" href="/login_page">Sign in</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--**********************************
	Scripts
***********************************-->
<!-- Required vendors -->
<script src="./vendor/global/global.min.js"></script>
<script src="./vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="./js/custom.min.js"></script>
<script src="./js/deznav-init.js"></script>
</body>
</html>
