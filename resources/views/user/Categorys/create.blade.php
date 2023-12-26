

    <body class="app sidebar-mini">

	    
<!-- PAGE -->
<div class="page">
    <div class="page-main">
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
                        <h4 class="page-title mb-0 text-primary">Category  Adding</h4>
                    </div>
                    
                    
            <div class="page-rightheader">
            <div class="btn-list">             
            </div>
            </div>
            </div>
            

                
                
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Category Adding</h3>
                            </div>
                            <div class="card-body">
                                
                    @if(count($errors) > 0)
                          
                    @foreach($errors->all() as $error)
                    {{ $error }}<br>
                    @endforeach
                    </div>
                    @endif
                      @if ($message = Session::get('error'))
                  
                    <strong>{{ $message }}</strong>
                   
                    @endif
                    @if ($message = Session::get('success'))
                  
                    <strong>{{ $message }}</strong>
                 
                    @endif

                    <div class="alert alert-warning alert-block" id="alert" style="display: none;"></div>
                  
                                <form  method="post" id="blog-upload" enctype='multipart/form-data' >
                                @csrf
                                
                                <div class="row">
                                    <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>  
                               
                                  
                                        
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Name<span class="text-red">*</span></label>
                                            <input type="text" name="name" value="" class="form-control"  placeholder="Name">
                                        </div>
                                    </div>

                                   
                             
                                   
                                                                       
                                    
                                            <div class="form-footer mt-2">
                                    <input type="submit"  class="btn btn-primary" value="Submit">
                                </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
            
                </div>
                
        

        
            </div>
        </div>
        <!-- main-content closed -->
    </div>

    @include('user.includes.footer')  
   
    
   
    <script type="text/javascript">
      
        
          
        /*------------------------------------------
        --------------------------------------------
        Form Submit Event
        --------------------------------------------
        --------------------------------------------*/
        $('#blog-upload').submit(function(e) {
               e.preventDefault();
               let formData = new FormData(this);
          
        
               $.ajax({
                    type:'POST',
                    url: "{{ route('categories.store') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        this.reset();
                        $('#alert').show();  
                        $('#blog-upload').find(".print-error-msg").css('display','none');
                        $('#alert').html('Blog Created Successfully'); 
                      
                    },
                    error: function(response){
                        $('#blog-upload').find(".print-error-msg").find("ul").html('');
                        $('#blog-upload').find(".print-error-msg").css('display','block');
                        $.each( response.responseJSON.errors, function( key, value ) {
                            $('#blog-upload').find(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                        });
                    }
               });
        });
            
    </script>

