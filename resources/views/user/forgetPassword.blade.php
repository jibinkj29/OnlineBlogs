<!DOCTYPE html>
<html lang="en" dir="ltr">
	
<!-- Mirrored from codeigniter.spruko.com/azea/ltr/pages/login-1 by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Dec 2021 07:17:21 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>

		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="Laravel" name="description">
		<meta content="SPRUKO™" name="author">
		<meta name="keywords" content="Laravel">

		<!-- Title -->
		<title>Laravel</title>

                <!--Favicon -->
        <link rel="icon" href="/assests/images/brand/favicon.png" type="image/x-icon"/>

<!--Bootstrap css -->
<link href="/assests/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">


	
<!-- Style css -->
<link href="/assests/css/style.css" rel="stylesheet" />
<link href="/assests/css/dark.css" rel="stylesheet" />
<link href="/assests/css/skin-modes.css" rel="stylesheet" />

<!-- Animate css -->
<link href="/assests/css/animated.css" rel="stylesheet" />

<!---Icons css-->
<link href="/assests/css/icons.css" rel="stylesheet" />

<!-- Color Skin css -->
<link id="theme" href="/assests/colors/color1.css" rel="stylesheet" type="text/css"/>

    </head>

<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Reset Password</div>
                    <div class="card-body">
    
                      @if (Session::has('message'))
                           <div class="alert alert-success" role="alert">
                              {{ Session::get('message') }}
                          </div>
                      @endif
    
                        <form action="{{ route('forget.password.post') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </form>
                          
                    </div>
                </div>
            </div>
        </div>
    </div>
  </main>
    		<!-- Jquery js-->
            <script src="/assests/js/jquery.min.js"></script>

            <!-- Bootstrap5 js-->
            <script src="/assests/plugins/bootstrap/popper.min.js"></script>
            <script src="/assests/plugins/bootstrap/js/bootstrap.min.js"></script>
    
            <!-- Jquery-rating js-->
            <script src="/assests/plugins/rating/jquery.rating-stars.js"></script>
    
            <!--Othercharts js-->
            <script src="/assests/plugins/othercharts/jquery.sparkline.min.js"></script>		
    
            
            <!--Othercharts js-->
            <script src="/assests/plugins/othercharts/jquery.sparkline.min.js"></script>
    
            <!-- Show Password -->
            <script src="/assests/js/bootstrap-show-password.min.js"></script>
    
        
            <!-- Custom js-->
            <script src="/assests/js/custom.js"></script>
        </body>
    
    <!-- Mirrored from codeigniter.spruko.com/azea/ltr/pages/login-1 by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Dec 2021 07:17:21 GMT -->
    </html>
    