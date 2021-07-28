@extends('Resturant/ResturantMasterTemplate/resturant_master_template')

@section('main_content_area')
    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Discount</h4>
                            <a href="{{url('add_discount')}}"><button type="button" class="btn btn-rounded btn-info btn-sm"> Add Discount</button></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Item</th>
                                        <th>DiscountType</th>
                                        <th>Discount</th>
                                        <th>StartDate</th>
                                        <th>EndDate</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($discounts as $key=>$discount)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $discount['item']['item_name'] }}</td>
                                        <td>{{ $discount['discount_type'] }}</td>
                                        <td>{{ $discount['discount'] }}</td>
                                        <td>{{ date('M d, Y', strtotime($discount['discount_startdate'])) }}</td>
                                        <td>{{ date('M d, Y', strtotime($discount['discount_enddate'])) }}</td>
                                        <td>
                                            @if($discount['status']=='pending')
                                                <span class="badge light badge-warning">Pending</span>
                                                @else
                                                <span class="badge light badge-success">Approved</span>
                                            @endif
                                            
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ url('edit_discount',$discount['discount_id']) }}" class="btn btn-info shadow btn-sm sharp mr-1"><span>Edit</span></a>
                                                @if($discount['is_deleted']=='1')
                                                    <a href="{{ url('delete_discount',$discount['discount_id'])}}" class="btn btn-danger shadow btn-sm sharp mr-1"><span>Delete</span></a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center"> Sorry! No Record Found </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
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
@endsection
