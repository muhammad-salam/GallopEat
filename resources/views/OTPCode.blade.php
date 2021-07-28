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


                            @if(isset($message))
                                <p class="alert alert-{{ $class }} register-heading text-center">{{ $message }}</p>
                                <p class="text-center" id = "ajax_response"></p>
                            @endif
                            <div class="form-group">
                                <label class="mb-1 text-black"  for="OTP Code"><strong>Enter Your OTP Code</strong></label>
                                <div>
                                    <input type="text" class="form-control" name="otpcode" id = "otpcode">
                                    <br />
                                    <div class="alert alert-warning alert-dismissible fade show" id ="counter">Your Code will Expire in <span id="time">01:00</span> </div>
                                    @if($errors->has("otpcode"))
                                        @foreach($errors->get("otpcode") as $error)
                                            <span class="alert alert-danger form-control">{{ $error }}</span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name = "_token" value="{{ csrf_token() }}"/>
                            </div>
                            <div class="form-group text-center mt-4">
                                <button class="btn btn-primary btn-block verify" id="dz-signup-submit" value ="{{ session()->get('users')['user_id'] }}" >Verify</button>
                            </div>
                            <div class="new-account mt-3">
                                <p>Didn't Recieve Code? <button style="border: hidden;background: none;"class="text-primary resend" value ="{{ session()->get('users')['user_id'] }}" >Request For New One</button></p>
                            </div>
                            <div id="sign-in" class="auth-form tab-pane fade  form-validation">
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
    <script src="./vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <!-- Jquery Validation -->
    <script src="./vendor/jquery-validation/jquery.validate.min.js"></script>

    <script src="./js/login-form.js"></script>
    <script src="./js/deznav-init.js"></script>
    <script type="text/javascript">
        function ajax_success_process(responseText, status, XMLHttpRequest)
        {
            if(status == "success" && XMLHttpRequest.status == 200 && XMLHttpRequest.statusText == "OK")
            {
               if(responseText.url)
                    window.location.href = responseText.url;

                $(".register-heading").hide();
                $("#counter").hide();
                $("#ajax_response").html(responseText.message);
                $("#ajax_response").addClass(responseText.class);
            	$("#ajax_response").removeClass("alert-danger");
            }
        }

        function ajax_error_process(responseText, status, XMLHttpRequest)
        {
            $(".register-heading").hide();
            $("#ajax_response").html(responseText.message);
            $("#ajax_response").addClass(responseText.class);
        }

        $('.verify').on('click', function ($this) {

            OtpCode = $("#otpcode").val();
            if(OtpCode == "" || OtpCode == null)
            {
                swal("Sorry","OTP Code should not be empty","error");
                return false;
            }
            let user_id = $(this).val();
            let otpcode = $("#otpcode").val();
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                }
            });
            $.ajax({
                url: "{{ route('VerifyCode') }}",
                type: "POST",
                data: {_token:'{{csrf_token()}}',user_id:user_id,otpcode:otpcode},
                success: ajax_success_process,
                error: ajax_error_process
            });
        });

        $('.resend').on('click', function ($this) {
            let user_id = $(this).val();
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                }
            });
            $.ajax({
                url: "{{ route('ResendOtp') }}",
                type: "POST",
                data: {_token:'{{csrf_token()}}',user_id:user_id},
                success: ajax_success_process,
                error: ajax_error_process
            });
        });
    </script>
<script>
    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        let x = setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if (--timer == "-01") {
                clearInterval(x)
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    }
                });
                user_id = $('.resend').val();
                $.ajax({
                    url: "{{ route('ResendOtp') }}",
                    type: "POST",
                    data: {_token:'{{csrf_token()}}',user_id:user_id},
                    success: ajax_success_process,
                    error: ajax_error_process
                });
            }
        }, 1000);
    }

    window.onload = function () {
        var Minute = 60 * 1,
            display = document.querySelector('#time');
        startTimer(Minute, display);
    };
</script>
<script>
    jQuery(".form-validation").validate({
        rules: {
            "otpcode": {
                required: !0,
                minlength: 3
            }
        },
        messages: {
            "otpcode": {
                required: "Please enter a username",
                minlength: "Your username must consist of at least 3 characters"
            }
        },
        ignore: [],
        errorClass: "invalid-feedback animated fadeInUp",
        errorElement: "div",
        errorPlacement: function(e, a) {
            jQuery(a).parents(".form-group > div").append(e)
        },
        highlight: function(e) {
            jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
        },
        success: function(e) {
            jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
        },
    });

</script>
</body>
</html>
