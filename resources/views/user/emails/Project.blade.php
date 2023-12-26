<body class="app sidebar-mini">

		<!-- PAGE -->
		<div class="page">
		<div class="page-main">
    	<!--app header-->
						<!--app header-->
						@include('admin.includes.header')
						<!--/app header-->

                				<!--aside open-->
								@include('admin.includes.sidebar')
				<!--aside closed-->
            
                <!-- App-Content -->
				<div class="app-content main-content">
					<div class="side-app">

                        
						<!--Page header-->
						<div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title mb-0 text-primary">Project Health</h4>
							</div>
													
							<div class="page-rightheader">
								<div class="btn-list">
							
								
								</div>
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
						@if ($message = Session::get('error'))
                          
						<strong>{{ $message }}</strong>
						 
						@endif

						@if ($message = Session::get('success'))
						
						<strong>{{ $message }}</strong>
					   
						@endif
								</div>
								</div>
								<div class="card-body">
										<div class="">

											<div class="table-responsive">
											    
												<table id="example" class="table table-bordered text-nowrap key-buttons">
													<thead>
													 
    <tr>
    <th>S.id</th>
    <th>Name </th> 
    <th>Last Activity</th>
	<th>Company</th>
	<th>Owner</th>
	<th>Dates</th>
	<th>Time Left</th>
	<th>Task Completion</th>
	<th>Budget</th>
	<!-- <th>Health</th>  --> 
	</tr>
    </thead>
    <tbody>
                      
<?php //dd($projects); ?>
@foreach ($projects['projects'] as $project)
            <tr>
			    <td>{{ $loop->iteration }}</td>
                <td>{{ $project['name'] }}
				@foreach($projects['included']['projectTaskStats'] as  $projectTaskStats)
				@if($project['id'] == $projectTaskStats['id'])
                </br>
				 {{ $projectTaskStats['late'] }} Over Due Tasks
			    @endif
    			@endforeach
				</td>
				<td> 
				<?php 
				$timestamp = $project['updatedAt'];
				$dateTime = new DateTime($timestamp);
				$formattedDate = $dateTime->format('jS M Y');
				echo $formattedDate; 
           		?>		
				</td>
				@foreach($projects['included']['companies'] as $companyId => $company)
				@if($project['companyId'] == $company['id'])
				<td> {{ $company['name'] }}</td>
			    @endif
    			@endforeach
    @foreach ($projects['included']['users'] as $users)
        @if ($project['projectOwnerId'] == $users['id'])
            <td>
                @if ($users['avatarUrl'])
                    <div class="user-image">
                        <img src="{{ $users['avatarUrl'] }}" alt="{{ $users['firstName'] }}"> 
                    </div>
                @else
                  
                    <div class="user-image">
                        <img src="{{ asset('path_to_default_image.jpg') }}" alt="Default Image"> 
                    </div>
                @endif
            </td>  
        @endif
    @endforeach


			<td>
			<?php
			    $timestamp = $project['startAt'];
				$dateTime = new DateTime($timestamp);
				$formattedDate = $dateTime->format('jS M Y');
				$timestamp2 = $project['endAt'];
				$dateTime2 = new DateTime($timestamp2);
				$formattedDate2 = $dateTime2->format('jS M Y');
				echo $formattedDate.'-'.$formattedDate2;
			?>
			</td>

			<td>

<?php			

$endAt = new DateTime($project['endAt']);
$currentDate = new DateTime();

$interval = $currentDate->diff($endAt);
$daysDifference = $interval->days;

$monthsDifference = $interval->y * 12 + $interval->m;

if ($endAt < $currentDate) {
   
        echo $monthsDifference . " month" . ($monthsDifference > 1 ? "s" : "") . " and " . abs($daysDifference) . " days over";
    
} else {
    
	    echo $monthsDifference . " month" . ($monthsDifference > 1 ? "s" : "") . " and " . $daysDifference . " days left";
    
} 
?>
</td>  
    @foreach($projects['included']['projectTaskStats'] as  $projectTaskStats)
	@if($project['id'] == $projectTaskStats['id'])
	<td> 
	<?php
    $active = $projectTaskStats['active'];
    $late = $projectTaskStats['late'];
    $complete = $projectTaskStats['complete'];
    $totalTasks = $active + $late + $complete;
    $completedTasks = $late + $complete;
    $percentage =  $percentage = ($completedTasks / $totalTasks) * 100;
	$formattedPercentage = number_format($percentage, 2);
    ?>
    {{ $formattedPercentage }} %
    </br>
    {{ $active }} Tasks Left	
	</br>
	{{ $complete }} Tasks Complete	
	</td>
	@endif
    @endforeach

	@foreach ($projects['included']['projectBudgets'] as $projectBudget)
        @if ($project['financialBudgetId'] == $projectBudget['id'])
            
			<td><?php 
			$capacityPercentage = ($projectBudget['capacityUsed']/$projectBudget['capacity'])*100;
			echo $capacityPercentageFormatted = number_format($capacityPercentage, 2).'%';
			echo '</br>';
			echo  '₹'. ($projectBudget['capacityUsed']/100). ' Of ₹'. ($projectBudget['capacity']/100);
			?> </td>	
            
        @endif
    @endforeach

    </tr>

 @endforeach
    </tbody>
												</thead>
												<tbody>
												</tbody>
												</table>


	<style>
    /* Add CSS styles for the rounded user image */
    .user-image img {
        border-radius: 50%;
        width: 100px; /* Adjust the image size as needed */
        height: 100px; /* Adjust the image size as needed */
    }
    </style>
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

    	@include('admin.includes.footer')     