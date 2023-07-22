@extends('admin.admin_master')
@section('need-css')
<link href="{{asset('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css')}}" rel="stylesheet">
<link rel="{{asset('assets/libs/tinymce/skins/ui/oxide/skin.min.css')}}" href="style.css">

@endsection
@section('main-content')
<div class="page-wrapper">
<div class="page-content">

				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">eCommerce</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Add New Product</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-primary">Settings</button>
							<button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
								<a class="dropdown-item" href="javascript:;">Another action</a>
								<a class="dropdown-item" href="javascript:;">Something else here</a>
								<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
							</div>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->

              <div class="card">
				  <div class="card-body p-4">
					  <h5 class="card-title">Add New Product</h5>
					  <hr>
                       <div class="form-body mt-4">
					    <div class="row">
						   <div class="col-lg-8">
                           <div class="border border-3 p-4 rounded">
                            <div class="mb-3">
								<label for="inputProductTitle" class="form-label">Product Name</label>
								<input type="text" class="form-control" id="inputProductTitle" placeholder="Enter product Name" name="name" value="{{old('name')}}" required>
							  </div>
							<div class="mb-3">
								<label for="title" class="form-label">Product Title</label>
								<input type="text" name="title" value="{{old('title')}}" class="form-control" id="title" placeholder="Enter product title">
							  </div>
							  <div class="mb-3">
								<label for="product_slug" class="form-label">Product Slug</label>
								<input type="text" name="product_slug" value="{{old('product_slug')}}" class="form-control" id="product_slug" placeholder="Enter product title">
							  </div>
							  <div class="mb-3">
								<label for="short_desc" class="form-label">Short Description</label>
								<textarea class="form-control" id="short_desc" rows="3" style="height: 173px;" name="short_desc">{{old('short_desc')}}</textarea>
							  </div>
                              <div class="mb-3">
								<label for="desc" class="form-label">Long Description</label>
								<textarea id="elm1" name="desc">{{old('desc')}}</textarea>
							  </div>
							  <div class="mb-3">
								<label for="inputProductDescription" class="form-label">Product Images</label>
								<input id="image-uploadify" name="product_images" type="file" accept="image/*" multiple="" style="display: none;">
							  </div>
                            </div>
						   </div>
						   <div class="col-lg-4">
							<div class="border border-3 p-4 rounded">
                              <div class="row g-3">
								<div class="col-md-6">
									<label for="inputPrice" class="form-label">Price</label>
									<input type="text" name="unit_price" class="form-control" id="inputPrice" placeholder="00.00">
								  </div>
								  <div class="col-md-6">
									<label for="inputCompareatprice" class="form-label">Unit Cost</label>
									<input type="text" class="form-control" id="inputCompareatprice" placeholder="00.00">
								  </div>
								  <div class="col-md-6">
									<label for="inputCostPerPrice" class="form-label">Color</label>
									<input type="text" class="form-control" id="inputCostPerPrice">
								  </div>
								  <div class="col-md-6">
									<label for="inputStarPoints" class="form-label">Weight</label>
									<input type="text" class="form-control" id="inputStarPoints" placeholder="00.00">
								  </div>
								  <div class="col-12">
									<label for="inputProductType" class="form-label">Product Type</label>
									<select class="form-select" id="inputProductType">
										<option></option>
										<option value="1">One</option>
										<option value="2">Two</option>
										<option value="3">Three</option>
									  </select>
								  </div>
								  <div class="col-12">
									<label for="inputVendor" class="form-label">Vendor</label>
									<select class="form-select" id="inputVendor">
										<option></option>
										<option value="1">One</option>
										<option value="2">Two</option>
										<option value="3">Three</option>
									  </select>
								  </div>
								  <div class="col-12">
									<label for="inputCollection" class="form-label">Collection</label>
									<select class="form-select" id="inputCollection">
										<option></option>
										<option value="1">One</option>
										<option value="2">Two</option>
										<option value="3">Three</option>
									  </select>
								  </div>
								  <div class="col-12">
									<label for="inputProductTags" class="form-label">Product Tags</label>
									<input type="text" class="form-control" id="inputProductTags" placeholder="Enter Product Tags">
								  </div>
								  <div class="col-12">
									  <div class="d-grid">
                                         <button type="button" class="btn btn-primary">Save Product</button>
									  </div>
								  </div>
							  </div>
						  </div>
						  </div>
					   </div><!--end row-->
					</div>
				  </div>
			  </div>

			</div>
</div>
@endsection
@section('need-js')
<script src="{{asset('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js')}}"></script>
<script src="https://cdn.tiny.cloud/1/b69tdpiu66ovx82jjhzsf0eooi7hehgia7avmhbdiy1s6rx4/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


<script>
    $(document).ready(function () {
        $('#image-uploadify').imageuploadify();
    })
	tinymce.init({
      selector: 'textarea#elm1',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ]
    });


</script>



@endsection
