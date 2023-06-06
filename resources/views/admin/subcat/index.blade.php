@extends('admin.admin_master')
@section('need-css')
<link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.10/dist/sweetalert2.min.css">
@endsection

@section('main-content')
<div class="page-wrapper">
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Sub Category</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Sub Categories List</li>
                </ol>
            </nav>
        </div>
        
    </div>
    <div class="row">
        <!--end breadcrumb-->
    <div class="col-md-6">
        <h6 class="mb-0 text-uppercase">Sub Categories List</h6>
    </div>
   <div class="col-md-6">
    <a href="{{route('admin.subcategory.create')}}" class="btn btn-primary">Add Sub Category</a>
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
                                            Category Name:</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Position: activate to sort column ascending" style="width: 170px;">
                                            SubCategory Name:</th>
                                       
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Office: activate to sort column ascending" style="width: 73px;">
                                           Action</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($sub as $key=>$item)
                                   <tr role="row" class="odd">
                                    <td class="sorting_1">{{++$key}}</td>
                                    <td>{{($item['category']['category_name'])}}</td>
                                    <td>{{$item->sub_name}} </td>
                                    <td>
                                        <a href="{{route('admin.subcategory.edit',$item->id)}}" class="btn btn-info" title="Edit">
                                            <i class="fadeIn animated bx bx-pencil"></i>
                                        </a>
                                        <a href="{{route('admin.subcategory.delete',$item->id)}}" class="btn btn-danger" id="catDelete" title="Delete">
                                            <i class="fadeIn animated bx bx-trash"></i>
                                        </a>
                                    </td>
                                    
                                </tr>
                                   @endforeach
                                   
                                  
                                </tbody>
                                <tfoot>
									<tr>
                                        <th rowspan="1" colspan="1">SL</th>
                                        <th rowspan="1" colspan="1">Category Name</th>
                                        <th rowspan="1" colspan="1">SubCategory</th>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
      } );

      $(function(){
    $(document).on('click','#catDelete',function(e){
        e.preventDefault();
        var link = $(this).attr("href");

  
                  Swal.fire({
                    title: 'Are you sure?',
                    text: "Delete This Sub Category?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                      )
                    }
                  }) 


    });

  });

</script>
@endsection