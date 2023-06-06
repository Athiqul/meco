@extends('admin.admin_dashboard')
@section('need-css')
<link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet">
@endsection

@section('main-content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Inactive Vendors</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Inactive Vendor List</li>
                    </ol>
                </nav>
            </div>
            
        </div>
        <div class="row">
            <!--end breadcrumb-->
        <div class="col-md-6">
            <h6 class="mb-0 text-uppercase">Inactive Vendors</h6>
        </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                       
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example" class="table table-striped table-bordered dataTable" style="width: 100%;"
                                    role="grid" aria-describedby="example_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                                aria-sort="ascending" aria-label="Name: activate to sort column descending"
                                                style="width: 106px;">SL.</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                                aria-label="Position: activate to sort column ascending" style="width: 170px;">
                                                Vendor Name:</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                                aria-label="Position: activate to sort column ascending" style="width: 170px;">
                                                Email</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                                aria-label="Position: activate to sort column ascending" style="width: 170px;">
                                                Contact Number</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                                aria-label="Position: activate to sort column ascending" style="width: 170px;">
                                                Address</th>
                                            <th style="width: 73px;">
                                               Action</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($vendors as $key=>$item)
                                       <tr role="row" class="odd">
                                        <td class="sorting_1">{{++$key}}</td>
                                        <td>{{$item->name}}</td>
                                        <td> {{$item->email}}</td>
                                        <td> {{$item->contact_number}}</td>
                                        <td> {{$item->address}}</td>
                                        <td>
                                            <a href="{{route('admin.vendor.profile',$item->id)}}" class="btn btn-info" title="View">
                                                <i class="fadeIn animated bx bx-show-alt"></i>
                                            </a>
                                            
                                        </td>
                                        
                                    </tr>
                                       @endforeach
                                       
                                      
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th rowspan="1" colspan="1">SL</th>
                                            <th rowspan="1" colspan="1">Name</th>
                                            <th rowspan="1" colspan="1">Email</th>
                                            <th rowspan="1" colspan="1">Contact Number</th>
                                            <th rowspan="1" colspan="1">Address</th>
                                            <th rowspan="1" colspan="1">Action</th>
                                        
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                      
                    </div>
                </div>
            </div>
        </div>
      
    </div>
    </div>
@endsection

@section('need-js')
<script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
<script>
       $(document).ready(function() {
        $('#example').DataTable();
      } );
</script>
@endsection