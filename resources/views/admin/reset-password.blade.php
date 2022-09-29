<html lang="en"><head>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Forgot Password</title>

		<!--favicon -->
		<link rel="icon" href="{{asset('/favicon.ico')}}" type="image/x-icon">

		<!--Bootstrap.min css-->
		<link rel="stylesheet" href="{{asset('/assets/plugins/bootstrap/css/bootstrap.min.css')}}">
		
		<!--Style css-->
		<link rel="stylesheet" href="{{asset('/assets/css/style.css')}}">

		<!--Icons css-->
		<link rel="stylesheet" href="{{asset('/assets/css/icons.css')}}">

		<!--mCustomScrollbar css-->
		<link rel="stylesheet" href="{{asset('/assets/plugins/scroll-bar/jquery.mCustomScrollbar.css')}}">

		<!--Sidemenu css-->
		<link rel="stylesheet" href="{{asset('/assets/plugins/toggle-menu/sidemenu.css')}}">

	</head>

	<body class="bg-primary">

        <!--app open-->
		<div id="app" class="page">
			<section class="section">
				<div class="container mt-6 mb-5">

				    <!--row open-->
					<div class="row">
						<div class="single-page">
							<div class="wrapper ">
								<form  action="{{ URL::to('author/reset-email') }}" method="post" class="card-body" tabindex="500" onsubmit="return valid();">
                                @csrf
									<h4 class="text-dark text-center">Reset Your Password</h4>
                                    <span style="color:red" id="errmsg">{{ Session::get('errmsg') }}</span>
                                    <span style="color:green" id="successmsg">{{ Session::get('successmsg') }}</span>
									<div class="mail">
										<input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
										@if ($errors->has('email'))
                                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
									</div>
                                    <div class="mail">
										<input type="Password" class="form-control" id="pwd" name="pwd" placeholder="Enter Password">
										@if ($errors->has('pwd'))
                                                                <span class="text-danger">{{ $errors->first('pwd') }}</span>
                                        @endif
									</div>
									<div class="mail">
										<input type="Password" class="form-control" id="confirm_pwd" name="confirm_pwd" placeholder="Enter Confirm Password">
										@if ($errors->has('confirm_pwd'))
                                                                <span class="text-danger">{{ $errors->first('confirm_pwd') }}</span>
                                        @endif
									</div>
									<div class="submit">
										<input type="submit" class="btn btn-primary btn-block" value="Reset">
									</div>
									<div class="text-center text-dark mt-3 mb-0">
										Forget it, <a href="{{ URL::to('/author') }}">send me back</a> to the sign in.
									</div>
								</form>
							</div>
						</div>
					</div>
					<!--row closed-->

				</div>
			</section>
		</div>
		<!--app closed-->

		<!--Jquery.min js-->
		<script src="{{asset('/assets/js/jquery.min.js')}}"></script>

		<!--popper js-->
		<script src="{{asset('/assets/js/popper.js')}}"></script>

		<!--Bootstrap.min js-->
		<script src="{{asset('/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
		
		<!--Tooltip js-->
		<script src="{{asset('/assets/js/tooltip.js')}}"></script>

		<!-- Jquery star rating-->
		<script src="{{asset('/assets/plugins/rating/jquery.rating-stars.js')}}"></script>

		<!--Jquery.nicescroll.min js-->
		<script src="{{asset('/assets/plugins/nicescroll/jquery.nicescroll.min.js')}}"></script>

		<!--Scroll-up-bar.min js-->
		<script src="{{asset('/assets/plugins/scroll-up-bar/dist/scroll-up-bar.min.js')}}"></script>
		<script src="{{asset('/assets/js/moment.min.js')}}"></script>

		<!--mCustomScrollbar js-->
		<script src="{{asset('/assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js')}}"></script>

		<!--Sidemenu js-->
		<script src="{{asset('/assets/plugins/toggle-menu/sidemenu.js')}}"></script>

		<!--Showmore js-->
		<script src="{{asset('/assets/js/jquery.showmore.js')}}"></script>

		<!--Scripts js-->
		<script src="{{asset('/assets/js/scripts.js')}}"></script>
        <script>
            function valid() {
            if ($("#email").val() == '') {
                $("#errmsg").html("Please enter a valid Email ID!!");
                //$("#email").css("border-color", "red");
                return false;
            }else if ($("#pwd").val() == '') {
                $("#errmsg").html("Please enter New Password!!");
                //$("#email").css("border-color", "red");
                return false;
            }else if ($("#confirm_pwd").val() == '') {
                $("#errmsg").html("Please enter Confirm Password!!");
                //$("#email").css("border-color", "red");
                return false;
            }    
        }
        </script>
	
</body></html>