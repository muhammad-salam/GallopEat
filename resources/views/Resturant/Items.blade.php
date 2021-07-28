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
                        <span>Datatable</span>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Datatable</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            @if(Session::get("msg") && Session::get("class"))
                                <p class="text-center alert alert-{{ session::get('class') }}" id = "ajax_response">{{ session::get('msg') }}</p>
                            @else
                                <h4 class="card-title">Items</h4>
                            @endif
                            <a href="/show_add_item_forms"><button type="button" class="btn btn-rounded btn-info btn-sm"> Add New Item </button></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr>
                                        <th>Item Image</th>
                                        <th>Item Code</th>
                                        <th>Item Title</th>
                                        <th>Item Short Desc</th>
                                        <th>Item Description</th>
                                        <th>Item Type</th>
                                        <th>Item Category</th>
                                        <th>Item Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($products as $product)
                                    <tr>
                                        <td><img class="rounded-circle" width="35" src="{{ asset('uploads/items/'.$product['image_path']) }}" alt=""></td>
                                        <td>{{ $product['item_code'] }}</td>
                                        <td>{{ $product['item_name'] }}</td>
                                        <td>{{ $product['item_short_desc'] }}</td>
                                        <td>{{ $product['item_description'] }}</td>
                                        <td>{{ $product['item_type_name'] }}</td>
                                        <td>{{ $product['category_name'] }}</td>
                                        <td><span class="label @if($product['item_status'] == '0') {{ 'label-warning' }} @elseif($product['item_status'] == '1') {{ 'label-success' }} @endif" >@if($product['item_status'] == '1') Active @elseif($product['item_status'] == '0') In-Active @endif</span></td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="/edit_item/{{$product['item_id']}}" class="btn btn-primary shadow btn-sm sharp mr-1" id = "{{$product['item_id']}}"><span>Edit</span></a>
                                                <button style="border: none;" value="{{$product['item_id']}}" class="btn btn-danger shadow btn-sm sharp delete ">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td> Sorry! No Record Found </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                    @csrf
                                    @method('post')
                                </table>
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
@section("extra_scripts")
    <!-- Datatable -->
    <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="./js/plugins-init/datatables.init.js"></script>
    <script type="text/javascript">
        $(document).ready(function(event){

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                }
            });


            function ajax_success_process(responseText, status, XMLHttpRequest)
            {
                if(status == "success" && XMLHttpRequest.status == 200 && XMLHttpRequest.statusText == "OK")
                {
                    $("#ajax_response").html(responseText.message);
                    $("#ajax_response").addClass(responseText.class);
                }
            }

            function ajax_error_process(responseText, status, XMLHttpRequest)
            {
                $("#ajax_response").html(responseText.message);
                $("#ajax_response").addClass(responseText.class);
            }
            $(document).on('click','.delete',function($this){
                // alert("dis");
                var item_id = $(this).val();
                $.ajax({
                    url: "{{ route('ItemDelete') }}",
                    type: "POST",
                    data: {_token:'{{csrf_token()}}',item_id:item_id},
                    success: ajax_success_process,
                    error: ajax_error_process
                });

            });

        });
    </script>
@endsection
