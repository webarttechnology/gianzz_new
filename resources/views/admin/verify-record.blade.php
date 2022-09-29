<html lang="en"><head>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Verify Code</title>

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
								<form  action="{{ URL::to('author/verify-record') }}" method="post" class="card-body" tabindex="500" onsubmit="return valid();">
                                @csrf
									<h4 class="text-dark text-center">Verify Record</h4>
                                    <span style="color:red" id="errmsg">{{ Session::get('errmsg') }}</span><br/>
                                    <span style="color:green" id="successmsg">{{ Session::get('successmsg') }}</span>
									<div class="mail">
										<input type="number" class="form-control" id="verification_code" name="verification_code" placeholder="Enter Verify code">
									</div>
									<div class="submit">
										<input type="submit" class="btn btn-primary btn-block" value="Submit">
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
            if ($("#verification_code").val() == '') {
                $("#errmsg").html("Please enter Verify code!!");
                //$("#email").css("border-color", "red");
                return false;
            } 
        }
        </script>
	
</body>
</html>