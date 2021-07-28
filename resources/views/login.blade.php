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
										<!-- <a href="index.html"><img src="images/logo-full.png" alt=""></a> -->
									</div>
									@if(Session::get("msg") && Session::get("class"))
						              <p class="alert alert-{{ session::get('class') }} text-center
						              ">{{ session::get('msg') }}</p>
						            @endif
						            @if(isset($message))
							            <p class="alert alert-{{ $class }} register-heading text-center">{{ $message }}</p>
							        @else            
							        	<h5 class="register-heading text-center">Proceed To Login</h5>
							        @endif
                                    <form action="/login_process" method="post">
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Email</strong></label>
                                            <input type="email" class="form-control" name="email">
                                            @if($errors->has("email"))
							                    @foreach($errors->get("email") as $error)
							                      <span class="alert alert-danger form-control">{{ $error }}</span>
							                    @endforeach
							                @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" class="form-control" name="password">
                                            @if($errors->has("password"))
							                    @foreach($errors->get("password") as $error)
							                      <span class="alert alert-danger form-control">{{ $error }}</span>
							                    @endforeach
							                @endif
                                        </div>
                                        <div class="form-group">
								            <input type="hidden" name = "_token" value="{{ csrf_token() }}"/>
								        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                               <div class="custom-control custom-checkbox ml-1">
													<input type="checkbox" class="custom-control-input" id="basic_checkbox_1">
													<label class="custom-control-label" for="basic_checkbox_1">Remember my preference</label>
												</div>
                                            </div>
                                            <div class="form-group">
                                                <a href="page-forgot-password.html">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Sign Me In</button>
                                        </div>                                        
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Don't have an account? <a class="text-primary" href="/register_page">Sign up</a></p>
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