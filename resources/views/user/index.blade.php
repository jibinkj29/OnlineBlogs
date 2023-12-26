<body class="app sidebar-mini">

	<!-- PAGE -->
	<div class="page">
	<div class="page-main">
	<!--app header-->
					<!--app header-->
					@include('user.includes.header')
					<!--/app header-->

							<!--aside open-->
							@include('user.includes.sidebar')
			<!--aside closed-->
		
			<!-- App-Content -->
			<div class="app-content main-content">
				<div class="side-app">

					
					<!--Page header-->
					<div class="page-header">
						<div class="page-leftheader">
							<h4 class="page-title mb-0 text-primary">Dashboard</h4>
						</div>
												
						<div class="page-rightheader">
							
						</div>
					</div>
					<!--End Page header-->

					<!-- Row -->
					<div class="row">
						<div class="col-12">

							<!--div-->
					<div class="card">
					<div class="card-header">
					<div class="card-title">
					</div>
							</div>
							<div class="card-body">
								@if ($message = Session::get('error'))
			  
								<strong>{{ $message }}</strong>
							   
								@endif
								@if ($message = Session::get('success'))
							  
								<strong>{{ $message }}</strong>
							 
								@endif
							

									<div class="">

										<div class="table-responsive">
											
											
											<form id="filterForm">
												<div class="form-group">
													<label for="postname">Post Name:</label>
													<input class="form-control" type="text" id="postname" name="postname">
												</div>
												
												<div class="form-group">
													<label class="form-label">Category</label>
													<select class="form-control" name="category[]" multiple >
														<option value="">Select</option>
														@foreach($category as $id => $name)
															<option value="{{ $id }}">{{ $name }}</option>
														@endforeach
													</select>
												</div>
												@if(auth()->user()->hasRole('admin'))
												<div class="form-group">
													<label class="form-label">User</label>
													<select class="form-control" name="user"  >
														<option value="">Select</option>
														@foreach($users as $id => $name)
															<option value="{{ $id }}">{{ $name }}</option>
														@endforeach
													</select>
												</div>
												@endif
									
												<button type="button" id="submitFilter">Filter</button>
											</form>
																				
<table id="blogs-table" class="table table-bordered text-nowrap key-buttons">
<thead>
<tr>
<th>SL</th>
<th>Category</th>
<th>Name</th>
<th>Date</th>
<th>Author</th>
<th>Image</th>
<th>Content</th>
<th width="100px">Action</th>
</tr>
</thead>

<tbody>


</tbody>
											</thead>
											<tbody>
											</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<!--/div-->


						</div>
					</div>
					<!-- /Row -->

			
				</div>
			</div>
			<!-- main-content closed -->
		</div>

	@include('user.includes.footer')     
	
	
<script>

$(document).on('click', '.delete-record', function() {

var blogId = $(this).data('id');
var deleteUrl = "{{ route('blogs.destroy', ['blog' => ':blogId']) }}";
deleteUrl = deleteUrl.replace(':blogId', blogId);
var trObj = $(this);

if (confirm("Are you sure you want to delete this post?") == true) {
$.ajax({
	url: deleteUrl ,
	type: 'DELETE',
	dataType: 'json',
	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
	success: function(data) {
		//alert(data.success);
		trObj.parents("tr").remove();
	}
});
}

});

$(document).ready(function () {
    var dataTable;

    function applyFilters() {
        var formData = $('#filterForm').serialize();

        dataTable.ajax.url("{{ route('user.dashboard') }}?" + formData).load();
    }

    $('#submitFilter').on('click', function () {
        applyFilters();
    });

    $('#filterForm').on('submit', function (e) {
        e.preventDefault();
        applyFilters();
    });

    dataTable = $('#blogs-table').DataTable({
        processing: false,
        serverSide: true,
        ajax: {
            url: "{{ route('user.dashboard') }}"
        },
		debug: false,
        columns: [
			{data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'category', name: 'category' }, 
            { data: 'name', name: 'name' },
            { data: 'date', name: 'date' },
            { data: 'author', name: 'author' },
            { data: 'image', name: 'image' },
            { data: 'content', name: 'content' },
            { data: 'action', orderable: false, searchable: false },
        ]
    });
});

    </script>