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
								<h4 class="page-title mb-0 text-primary">Category</h4>
							</div>
													
							<div class="page-rightheader">
								<a class="btn btn-primary waves-effect waves-light" href="{{ route('categories.create') }}"> <i class="fa fa-plus" aria-hidden="true"></i> Add Category </a>
						
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
											    
	<table id="exampleCategory" class="table table-bordered text-nowrap key-buttons">
	<thead>
	<tr>
    <th>SL</th>
	<th>Name</th>
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

$(function(e) {
var table = $('#exampleCategory').DataTable({
		processing: true,
		serverSide: true,
		ajax: "http://127.0.0.1:8000/categories",
		columns: [
			{data: 'DT_RowIndex', orderable: false, searchable: false },
			{data: 'name'},
			{data: 'action', orderable: false, searchable: false},
		],
		lengthChange: true,
		aaSorting: [[ 0, "asc" ]],
		buttons: [ 'copy', 'pdf', 'csv' ],
		language: {
			searchPlaceholder: 'Search...',
			scrollX: "100%",
			sSearch: '',
			lengthMenu: '_MENU_',
		}
	});
	
	table.buttons().container()
	.appendTo('#example_wrapper .col-md-6:eq(0)');			
	
});
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

</script>
