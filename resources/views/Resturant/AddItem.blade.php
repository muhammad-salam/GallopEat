@extends('Resturant/ResturantMasterTemplate/resturant_master_template')

@section('main_content_area')
    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Hi, welcome back!</h4>
                        <p class="mb-0">Add Items</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Form</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Validation</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"> @if(isset($products)) {{ "Edit Item" }} @else {{ "Add Item" }} @endif</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="form-valide" action="@if(isset($products)) {{ '/UpdateItem' }} @else {{ '/AddItem' }} @endif" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-item-title">Item Title
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="val-item-title" name="val-item-title" value="@isset($products[0]['item_name'] ){{ $products[0]['item_name'] }} @endisset" placeholder="Enter Item Title..">
                                                </div>
                                            </div>
                                        	<div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-item-price">Item Price
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="val-item-price" name="val-item-price" value="@isset($products[0]['item_price'] ){{ $products[0]['item_price'] }} @endisset" placeholder="Enter Item Price..">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-item-short-desc">Item Short Description
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="val-item-short-desc" value="@isset($products[0]['item_short_desc'] ){{ $products[0]['item_short_desc'] }} @endisset" name="val-item-short-desc" placeholder="Enter Item Short Desc..">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-item-desc">Item Description <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <textarea class="form-control" id="val-item-desc" name="val-item-desc" rows="5" placeholder="Describe your item here?">@isset($products){{ $products[0]['item_description'] }} @endisset</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-type">Item Type
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <select class="form-control" id="val-type" name="val-type">
                                                        <option value="">Choose Items</option>
                                                        @foreach($itemtypes as $type)
                                                            <option value="{{ $type['item_type_id'] }}" @isset($products) @if($products[0]['item_type_id'] == $type['item_type_id'] ){{ 'selected' }} @endif @endisset >{{ $type['item_type_name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-category">Item Category
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <select class="form-control" id="val-category" name="val-category">
                                                        <option value="">Choose Category</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category['category_id'] }}" @isset($products) @if($products[0]['category_id'] == $category['category_id'] ){{ 'selected' }} @endif @endisset >{{ $category['category_name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-status">Item Status
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="radio" class="radio-inline" value="0" name="val-status" id="val-status" @isset($products) @if($products[0]['item_status'] == 0 ){{ 'checked' }} @endif @endisset> In-Active
                                                        &nbsp;&nbsp;<input type="radio" class="radio-inline" value="1" name="val-status" id="val-status" @isset($products) @if($products[0]['item_status'] == 1 ){{ 'checked' }} @endif @endisset> Active
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group row">

                                                @if(isset($products))
                                                    <label class="col-lg-2 col-form-label" for="val-image">Item Image
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-4">
                                                        <input type="file" name="val-image" id = "val-image" class="form-control" required>
                                                    </div>
                                                    <div class="product-img col-lg-4"> <img src="{{ asset('uploads/items/'.$products[0]['image_path']) }}" alt="Image" width="250"></div>

                                                @else
                                                    <label class="col-lg-2 col-form-label" for="val-image">Item Image
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="file" name="val-image" id = "val-image" class="form-control" required>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                @if(isset($products)) <input type="hidden" name="_method" value="PUT"> @endif
                                                <input type="hidden" name = "_token" value="{{ csrf_token() }}"/>
                                            	<input type="hidden" name = "user_id" id = "user_id" value="@isset(session()->get('users')['user_id'] ){{ session()->get('users')['user_id'] }}@endisset"/>
                                                <input type="hidden" name="item_id" value="@isset($products) {{ $products[0]['item_id']  }} @endisset">
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-8 ml-auto" >
                                                    <button type="submit" class="btn btn-primary" id="submit">@if(isset($products)) {{ "Update" }} @else {{ "Submit" }} @endif</button>
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
    {{--<script>
        $(document).on('click','#submit',function(){

            let ItemImage        = $("#val-image")[0].files[0];
            let ItemTitle        = $("#val-item-title").val();
            let ItemShortDesc    = $("#val-item-short-desc").val();
            let ItemDescription  = $("#val-item-desc").val();
            let ItemType         = $("#val-type").val();
            let ItemCategory     = $("#val-category").val();
            let ItemStatus       = $("#val-status").val();
        	let user_id          = $("#user_id").val();
            console.log(ItemImage+"__"+ItemTitle+"__"+ItemShortDesc+"__"+ItemDescription+"__"+ItemType+"__"+ItemCategory+"__"+ItemStatus);

            var aFormdata = new FormData();

            aFormData.append('ItemTitle',ItemTitle);
            aFormData.append('ItemShortDesc',ItemShortDesc);
            aFormData.append('ItemDescription',ItemDescription);
            aFormData.append('ItemType',ItemType);
            aFormData.append('ItemCategory',ItemCategory);
            aFormData.append('ItemStatus',ItemStatus);
            aFormData.append('ItemImage',ItemImage);
        	aFormData.append('user_id',user_id);
            aFormData.append('_token','{{csrf_token()}}');

            $.ajax({
                url: "{{ route('AddItem') }}",
                type: "POST",
                headers: {"X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")},
                data: aFormdata,
                contentType: false,
                processData: false,
                success: function(response){
                    if(response)
                        window.location.href = "{{url('/AddItem')}}";
                    else
                        swal("Sorry","Failed! Please Try Again Later!","error");

                }
            });
        })
    </script>--}}
@endsection
