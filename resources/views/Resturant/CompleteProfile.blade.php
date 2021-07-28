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
    <!-- Vectormap -->
    <!-- <link href="{{asset('vendor/jqvmap/css/jqvmap.min.css')}}" rel="stylesheet"> -->

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
	                                        <li><a class="nav-link" href="#Step1">
	                                            <span>1</span>
	                                        </a></li>
	                                        <li><a class="nav-link" href="#Step2">
	                                            <span>2</span>
	                                        </a></li>
	                                        <li><a class="nav-link" href="#Step3">
	                                            <span>3</span>
	                                        </a></li>
	                                        <li><a class="nav-link" href="#Step4">
	                                            <span>4</span>
	                                        </a></li>
	                                    </ul>
	                                    <div class="tab-content">
	                                        <div id="Step1" class="tab-pane" role="tabpanel">
	                                            <div class="row">
	                                                <div class="col-lg-6 mb-2">
	                                                    <div class="form-group">
	                                                        <label class="text-label">First Name*</label>
	                                                        <input type="text" name="firstName" id="firstname"  readonly class="form-control" value="@isset(session()->get('users')['first_name']){{session()->get('users')['first_name']}}@endisset"  placeholder="firstName" required style="width: 300px;">
                                                            <input type="hidden" name = "_token" value="{{ csrf_token() }}"/>

	                                                    </div>
	                                                </div>
	                                                <div class="col-lg-6 mb-2">
	                                                    <div class="form-group">
	                                                        <label class="text-label">Last Name*</label>
	                                                        <input type="text" name="lastName" id="lastname" readonly class="form-control" value="@isset(session()->get('users')['last_name'] ){{ session()->get('users')['last_name'] }}@endisset" placeholder="lastName" required style="width: 300px;">
	                                                    </div>
	                                                </div>
	                                                <div class="col-lg-6 mb-2">
	                                                    <div class="form-group">
	                                                        <label class="text-label">Email Address*</label>
	                                                        <input type="email" class="form-control" id="emailaddress" readonly aria-describedby="inputGroupPrepend2" value="@isset(session()->get('users')['email'] ){{ session()->get('users')['email'] }}@endisset" placeholder="example@example.com" required style="width: 300px;">
	                                                    </div>
	                                                </div>
	                                                <div class="col-lg-6 mb-2">
	                                                    <div class="form-group">
	                                                        <label class="text-label">Phone Number*</label>
	                                                        <input type="text" name="phoneNumber" id="phonenumber" readonly class="form-control" value="@isset(session()->get('users')['contact_no'] ){{ session()->get('users')['contact_no'] }}@endisset"  placeholder="xxxx-xxxxxxx" required style="width: 300px;">
	                                                    </div>
	                                                </div>
                                                    <div class="col-lg-6 mb-2">
                                                        <div class="form-group">
                                                            <label class="text-label">Uplaod Image*</label>
                                                            <input type="file" name="file" class="form-control" id="userprofileimage" required style="width: 300px;">
                                                        </div>
                                                    </div>
	                                                <div class="col-lg-6 mb-3">
	                                                    <div class="form-group">
	                                                        <label class="text-label">Address*</label>
	                                                        <input type="text" name="place" id="useraddress" class="form-control" required placeholder="Your Address" style="width: 300px;">
	                                                    </div>
	                                                </div>
	                                            </div>
	                                        </div>
	                                        <div id="Step2" class="tab-pane" role="tabpanel">
	                                            <div class="row">
	                                                <div class="col-lg-6 mb-2">
	                                                    <div class="form-group">
	                                                        <label class="text-label">Business Name*</label>
	                                                        <input type="text" name="business_name" id="businessname" class="form-control" placeholder="Business Name" required>
	                                                    </div>
	                                                </div>
	                                                <div class="col-lg-6 mb-2">
	                                                    <div class="form-group">
	                                                        <label class="text-label">Business Type*</label>
                                                            <select class="form-control" name ="business_type" tabindex="1" id="businesstype" >
                                                                <option value="">Choose Category</option>
                                                                <option value="1">Restaurant</option>
                                                                <option value="2">Store</option>
                                                            </select>
	                                                    </div>
	                                                </div>
	                                                <div class="col-lg-6 mb-2">
	                                                    <div class="form-group">
	                                                        <label class="text-label">Business Address*</label>
	                                                        <input type="text" name="business_address" class="form-control" id="businessaddress" placeholder="Business Address" required>
	                                                    </div>
	                                                </div>
	                                                <div class="col-lg-6 mb-2">
	                                                    <div class="form-group">
	                                                        <label class="text-label">Business Contact No*</label>
	                                                        <input type="text" name="place" class="form-control" id="businesscontact" placeholder="xxxx-xxxxxxx" required>
	                                                    </div>
	                                                </div>
                                                    <div class="col-lg-6 mb-2">

                                                    </div>
	                                            </div>
	                                        </div>
	                                        <div id="Step3" class="tab-pane" role="tabpanel">
	                                            <div class="row">
                                                    <div class="col-lg-12 mb-2">
                                                        <div class="form-group">
                                                            <label class="text-label">Bank Statement*</label>
                                                            <input type="file" name="business_address" id="bankstatement" class="form-control" placeholder="" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mb-2">
                                                        <div class="form-group">
                                                            <label class="text-label">CNIC Front Photo*</label>
                                                            <input type="file" name="place" id="cnicfrontimage" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mb-2">
                                                        <div class="form-group">
                                                            <label class="text-label">CNIC Back Photo*</label>
                                                            <input type="file" name="place" id="cnicbackimage" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
	                                        </div>
	                                        <div id="Step4" class="tab-pane" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-lg-6 mb-2">
                                                        <div class="form-group">
                                                            <div class="col">
                                                                <div class="custom-control custom-checkbox mb-3 checkbox-success check-lg">
                                                                    <input type="checkbox" class="custom-control-input"  data-toggle="modal" data-target="#exampleModalLong" id="checkTermsConditions" required="">
                                                                    <label class="custom-control-label" for="checkTermsConditions"> &nbsp; Check Terms & Conditions!</label>
                                                                </div>
                                                            </div>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModalLong">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Terms & Conditions</h5>
                                                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                                                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                                                                            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.
                                                                            </p>
                                                                            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                                                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                                                                            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.
                                                                            </p>
                                                                            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                                                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                                                                            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.
                                                                            </p>
                                                                            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                                                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                                                                            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.
                                                                            </p>
                                                                            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                                                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                                                                            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.
                                                                            </p>
                                                                            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                                                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                                                                            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.
                                                                            </p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-danger light" data-dismiss="modal" id = "close">Close</button>
                                                                            <button type="button" class="btn btn-primary"  data-dismiss="modal" id = "agree" >Agree</button>
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

    <!-- Vectormap
    <script src="{{asset('vendor/jqvmap/js/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('vendor/jqvmap/js/jquery.vmap.world.js')}}"></script>
    <script src="{{asset('vendor/jqvmap/js/jquery.vmap.usa.js')}}"></script> -->
    <!-- All init script -->
    <!-- <script src="{{asset('js/plugins-init/jqvmap-init.js')}}"></script> -->
<script>
        $(document).ready(function(){

            // SmartWizard initialize
            $('#smartwizard').smartWizard();
            $('#agree').on('click', function () {
                $("#customCheckBox1").attr("checked", true);
            });
            $('#close').on('click', function () {
                $("#customCheckBox1").attr("checked", false);
            });


            
            $("#submitbtn").click(()=>{

                
            

                var userProfileImage = $("#userprofileimage")[0].files[0];

                var userAddress     = $("#useraddress").val();
                var BusinessName    = $("#businessname").val();
                var BusinessType    = $("#businesstype").val();
                var BusinessAddress = $("#businessaddress").val();
                var BusinessContact = $("#businesscontact").val();
                
                var bankstatement   = $("#bankstatement")[0].files[0];
                var cnicfrontimage  = $("#cnicfrontimage")[0].files[0];
                var cnicbackimage   = $("#cnicbackimage")[0].files[0];
                
                if(userProfileImage == undefined)
                {
                    swal("Sorry","Select Profile Image","error");
                    return false;
                }

                if(bankstatement == undefined)
                {
                    swal("Sorry","Please Upload Bank Statement","error");
                    return false;
                }

                if(cnicfrontimage == undefined)
                {
                    swal("Sorry","Please upload ID card front image","error");
                    return false;
                }

                if(cnicbackimage == undefined)
                {
                    swal("Sorry","Please upload ID card back image","error");
                    return false;
                }

               
                
                if(userAddress == "" || userAddress == null)
                {
                    swal("Sorry","Address should not be empty","error");
                    return false;
                }

                if(BusinessName == "" || BusinessName == null)
                {
                    swal("Sorry","Business name should not be empty","error");
                    return false;
                }

                if(BusinessType == "" || BusinessType == null)
                {
                    swal("Sorry","Business type should not be empty","error");
                    return false;
                }

                if(BusinessAddress == "" || BusinessAddress == null)
                {
                    swal("Sorry","Business address should not be empty","error");
                    return false;
                }

                if(BusinessContact == "" || BusinessContact == null)
                {
                    swal("Sorry","Business contact should not be empty","error");
                    return false;
                }


                var aFormdata = new FormData();

                aFormdata.append('userAddress',userAddress);
                aFormdata.append('BusinessName',BusinessName);
                aFormdata.append('BusinessType',BusinessType);
                aFormdata.append('BusinessAddress',BusinessAddress);
                aFormdata.append('BusinessContact',BusinessContact);

                aFormdata.append('userProfileImage',userProfileImage);
                aFormdata.append('bankstatement',bankstatement);
                aFormdata.append('cnicfrontimage',cnicfrontimage);
                aFormdata.append('cnicbackimage',cnicbackimage);
                aFormdata.append('_token','{{csrf_token()}}');

                
               

                $.ajax({
                        url: "{{ route('StoreRegistration') }}",
                        type: "POST",
                        headers: {"X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")},
                        data: aFormdata,
                        contentType: false,
                        processData: false,
                        success: function(response){
                            if(response)
                                window.location.href = "{{url('/resturant_dashboard')}}";
                            else
                                swal("Sorry","Registration Failed Please Try Again Later!","error");

                        }   
                    });
                
            })

        });
    </script>
</body>
</html>
