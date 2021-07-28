<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>GallopEat - Restaurant Admin Dashboard </title>
    <!-- Favicon icon -->
	
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon.png')}}">
	<link href="{{asset('vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('vendor/chartist/css/chartist.min.css')}}">
	<link href="{{asset('vendor/jquery-smartwizard/dist/css/smart_wizard.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

</head>

<body>
	<div class="authincation d-flex flex-column flex-lg-row flex-column-fluid">
		<div class="login-aside text-center  d-flex flex-column flex-row-auto">
			<div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
				<div class="text-center mb-4 pt-5">
					<!-- <img src="images/logo-full.png" alt=""> -->
					<h1>GallopEat</h1>
				</div>
				<p>User Experience & Interface Design <br>Strategy SaaS Solutions</p>
			</div>
			<div class="aside-image" style="background-image:url(images/background/pic1.svg);"></div>
		</div>
		<div class="container flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
			<div class="d-flex justify-content-center h-100 align-items-center">
				<div class="authincation-content style-2" style="margin-left: 12%; max-width: 800px;">
					<div class="row no-gutters">
						<div class="col-xl-12 col-xxl-12 tab-content">
							<div class="card">
	                            <div class="card-header">
	                                <h4 class="card-title">Form step</h4>
	                            </div>
	                            <div class="card-body">
	                                <div id="smartwizard" class="form-wizard order-create">
	                                    <ul class="nav nav-wizard">
	                                        <li><a class="nav-link" href="#wizard_Service"> 
	                                            <span>1</span> 
	                                        </a></li>
	                                        <li><a class="nav-link" href="#wizard_Time">
	                                            <span>2</span>
	                                        </a></li>
	                                        <li><a class="nav-link" href="#wizard_Details">
	                                            <span>3</span>
	                                        </a></li>
	                                        <li><a class="nav-link" href="#wizard_Payment">
	                                            <span>4</span>
	                                        </a></li>
	                                    </ul>
	                                    <div class="tab-content">
	                                        <div id="wizard_Service" class="tab-pane" role="tabpanel">
	                                            <div class="row">
	                                                <div class="col-lg-6 mb-2">
	                                                    <div class="form-group">
	                                                        <label class="text-label">First Name*</label>
	                                                        <input type="text" name="firstName" class="form-control" placeholder="firstName" required style="width: 300px;">
	                                                    </div>
	                                                </div>
	                                                <div class="col-lg-6 mb-2">
	                                                    <div class="form-group">
	                                                        <label class="text-label">Last Name*</label>
	                                                        <input type="text" name="lastName" class="form-control" placeholder="lastName" required style="width: 300px;">
	                                                    </div>
	                                                </div>
	                                                <div class="col-lg-6 mb-2">
	                                                    <div class="form-group">
	                                                        <label class="text-label">Email Address*</label>
	                                                        <input type="email" class="form-control" id="inputGroupPrepend2" aria-describedby="inputGroupPrepend2" placeholder="example@example.com" required style="width: 300px;">
	                                                    </div>
	                                                </div>
	                                                <div class="col-lg-6 mb-2">
	                                                    <div class="form-group">
	                                                        <label class="text-label">Phone Number*</label>
	                                                        <input type="text" name="phoneNumber" class="form-control" placeholder="03001234567" required style="width: 300px;">
	                                                    </div>
	                                                </div>
	                                                <div class="col-lg-12 mb-3">
	                                                    <div class="form-group">
	                                                        <label class="text-label">Address*</label>
	                                                        <input type="text" name="place" class="form-control" required style="width: 300px;">
	                                                    </div>
	                                                </div>
	                                            </div>
	                                        </div>
	                                        <div id="wizard_Time" class="tab-pane" role="tabpanel">
	                                            <div class="row">
	                                                <div class="col-lg-6 mb-2">
	                                                    <div class="form-group">
	                                                        <label class="text-label">Company Name*</label>
	                                                        <input type="text" name="firstName" class="form-control" placeholder="Cellophane Square" required>
	                                                    </div>
	                                                </div>
	                                                <div class="col-lg-6 mb-2">
	                                                    <div class="form-group">
	                                                        <label class="text-label">Company Email Address*</label>
	                                                        <input type="email" class="form-control" id="emial1" placeholder="example@example.com.com" required>
	                                                    </div>
	                                                </div>
	                                                <div class="col-lg-6 mb-2">
	                                                    <div class="form-group">
	                                                        <label class="text-label">Company Phone Number*</label>
	                                                        <input type="text" name="phoneNumber" class="form-control" placeholder="(+1)408-657-9007" required>
	                                                    </div>
	                                                </div>
	                                                <div class="col-lg-6 mb-2">
	                                                    <div class="form-group">
	                                                        <label class="text-label">Your position in Company*</label>
	                                                        <input type="text" name="place" class="form-control" required>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                        </div>
	                                        <div id="wizard_Details" class="tab-pane" role="tabpanel">
	                                            <div class="row">
	                                                <div class="col-sm-4 mb-2">
	                                                    <h4>Monday *</h4>
	                                                </div>
	                                                <div class="col-6 col-sm-4 mb-2">
	                                                    <div class="form-group">
	                                                        <input class="form-control" value="9.00" type="number" name="input1" id="input1">
	                                                    </div>
	                                                </div>
	                                                <div class="col-6 col-sm-4 mb-2">
	                                                    <div class="form-group">
	                                                        <input class="form-control" value="6.00" type="number" name="input2" id="input2">
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <div class="row">
	                                                <div class="col-sm-4 mb-2">
	                                                    <h4>Tuesday *</h4>
	                                                </div>
	                                                <div class="col-6 col-sm-4 mb-2">
	                                                    <div class="form-group">
	                                                        <input class="form-control" value="9.00" type="number" name="input3" id="input3">
	                                                    </div>
	                                                </div>
	                                                <div class="col-6 col-sm-4 mb-2">
	                                                    <div class="form-group">
	                                                        <input class="form-control" value="6.00" type="number" name="input4" id="input4">
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <div class="row">
	                                                <div class="col-sm-4 mb-2">
	                                                    <h4>Wednesday *</h4>
	                                                </div>
	                                                <div class="col-6 col-sm-4 mb-2">
	                                                    <div class="form-group">
	                                                        <input class="form-control" value="9.00" type="number" name="input5" id="input5">
	                                                    </div>
	                                                </div>
	                                                <div class="col-6 col-sm-4 mb-2">
	                                                    <div class="form-group">
	                                                        <input class="form-control" value="6.00" type="number" name="input6" id="input6">
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <div class="row">
	                                                <div class="col-sm-4 mb-2">
	                                                    <h4>Thrusday *</h4>
	                                                </div>
	                                                <div class="col-6 col-sm-4 mb-2">
	                                                    <div class="form-group">
	                                                        <input class="form-control" value="9.00" type="number" name="input7" id="input7">
	                                                    </div>
	                                                </div>
	                                                <div class="col-6 col-sm-4 mb-2">
	                                                    <div class="form-group">
	                                                        <input class="form-control" value="6.00" type="number" name="input8" id="input8">
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <div class="row">
	                                                <div class="col-sm-4 mb-2">
	                                                    <h4>Friday *</h4>
	                                                </div>
	                                                <div class="col-6 col-sm-4 mb-2">
	                                                    <div class="form-group">
	                                                        <input class="form-control" value="9.00" type="number" name="input9" id="input9">
	                                                    </div>
	                                                </div>
	                                                <div class="col-6 col-sm-4 mb-2">
	                                                    <div class="form-group">
	                                                        <input class="form-control" value="6.00" type="number" name="input10" id="input10">
	                                                    </div>
	                                                </div>
	                                            </div>
	                                        </div>
	                                        <div id="wizard_Payment" class="tab-pane" role="tabpanel">
	                                            <div class="row emial-setup">
	                                                <div class="col-lg-3 col-sm-6 col-6">
	                                                    <div class="form-group">
	                                                        <label for="mailclient11" class="mailclinet mailclinet-gmail">
	                                                            <input type="radio" name="emailclient" id="mailclient11">
	                                                            <span class="mail-icon">
	                                                                <i class="mdi mdi-google-plus" aria-hidden="true"></i>
	                                                            </span>
	                                                            <span class="mail-text">I'm using Gmail</span>
	                                                        </label>
	                                                    </div>
	                                                </div>
	                                                <div class="col-lg-3 col-sm-6 col-6">
	                                                    <div class="form-group">
	                                                        <label for="mailclient12" class="mailclinet mailclinet-office">
	                                                            <input type="radio" name="emailclient" id="mailclient12">
	                                                            <span class="mail-icon">
	                                                                <i class="mdi mdi-office" aria-hidden="true"></i>
	                                                            </span>
	                                                            <span class="mail-text">I'm using Office</span>
	                                                        </label>
	                                                    </div>
	                                                </div>
	                                                <div class="col-lg-3 col-sm-6 col-6">
	                                                    <div class="form-group">
	                                                        <label for="mailclient13" class="mailclinet mailclinet-drive">
	                                                            <input type="radio" name="emailclient" id="mailclient13">
	                                                            <span class="mail-icon">
	                                                                <i class="mdi mdi-google-drive" aria-hidden="true"></i>
	                                                            </span>
	                                                            <span class="mail-text">I'm using Drive</span>
	                                                        </label>
	                                                    </div>
	                                                </div>
	                                                <div class="col-lg-3 col-sm-6 col-6">
	                                                    <div class="form-group">
	                                                        <label for="mailclient14" class="mailclinet mailclinet-another">
	                                                            <input type="radio" name="emailclient" id="mailclient14">
	                                                            <span class="mail-icon">
	                                                                <i class="fa fa-question-circle-o"
	                                                                    aria-hidden="true"></i>
	                                                            </span>
	                                                            <span class="mail-text">Another Service</span>
	                                                        </label>
	                                                    </div>
	                                                </div>
	                                            </div>

	                                            <div class="row">
	                                                <div class="col-12">
	                                                    <div class="skip-email text-center">
	                                                        <p>Or if want skip this step entirely and setup it later</p>
	                                                        <a href="javascript:void(0)">Skip step</a>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
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
	<script src="{{asset('vendor/global/global.min.js')}}"></script>
	<script src="{{asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
	<script src="{{asset('js/custom.min.js')}}"></script>
	<script src="{{asset('vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
	<!-- Jquery Validation -->
    <script src="{{asset('vendor/jquery-validation/jquery.validate.min.js')}}"></script>
	
	<script src="{{asset('js/login-form.js')}}"></script>
	<script src="{{asset('js/deznav-init.js')}}"></script>
	<!-- Form Steps -->
    <script src="{{asset('vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js')}}"></script>
    <!-- Form validate init -->
    <script src="{{asset('js/plugins-init/jquery.validate-init.js')}}"></script>
    <script src="{{asset('vendor/jquery-steps/build/jquery.steps.min.js')}}"></script>
    <script src="{{asset('vendor/jquery-validation/jquery.validate.min.js')}}"></script>
<script>
        $(document).ready(function(){
            // SmartWizard initialize
            $('#smartwizard').smartWizard(); 
        });
    </script>
</body>
</html>