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

	<body class="error-bg h-100vh">

		
		<div class="register1">

	

        	
			<div class="page">
				<div class="page-single">
					<div class="container">
						<div class="row">
							<div class="col mx-auto">
								<div class="row justify-content-center">
									<div class="col-xl-7 col-lg-12">
										<div class="row p-0 m-0">
											
											<div class="col-md-8 col-lg-6 p-0 mx-auto">
											<div class="bg-white text-dark br-7 br-tl-0 br-bl-0">
												<div class="card-body">
													<div class="text-center mb-3">
														<h1 class="mb-2">Sign Up</h1>
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
													</div>
													<form action="{{ route('user.register') }}"
													
													method="post" class="mt-5">
													@csrf
														<div class="input-group mb-4">
																<div class="input-group-text">
																	<i class="fe fe-user"></i>
																</div>
															<input type="text" class="form-control" name="username" placeholder="Name">
														</div>
                                                        <div class="input-group mb-4">
                                                            <div class="input-group-text">
                                                                <i class="fe fe-mail"></i>
                                                            </div>
                                                        <input type="text" class="form-control" name="email" placeholder="Email">
                                                    </div>
														<div class="input-group mb-4">
															<div class="input-group" id="Password-toggle">
																<a href="#" class="input-group-text">
																<i class="fe fe-eye" aria-hidden="true"></i>
																</a>
																<input class="form-control" name="password" type="password" placeholder="Password">
															</div>
														</div>
														<div class="form-group">
														
														</div>
														<div class="form-group text-center mb-3">
														
															<input type="submit"  class="btn btn-primary btn-lg w-100 br-7" name="submit" value="Register" />
														</div>
														<div class="form-group fs-13 text-center">
													
														</div>
														<div class="form-group fs-14 text-center font-weight-bold">
															<a href="{{ route('user.index') }}">Click Here To Login</a>
														</div>
													</form>
									
												</div>
											</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		
		</div>
		<!-- BACKGROUND-IMAGE CLOSED -->

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


