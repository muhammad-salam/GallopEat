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
                            <h4 class="card-title">Update Discount</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="form-valide" id="discount_form" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="discount_type">Discount Type
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <select class="form-control" name="discount_type">
                                                        <option value="">Choose Type</option>
                                                        <option value="Absolute" <?php echo $discount['discount_type']=='Absolute'?'selected':'';?>>Absolute</option>
                                                        <option value="Percentage" <?php echo $discount['discount_type']=='Percentage'?'selected':'';?>>Percentage</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="discount_startdate">StartDate
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="date" class="form-control" name="discount_startdate" value="{{$discount['discount_startdate']}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="discount">Discount
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="number" class="form-control" name="discount" value="{{$discount['discount']}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="discount_enddate">EndDate
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="date" class="form-control" name="discount_enddate" value="{{$discount['discount_enddate']}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label" for="item_id">Items
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-9">
                                                    <select class="form-control" name="item_id">
                                                        <option value="">Choose Item</option>
                                                        @foreach($items as $item)
                                                            <option <?php echo $item['item_id']==$discount['item_id']?'selected':'';?> value="{{ $item['item_id'] }}">{{ $item['item_name'] }}</option>
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
                                                    <input type="hidden" name="discount_id" value="{{ $discount['discount_id']}}" />
                                                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
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
            var discount_startdate = new Date($('[name="discount_startdate"]').val());
            var discount_enddate = new Date($('[name="discount_enddate"]').val());
            if (discount_startdate > discount_enddate){
                alert("StartDate is greater than EndDate");
                return false;
            }
            var discount_startdate = $('[name="discount_startdate"]').val();
            var discount_enddate = $('[name="discount_enddate"]').val();
            var item_id = $('[name="item_id"]').val();
            var discount = $('[name="discount"]').val();
            var discount_type = $('[name="discount_type"]').val();
            var discount_id = $('[name="discount_id"]').val();
            var app_url = {!! json_encode(url("/")) !!};
            $.ajax({
                url: app_url+'/update_discount_process',
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}",discount_id,item_id,discount,discount_type,discount_startdate,discount_enddate,
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
