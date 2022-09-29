<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>

	
	
	<link rel="preload" href="{{ asset('frontend/fonts/Glamourn-Regular.woff2') }}" as="font" type="font/woff2" crossorigin>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	
	<link rel="stylesheet" type="text/css" href="{{ asset('font/css/style.css') }}">
	
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/stellarnav.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/media.css') }}">

	
</head>
<body>
	<header>
		<div class="topHeader">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<h3>Free Call : +1 1584993359</h3>
					</div>
					<div class="col-md-8 text-end">
						<h3>FREE USA DELIVERY ON ALL ORDERS OVER £50</h3>
					</div>
				</div>
			</div>
		</div>
		<div class="mainMenu">
			<div class="container">
				<div class="row">
					<!-- <div class="col-md-5">
						<ul class="ps-0 mt-4 ">
							<li><a href="{{ url('') }}" class="activeCat">Home</a></li>
							<li><a href="" class="activeCat">About us</a></li>
							<li><a href="{{ url('shop') }}" class="activeCat">Shop now</a></li>
						</ul>
					</div> -->
					<div class="col-md-2">
						<div class="logo">
							<img src="{{ asset('frontend/images/bannertext.png') }}">
						</div>
					</div>
					<div class="col-md-5 text-end">
						<ul class="ps-0 mt-4">
							<li><a href="#"><i class="bi bi-search"></i></a></li>
							@if(Session::get('frontendloginStatus') == true)
							    <li><a href="{{ url('my-account') }}"><i class="bi bi-person-circle"></i></a></li>
								<li><a href="{{ url('logout') }}"><i class="">Logout</i></a></li>
							@else
								<li><a href="{{ url('login') }}"><i class="">Login</i></a></li>
							@endif
							<li class="CartItem"><a href="{{ url('add-to-cart') }}"><span class="cartCout" id="courtcount">{{ count($cartcount) }}</span> <i class="bi bi-bag-fill"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="stellarnav mobileMenu">
		<ul>
			<li><a href="">Dropdown</a>
		    	<ul>
    		<li><a href="#">How deep?</a>
    		<ul>
        		<li><a href="#">Deep</a>
        			<ul>
        				<li><a href="#">Even deeper</a>
        					<ul>
        						<li><a href="#">Item</a></li>
        						<li><a href="#">Item</a></li>
        						<li><a href="#">Item</a></li>
        					</ul>
        				</li>
        				<li><a href="#">Item</a></li>
        				<li><a href="#">Item</a></li>
        				<li><a href="#">Item</a></li>
        			</ul>
        		</li>
        		<li><a href="#">Item</a></li>
        		<li><a href="#">Item</a></li>
        		<li><a href="#">Item</a></li>
        		<li><a href="#">Item</a></li>
    		</ul>
    	</li>
    	<li><a href="#">Item</a>
    		<ul>
        		<li><a href="#">Item</a></li>
        		<li><a href="#">Item</a></li>
        		<li><a href="#">Item</a></li>
        		<li><a href="#">Item</a></li>
    		</ul>
    	</li>
    	<li><a href="#">Item</a>
    		<ul>
    			<li><a href="#">Deeper</a>
    				<ul>
    					<li><a href="#">Item</a></li>
    					<li><a href="#">Item</a></li>
    					<li><a href="#">Item</a></li>
    				</ul>
    			</li>
    			<li><a href="#">Item</a></li>
    			<li><a href="#">Item</a></li>
    			<li><a href="#">Item</a></li>
    		</ul>
    	</li>
    	<li><a href="#">Here's a very long item.</a>
    		<ul>
        		<li><a href="#">Item</a></li>
        		<li><a href="#">Item</a></li>
        		<li><a href="#">Item</a></li>
        		<li><a href="#">Item</a></li>
    		</ul>
    	</li>
    </ul>
    </li>
    
    <li><a href="">Item 2</a></li>
    <li><a href="">Item 3</a></li>
    <li><a href="">Item 4</a></li>
    <li><a href="">Item 5</a></li>
    <li><a href="">Item 6</a></li>
    <li class="drop-left"><a href="">Drop Left</a>
    <ul>
    	<li><a href="#">How deep?</a>
    		<ul>
        		<li><a href="#">Deep</a>
        			<ul>
        				<li><a href="#">Even deeper</a>
        					<ul>
        						<li><a href="#">Item</a></li>
        						<li><a href="#">Item</a></li>
        						<li><a href="#">Item</a></li>
        					</ul>
        				</li>
        				<li><a href="#">Item</a></li>
        				<li><a href="#">Item</a></li>
        				<li><a href="#">Item</a></li>
        			</ul>
        		</li>
        		<li><a href="#">Item</a></li>
        		<li><a href="#">Item</a></li>
        		<li><a href="#">Item</a></li>
        		<li><a href="#">Item</a></li>
    		</ul>
    	</li>
    	<li><a href="#">Item</a></li>
    	<li><a href="#">Item</a></li>
    	<li><a href="#">Item</a></li>
    	<li><a href="#">Item</a></li>
    </ul>
    </li>
    </ul>
    </div>
	</header>
	
	
	
	