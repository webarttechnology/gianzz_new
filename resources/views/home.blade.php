<x-header-component/>

<div class="banner">
	<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
	  <div class="carousel-indicators">
         @for($i = 1; $i<=$sliderCount; $i++)
	    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="{{ $i == 1?'active':''}}" aria-current="true" aria-label="Slide {{ $i }}"></button>
        @endfor
	  </div>
	  <div class="carousel-inner">
        @foreach($slider as $val)
	    <div class="carousel-item {{ $loop->index == 0?'active': ''}}">
	      <img src="{{ asset($val -> image) }}" class="d-block w-100" alt="...">
	       <div class="carousel-caption d-none d-md-block">
	        <!--<h5>We like to see you shine</h5>-->
	        <h1>It All Starts <br/> From The Heart</h1>
	        <a href="{{ url('shop') }}" class="customButton">Shop Now</a>
	      </div>
	    </div>
        @endforeach
	  </div>
	  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
	    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	    <span class="visually-hidden">Previous</span>
	  </button>
	  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
	    <span class="carousel-control-next-icon" aria-hidden="true"></span>
	    <span class="visually-hidden">Next</span>
	  </button>
	</div>
</div>

<div class="featursBox">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="featBox">
					<img src="{{ asset('frontend/images/fe1.png') }}">
					<div class="fea_cont">
						<h2>NEW ARRIVALS</h2>
						<a href="{{ url('shop') }}">shop now</a>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="featBox">
					<img src="{{ asset('frontend/images/img-3.jpg') }}">
					<div class="fea_cont">
						<h2>BEST SELLER</h2>
						<a href="{{ url('shop') }}">shop now</a>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="featBox">
					<img src="{{ asset('frontend/images/img-1.jpg') }}">
					<div class="fea_cont">
						<h2>CLEARANCE SALE</h2>
						<a href="{{ url('shop') }}">shop now</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="catagoryis">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center mb-5">
				<h2>TOP CATEGORIES</h2>
			</div>
            @foreach($categories as $val)
			
			<div class="col-md-3 text-center">
				<div class="cataBox">
				<a href="{{ url('shop?cat='. $val -> slug_categary )}}">
				    <img src="{{ asset($val -> image) }}">
				    <h3>{{ $val -> name }}</h3>
				</a>
				</div>
			</div>
            @endforeach			
		</div>
	</div>
</div>

<div class="addSection">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 ps-0 pe-0">
			    <div class="butFrame addImgs" onclick="window.location='#'">
		            <img src="{{ asset('frontend/images/banner1.webp') }}">
                    <div class="butTextWrap">
                    </div>
                </div>
			</div>
			<div class="col-md-6 ps-0 pe-0">
				<div class="addCont">
					<div class="row">
						<div class="col-md-2">
							<img src="{{ asset('frontend/images/icon.png') }}">
						</div>
						<div class="col-md-10">
							<h2>Antique rings</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua.incididunt ut labore et dolore magna aliqua.</p>
							<a href="{{ url('shop')  }}" class="customButton">Shop Now</a>
						</div>
					</div>
					<div class="row mt-5">
						<div class="col-md-2">
							<img src="{{ asset('frontend/images/icon2.png') }}">
						</div>
						<div class="col-md-10">
							<h2>Antique necklaces</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua.incididunt ut labore et dolore magna aliqua.</p>
							<a href="{{ url('shop')  }}" class="customButton">Shop Now</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="tranding">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>TRENDING PRODUCT</h2>
			</div>
		</div>
		<div class="row mt-5">
            @foreach($products as $val)	
			<div class="col-md-3">
				<a href="{{ url('product/'.$val->slug_name) }}">
					<div class="trnd_product">
						<img src="{{ asset($val -> image) }}" />
						<h3>{{ Str::limit($val -> tittle, 40) }}</h3>
						<span>$ 400.00</span>
						<!--<div class="cardHover">-->
						<!--	<a href="#"><i class="bi bi-cart"></i></a>-->
						<!--	<a href="#"><i class="bi bi-heart-fill"></i></a>-->
						<!--</div>-->
					</div>
				</a>
			</div>
			@endforeach
		
		
		</div>
		<div class="row">
			<div class="col-md-12 text-center">
				<a href="{{ url('shop')  }}" class="customButton">Shop all collection</a>
			</div>
		</div>
	</div>
</div>

<div class="lastBox">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
			    <div class="butFrame lastSecbg" onclick="window.location='#'">
                        <div class="butTextWrap">
                        </div>
                      <div class="lastCont">
    					<h3>gianzz store</h3>
    					<h4>Your dream <br/> daimond ring!!!</h4>
    					<a href="{{ url('shop') }}" class="customButton">Shop Now</a>
    				</div>
                </div>
			</div>
			<div class="col-md-6">
				<div class="subScrib">
					<h3>LATEST FROM gianzz store</h3>
					<h2>Register for get exclusive offers 5% and the latest news from</h2>
					  <div class="input-container">
					    <input type="text" name="name" placeholder="Enter your email" />
					    <a href="#">
					      <div class="button"><p>Search</p></div>
					    </a>
					  </div>
				</div>
			</div>
		</div>
		<div class="row mt-5">
			<div class="col-md-12">
				<div class="footerInfoSec">
					<div class="row">
						<div class="col-md-3 text-center">
							<i class="bi bi-truck"></i>
							<h3>free shipping</h3>
							<p>Lorem ipsum dolor sit amet.</p>
						</div>
						<div class="col-md-3 text-center">
							<i class="bi bi-phone"></i>
							<h3>support 24/7</h3>
							<p>Lorem ipsum dolor sit amet.</p>
						</div>
						<div class="col-md-3 text-center">
							<i class="bi bi-credit-card"></i>
							<h3>money return</h3>
							<p>Lorem ipsum dolor sit amet.</p>
						</div>
						<div class="col-md-3 text-center">
							<i class="bi bi-shield-check"></i>
							<h3>100% payment security</h3>
							<p>Lorem ipsum dolor sit amet.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<x-footer-component/>