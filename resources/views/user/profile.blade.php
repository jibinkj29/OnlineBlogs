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
							<h4 class="page-title mb-0 text-primary">User Profile</h4>
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

										
																				
<table id="profile-table" class="table table-bordered text-nowrap key-buttons">
<thead>
<tr>
<th>SL</th>
<th>Name</th>
<th>Email</th>
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



$(document).ready(function () {
   

   
    dataTable = $('#profile-table').DataTable({
        processing: false,
        serverSide: true,
        ajax: {
            url: "{{ route('user.profile') }}"
        },
		debug: false,
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'action', orderable: false, searchable: false },
        ]
    });
});

    </script>