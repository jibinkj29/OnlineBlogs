

    <body class="app sidebar-mini">

<!-- PAGE -->
<div class="page">
    <div class="page-main">
                    <!--app header-->
                <!--app header-->
           
                <!--/app header-->

                        <!--aside open-->
                 
        <!--aside closed-->
    
        <!-- App-Content -->
        <div class="app-content main-content">
            <div class="side-app">

                
                <!--Page header-->
                <div class="page-header">
                    <div class="page-leftheader">
                        <h4 class="page-title mb-0 text-primary">Banner Listing</h4>
                    </div>
                                            
                    <div class="page-rightheader">
                        <div class="btn-list">
                    
                        <a class="btn btn-primary waves-effect waves-light" href="{{ route('admin.banner.add') }}"> <i class="fa fa-plus" aria-hidden="true"></i> Add Banner</a>
                
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
<th>Desc </th> 
<th>Image</th>
<th>Status</th>
</tr>
</thead>
<tbody>
              





<tr>
<td>{{  $event->banners->id }}</td>
<td>{{  $event->banners->name }}</td>
<td>{{  $event->banners->description }}</td>
<td>
<img src="{{asset('storage/public/'. $event->banners->image)}}" alt="profile Pic" height="100" width="100">	
</td>
<td>{{  $event->banners->StatusName }}</td>
</tr>


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

