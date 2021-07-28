@extends('Resturant/ResturantMasterTemplate/resturant_master_template')

@section('main_content_area')
    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">
        <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Discount</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="form-valide" id="discount_form" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label-lg" for="discount_type">Discount Type
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <select class="form-control form-control-lg" name="discount_type">
                                                        <option value="">Choose Type</option>
                                                        <option value="absolute">Absolute</option>
                                                        <option value="Percentage">Percentage</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label-lg" for="discount_startdate">StartDate
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="date" class="form-control form-control-lg" name="discount_startdate">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label-lg" for="discount">Discount
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="number" class="form-control form-control-lg" name="discount">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label-lg" for="discount_enddate">EndDate
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="date" class="form-control form-control-lg" name="discount_enddate">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label-lg" for="item_id">Items
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-9">
                                                    <select class="form-control form-control-lg" name="item_id">
                                                        <option value="">Choose Item</option>
                                                        @foreach($items as $item)
                                                            <option value="{{ $item['item_id'] }}">{{ $item['item_name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group row">
                                                <div class="col-lg-8 ml-auto" >
                                                    <button type="submit" class="btn btn-info btn-sm" name="submit">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->
@endsection
@section('extra_scripts')
    <!--**********************************
        Scripts
    ***********************************-->
    <script>
    $('form[id="discount_form"]').validate({
        rules: {
            item_id: {
                required: true,
            },
            discount: {
                required: true,
            },
            discount_type: {
                required: true,
            },
            discount_enddate: {
                required: true,
            },
            discount_startdate: {
                required: true,
            },
        },
        messages: {
            item_id: {
                required: "<span style='color:red'>This field is required</span>",
            },
            discount: {
                required: "<span style='color:red'>This field is required</span>",
            },
            discount_type: {
                required: "<span style='color:red'>This field is required</span>",
            },
            discount_startdate: {
                required: "<span style='color:red'>This field is required</span>",
            },
            discount_enddate: {
                required: "<span style='color:red'>This field is required</span>",
            },		
        },
        submitHandler: function(form) {
            var offer_startdate = new Date($('[name="offer_startdate"]').val());
            var offer_enddate = new Date($('[name="offer_enddate"]').val());
            if (offer_startdate > offer_enddate){
                alert("StartDate is greater than EndDate");
                    return false;
                }
            var discount_startdate = $('[name="discount_startdate"]').val();
            var discount_enddate = $('[name="discount_enddate"]').val();
            var item_id = $('[name="item_id"]').val();
            var discount = $('[name="discount"]').val();
            var discount_type = $('[name="discount_type"]').val();
            var app_url = {!! json_encode(url("/")) !!};
            $.ajax({
                url: app_url+'/add_discount_process',
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}",item_id,discount,discount_type,discount_startdate,discount_enddate,
                },
                success:function(response){
                    console.log(response);
                    $('form[id="discount_form"]').trigger("reset");
					toastr.success(response);
                    window.location.href = app_url+'/discount';
                    return false;
                },
                error:function(error){
                    console.log(error);
                }
            });
        }
    });
</script>
@endsection
