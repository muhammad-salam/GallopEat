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
                            <h4 class="card-title">Update Offer</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="form-valide" id="offer_form" action="{{ route('update_offer_process') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-item-title">Offer Title
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" name="offer_title" value="{{ $offer['offer_title']}}" placeholder="Enter Offer Title..">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="offer_startdate">StartDate
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="date" class="form-control" name="offer_startdate" value="{{ $offer['offer_startdate']}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="item_id">Offer Items
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <select class="form-control" name="item_id">
                                                        <option value="">Choose Item</option>
                                                        @foreach($items as $item)
                                                            <option <?php echo $item['item_id'] == $offer['item_id']?'selected':''; ?> value="{{ $item['item_id'] }}">{{ $item['item_name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="offer_enddate">EndDate
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="date" class="form-control" name="offer_enddate" value="{{ $offer['offer_enddate']}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label" for="offer_description">Offer Description <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-9">
                                                    <textarea class="form-control" name="offer_description" rows="5" placeholder="Describe your offer here?">{{ $offer['offer_description']}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group row">
                                                <div class="col-lg-8 ml-auto" >
                                                    <input type="hidden" name="offer_id" value="{{ $offer['offer_id']}}" />
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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('form[id="offer_form"]').validate({
        rules: {
            item_id: {
                required: true,
            },
            offer_title: {
                required: true,
            },
            offer_startdate: {
                required: true,
            },
            offer_enddate: {
                required: true,
            },
        },
        messages: {
            item_id: {
                required: "<span style='color:red'>This field is required</span>",
            },
            offer_title: {
                required: "<span style='color:red'>This field is required</span>",
            },
            offer_startdate: {
                required: "<span style='color:red'>This field is required</span>",
            },
            offer_enddate: {
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
            var offer_startdate = $('[name="offer_startdate"]').val();
            var offer_enddate = $('[name="offer_enddate"]').val();
            var item_id = $('[name="item_id"]').val();
            var offer_title = $('[name="offer_title"]').val();
            var offer_description = $('[name="offer_description"]').val();
            var offer_id = $('[name="offer_id"]').val();
            var app_url = {!! json_encode(url("/")) !!};
        	var action_url = $(this).attr('action');
            $.ajax({
                url: action_url,
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}",offer_id,item_id,offer_title,offer_description,offer_startdate,offer_enddate,
                },
                success:function(response){
                    console.log(response);
                    $('form[id="offer_form"]').trigger("reset");
					toastr.success(response);
                    //window.location.href = app_url+'/offers';
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
