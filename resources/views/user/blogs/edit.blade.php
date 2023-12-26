

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
                            <h4 class="page-title mb-0 text-primary">Blog Post Edit</h4>
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
                                    <h3 class="card-title">Blog Post Edit</h3>
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
                      
                                    <form  method="POST" action="{{ route('blogs.update', ['blog' => $blog->id]) }}" id="blog-upload" enctype='multipart/form-data' >
                                        @method('PUT')
                                        @csrf
                                        
                                    <input type="hidden" id="dbid" value="{{ $blog->id }}">
                                       
                                    
                                    <div class="row">
                                        <div class="alert alert-danger print-error-msg" style="display:none">
                                        <ul></ul>
                                    </div>  
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Category <span class="text-red">*</span></label>
                                            <select class="form-control" name="category[]" multiple="multiple">
                                                <option value="">Select</option>
                                                @foreach($category as $categoryId => $categoryName)
                                                    <option value="{{ $categoryId }}" @if($selectedcategory->contains('category_id', $categoryId)) selected @endif>
                                                        {{ $categoryName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            
                                                
                                        </div>
                                    </div>	
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Name<span class="text-red">*</span></label>
                                                <input type="text" name="name" value="{{ $blog->name }}" class="form-control" var blogId = formData.get('id');  placeholder="Name">
                                            </div>
                                        </div>
    
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Date<span class="text-red">*</span></label>
                                                <input type="date" name="date" value="{{ \Carbon\Carbon::parse($blog->date)->format('Y-m-d') }}" class="form-control" placeholder="Date">
  
                                            </div>
                                        </div>
    
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Author<span class="text-red">*</span></label>
                                                <input type="text" name="author" value="{{$blog->author}}" class="form-control"  placeholder="Author">
                                            </div>
                                        </div>
    
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Content<span class="text-red">*</span></label>
                                                <textarea id="content" name="content">{{$blog->content}}</textarea>

                                            </div>
                                        </div>
                                       
                                        <div class="col-sm-6 col-md-6">
                                            <img src={{ asset('storage/'.$blog->image)}} alt="Image" width="50" height="50">
                                            <label class="form-label" for="inputImage">Image:</label>
                                            <input  type="file"  name="image"  id="inputImage" class="form-control">
                                            <span class="text-danger" id="image-input-error"></span>
                                            <img id="preview-image" src="#" alt="Preview Image" style="max-width: 100px; max-height: 100px;">
    
                                        </div>
                                                                           
                                        
                                                <div class="form-footer mt-2">
                                        <input type="submit"  class="btn btn-primary" value="Update">
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
       
            <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
            <script>
                ClassicEditor
                    .create(document.querySelector('#content'))
                    .catch(error => {
                        console.error(error);
                    });
            </script>

            <script>
        $(document).ready(function () {

            $('#inputImage').change(function(){    
            let reader = new FileReader();
            reader.onload = (e) => { 
            $('#preview-image').attr('src', e.target.result); 
            }   
          
            reader.readAsDataURL(this.files[0]); 
           
            });

            $('#blog-upload').submit(function (e) {
                e.preventDefault();
                $('#image-input-error').text('');
                var formData = new FormData($(this)[0]);
            
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        
                        if (response.status === true) {
                            $('#alert').show();  
                            $('#blog-upload').find(".print-error-msg").css('display','none');
                            $('#alert').html('Blog Updated Successfully'); 
                        } else {
                            
                        }  
                        
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
         });

</script>

    
    