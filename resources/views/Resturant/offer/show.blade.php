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
                            <h4 class="card-title">Offers</h4>
                            <a href="{{url('add_offer')}}"><button type="button" class="btn btn-rounded btn-info btn-sm"> Add New Offer </button></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Item</th>
                                        <th>OfferTitle</th>
                                        <th>Description</th>
                                        <th>StartDate</th>
                                        <th>EndDate</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($offers as $key=>$offer)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $offer['item']['item_name'] }}</td>
                                        <td>{{ $offer['offer_title'] }}</td>
                                        <td>{{ $offer['offer_description'] }}</td>
                                        <td>{{ date('M d, Y', strtotime($offer['offer_startdate'])) }}</td>
                                        <td>{{ date('M d, Y', strtotime($offer['offer_enddate'])) }}</td>
                                        <td>
                                            @if($offer['status']=='pending')
                                                <span class="badge light badge-warning">Pending</span>
                                                @else
                                                <span class="badge light badge-success">Approved</span>
                                            @endif
                                            
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ url('edit_offer',$offer['offer_id']) }}" class="btn btn-info shadow btn-sm  sharp mr-1"><span>Edit</span></a>
                                                <a href="{{ url('delete_offer',$offer['offer_id'])}}" class="btn btn-danger shadow btn-sm sharp mr-1"><span>Delete</span></a>
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
