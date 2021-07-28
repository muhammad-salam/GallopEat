<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>GallopEat - Restaurant Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
	<link href="./vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
	<link href="./vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">

</head>

<body>
	<div class="authincation d-flex flex-column flex-lg-row flex-column-fluid">
		<div class="login-aside text-center  d-flex flex-column flex-row-auto">
			<div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
				<div class="text-center mb-4 pt-5">
					<h1>GallopEat</h1>
					<!-- <img src="images/logo-full.png" alt=""> -->
				</div>
				<p>User Experience & Interface Design <br>Strategy SaaS Solutions</p>
			</div>
			<div class="aside-image" style="background-image:url(images/background/pic1.svg);"></div>
		</div>
		<div class="container flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
			<div class="d-flex justify-content-center h-100 align-items-center">
				<div class="authincation-content style-2">
					<div class="row no-gutters">
						<div class="col-xl-12 tab-content">
							<div id="sign-up" class="auth-form tab-pane fade show active  form-validation">
								<form action="/login_process" method="post">
									@if(Session::get("msg") && Session::get("class"))
						              <p class="alert alert-{{ session::get('class') }} text-center
						              ">{{ session::get('msg') }}</p>
						            @endif
						            @if(isset($message))
							            <p class="alert alert-{{ $class }} register-heading text-center">{{ $message }}</p>
							        @else            
							        	<h3 class="text-center mb-4 text-black">Sign in your account</h3>
							        @endif
									<div class="form-group">
										<label class="mb-1 text-black"  for="val-email"><strong>Email</strong></label>
										<div>
											<input type="email" class="form-control" name="email">
                                            @if($errors->has("email"))
							                    @foreach($errors->get("email") as $error)
							                      <span class="alert alert-danger form-control">{{ $error }}</span>
							                    @endforeach
							                @endif
										</div>
									</div>
									<div class="form-group">
										<label class="mb-1 text-black"  for="val-password"><strong>Password</strong></label>
										<div>
											<input type="password" class="form-control" name="password">
                                            @if($errors->has("password"))
							                    @foreach($errors->get("password") as $error)
							                      <span class="alert alert-danger form-control">{{ $error }}</span>
							                    @endforeach
							                @endif
										</div>
									</div>
									<div class="form-group">
								            <input type="hidden" name = "_token" value="{{ csrf_token() }}"/>
								        </div>
									<div class="form-group text-center mt-4">
										<button type="submit" class="btn btn-primary btn-block" id="dz-signup-submit" >Sign in</button>
									</div>
								</form>
								<div class="new-account mt-3">
									<p>Don't have an account? <a class="text-primary" href="/register_page" >Sign up</a></p>
								</div>
							</div>
							<div id="sign-in" class="auth-form tab-pane fade  form-validation">								
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
	<script src="./vendor/sweetalert2/dist/sweetalert2.min.js"></script>
	<!-- Jquery Validation -->
    <script src="./vendor/jquery-validation/jquery.validate.min.js"></script>
	
	<script src="./js/login-form.js"></script>
	<script src="./js/deznav-init.js"></script>
</body>
</html>