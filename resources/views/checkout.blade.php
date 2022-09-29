<x-header-component/>
<div class="innerBanner">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h3>Check out</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Check out</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>
<section class="chckoutsec py-7  mt-10">
	<div class="container">
		<div class="row">
			<div class="col-md-7">
				<div class="paybox">
					<p class="text-theme-red fw-bold-600">Express checkout</p>
					<div class="paymntgateway">
						<ul>
							<li><a href="#0"><img src="{{ asset('frontend/images/shop-pay.jpg') }}" alt=""></a></li>
							<li><a href="#0"><img src="{{ asset('frontend/images/amazon-pay.jpg') }}" alt=""></a></li>
							<li><a href="#0"><img src="{{ asset('frontend/images/paypal.jpg') }}" alt=""></a></li>
							<li><a href="#0"><img src="{{ asset('frontend/images/gpay.jpg') }}" alt=""></a></li>
						</ul>
					</div>
					<p class="text-theme-red fw-bold-600">Or</p>
					<div class="dvdr"></div>
				</div>
				<div class="checkoutfrm ">
					<div class="d-flex align-items-center justify-content-between mb-3">
                    <div style="color:red; padding-left:5px " id="errmsg">{{ Session::get('errmsg') }}</div>
						<p class="text-capitalize fs-6 fw-bold-500">Contact information</p>
						 <p> </p> 
					</div>
					<form  action="{{ url('/check-out') }}" method="POST" enctype="multipart/form-data" onsubmit="return valid()">
                     @csrf
					 <input type="text" class="form-control mb-3" id="email_id" name="emailid" placeholder="Email" value="">
								@if ($errors->has('emailid'))
										<span class="text-danger">{{ $errors->first('emailid') }}</span>
								@endif


						<p class="text-capitalize fs-6 fw-bold-500 mb-3">Shipping Address</p>
						<div class="row">
							
							<div class="col-md-6">
								<input type="text" class="form-control mb-2" id="fname" name="fname" placeholder="First Name" value="">
								@if ($errors->has('fname'))
                                    <span class="text-danger">{{ $errors->first('fname') }}</span>
                                @endif
							</div>
						
							<div class="col-md-6">
								<input type="text" class="form-control mb-2" id="company" name="company" placeholder="Company(optional)">
								
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control mb-2" id="address" name="address" placeholder="Address">
								@if ($errors->has('address'))
                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                @endif
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control mb-2" id="address1" name="address1" placeholder="Apartment, suite, etc">
								@if ($errors->has('address1'))
                                    <span class="text-danger">{{ $errors->first('address1') }}</span>
                               @endif
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control mb-2" id="city" name="city" placeholder="City" value="">
								@if ($errors->has('city'))
                                    <span class="text-danger">{{ $errors->first('city') }}</span>
                               @endif
							</div>
							<div class="col-md-6">
                                <input type="text" class="form-control mb-2" id="country" name="country" placeholder="Country">
								@if ($errors->has('country'))
                                    <span class="text-danger">{{ $errors->first('country') }}</span>
                                @endif
							</div>
							<div class="col-md-6">
                                <input type="text" class="form-control mb-2" id="state" name="state" placeholder="State" value="">  
								@if ($errors->has('state'))
                                    <span class="text-danger">{{ $errors->first('state') }}</span>
                                @endif
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control mb-2" id="pincode" name="pincode" placeholder="ZIP Code" value="">
								@if ($errors->has('pincode'))
                                    <span class="text-danger">{{ $errors->first('pincode') }}</span>
                               @endif
							</div>
							<div class="col-md-12">
								<input type="text" class="form-control mb-2" id="mobile_no" name="mobile_no" placeholder="Phone" value="">
								@if ($errors->has('mobile_no'))
                                    <span class="text-danger">{{ $errors->first('mobile_no') }}</span>
                               @endif
							</div>
							<div class="d-flex justify-content-between btnsec mt-3">
								<a href="{{ url('/shop/all') }}" class="customButton"><i class="bi bi-arrow-left"></i> Continue to shopping</a>
								<a href="{{ url('/add-to-cart') }}" class="customButton">return to cart <i class="bi bi-arrow-right"></i></a>
							</div>
						</div>
					<!-- </form> -->
				</div>
			</div>
			<div class="col-md-5">

				<div class="pdctsummarybx order_summary">
				
					@foreach($addtocart as $item)
					<div class="pdctordrybx">
						<div class="row">
							<div class="col-md-2">
								<div class="image position-relative">
									<img src="{{ asset( $item['extra_info']['image']['img']) }}" alt="">
									<div class="quamtitybx bg-theme-red text-white ">{{ $item['quantatity'] }}</div>
								</div>
							</div>
							<div class="col-md-8">
								<p class="">{{ $item['title']}}</p>
								<p class="text-theme-grey"><small>{{ $item['option']['size']['label']}} ({{ $item['option']['color']['label']}})</small></p>
							</div>
							<div class="col-md-2">
								<p class="bg-theme-red text-white px-1 py-1 rounded">${{ $item['price'] }}</p>
							</div>
						</div>
					</div>
				@endforeach
				
			
			<div  id="order">
						
						</div>
						<input type="hidden" name ="total_amt" id="ttotal_amt" value="" />
                         <input type="hidden" name ="pay_amt" id="ppay_amt" value="" />
						 <input type="hidden" name ="save_amt" id="ssave_amt" value="" />
						 <div class="btnsec">
				        	<button id="processtopay" class="wishlistbtn text-capitalize w-100 px-3 py-3 d-block fw-bold-600" style="background: #4c0120; color: white;">Proceed to payment</button>
				        </div>
			</from>
			
		</div>
	</div>
	
</div>
</div>
</div>
</section>
<x-footer-component/>


<script>
	$(document).ready(function(){		
		$.ajax({
               type:'GET',
               url:'/order-summery-checkout',
               success:function(data) {
					$("#order").html(data);
				  var	saveamt = $('#save_amt').val();
				  var totalamt =$('#total_amt').val();
				  var payamt = $('#pay_amt').val();
                  console.log(totalamt);
				  $('#ssave_amt').val(saveamt);
				  $('#ttotal_amt').val(totalamt);
				  $('#ppay_amt').val(payamt);
				  if(totalamt == 0){
					$('#processtopay').css("visibility", "hidden");
				  }else{
					$('#processtopay').css("visibility", "visible");
				  }
               }
            });
	})
    function valid() {
            if ($("#email_id").val() == '') {
                $("#errmsg").html("Please Enter Email ID!!");
                //$("#email").css("border-color", "red");
                return false;
            }else if ($("#fname").val() == '') {
                $("#errmsg").html("Please Enter Fast Name!!");
                //$("#email").css("border-color", "red");
                return false;
            }else if ($("#address").val() == '') {
                $("#errmsg").html("Please Enter Address!!");
                //$("#email").css("border-color", "red");
                return false;
            }else if ($("#address1").val() == '') {
                $("#errmsg").html("Please Enter Address1!!");
                //$("#email").css("border-color", "red");
                return false;
            }else if ($("#city").val() == '') {
                $("#errmsg").html("Please Enter City!!");
                //$("#email").css("border-color", "red");
                return false;
            }else if ($("#country").val() == '') {
                $("#errmsg").html("Please Enter Country!!");
                //$("#email").css("border-color", "red");
                return false;
            }else if ($("#state").val() == '') {
                $("#errmsg").html("Please Enter State!!");
                //$("#email").css("border-color", "red");
                return false;
            }else if ($("#pincode").val() == '') {
                $("#errmsg").html("Please Enter Pincode!!");
                //$("#email").css("border-color", "red");
                return false;
            }else if ($("#mobile_no").val() == '') {
                $("#errmsg").html("Please Enter Mobile No!!");
                //$("#email").css("border-color", "red");
                return false;
            }
        }

		
</script>
