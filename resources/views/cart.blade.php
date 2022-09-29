<x-header-component/>
<div class="innerBanner">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h3>Cart</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cart</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>
<div class="shopingCart">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="shopping-cart">
                  <!-- Title -->
                  <div class="title">
                    Shopping Bag
                  </div>

                  @foreach($addtocart as $item)
                  <!-- Product #1 -->
                      <div class="item">
                        <div class="buttons">
                          <a href="{{ url('remove-cart/'.$item['hash']) }}" class="delete-btn"></a>
                          <span class="like-btn"></span>
                        </div>

                        <div class="image">
                          <img src="{{ asset($item['extra_info']['image']['img']) }}" alt="" />
                        </div>

                        <div class="description">
                          <span>{{ $item['title'] }}</span>
                          <span>{{ $item['option']['size']['value'] }}</span>
                          <span>{{ $item['option']['color']['value'] }}</span>
                        </div>

                        <div class="quantity">
                          <button value="-"  id="{{ "minus_".$item['hash'] }}" onclick="minus('{{ $item['hash'] }}')"  class="minus-btn" type="button" name="button">
                          <img src="https://designmodo.com/demo/shopping-cart/minus.svg" alt="" />
                          </button>
                          <input type="number" step="1" max="10" value="{{ $item['quantatity'] }}" name="quantity" id="quantity_{{ $item['hash'] }}">
                          <button class="plus-btn" type="button" value="+" id="{{ "add_".$item['hash'] }}" onclick="add('{{ $item['hash'] }}')">
                            
                            <img src="https://designmodo.com/demo/shopping-cart/plus.svg" alt="" />
                          </button>
                        </div>

                        <div class="total-price">${{ $item['price'] }}</div>
                      </div>
                    @endforeach

                
                  <!-- Product #3 -->
                  
                </div>
          </div>
          <div class="col-md-4" id="order">
            <!-- <div class="order_summary">
             <h4>ORDER SUMMARY</h4>
                <ul class="orderDetails">
                <li>
                  <span>Subtotal</span>
                  <span>$3,430</span>
                </li>
                <li>
                  <span>Mounting fee</span>
                  <span>Free</span>
                </li>
                <li>
                  <span>US & Int. Shipping</span>
                  <span>Free</span>
                </li>
              </ul>
              <div class="totalPrice">
                <strong>Total </strong>
                <span>$3,430</span>
              </div> 
              <div class="product_details mt-5 borderOrdd">
                <ul class="ps-0">
                    <div class="row">
                        <div class="col-md-6">
                          <li><img src="https://gianzz.com/frontend/images/free-delivery.png" alt="">Fast Free Shipping</li>
                          <li><img src="https://gianzz.com/frontend/images/fast.png" alt="">Fast Express Shipping</li>
                          <li><img src="https://gianzz.com/frontend/images/returning.png" alt="">Hassle Free Return</li>
                        </div>
                        <div class="col-md-6">
                          <li><img src="https://gianzz.com/frontend/images/checkmark.png" alt="">Authenticity Guaranteed</li>
                          <li><img src="https://gianzz.com/frontend/images/shield.png" alt="">Safe &amp; Secure Checkout</li>
                          <li><img src="https://gianzz.com/frontend/images/available.png" alt="">In Stock and Ready to Ship</li>
                        </div>
                    </div>
                  </ul>
              </div>
              <div class="CheckoutBtn">
                <a href="#" class="customButton">Checkout</a>
              </div>
            </div> -->
          </div>
      </div>
  </div>
</div>
<x-footer-component/> 

<script>

$(document).ready(function(){		
		$.ajax({
               type:'GET',
               url:'/order-summery',
               success:function(data) {
               // alert(data);
					      $("#order").html(data);
               }
            });
	})

function add(productid){
		const id = "minus_"+productid
		const qtid = "quantity_"+productid
		const latestQnt = parseInt($("#"+qtid).val())+1;
		$("#"+qtid).val(latestQnt);
		if(latestQnt == 1){
			$("#"+id).css("visibility", "hidden")
		}else{
			$("#"+id).css("visibility", "visible")
		} 


		$.ajax({
               type:'GET',
               url:'/order-update-quantities',
			   data: {
					hashCode: productid,
					latestQnt: latestQnt
			   },
			   cache: false,
               success:function(data) {
				$("#order").html(data);
               }
         });
		
	}

	function minus(productid){
		const id = "minus_"+productid
		const qtid = "quantity_"+productid
		const latestQnt = parseInt($("#"+qtid).val())-1;
		if(latestQnt >=1){
			$("#"+qtid).val(latestQnt);
		}
		if(latestQnt <= 1){
			$("#"+id).css("visibility", "hidden")
		}else{
			$("#"+id).css("visibility", "visible")
		} 


		$.ajax({
               type:'GET',
               url:'/order-update-quantities',
			   data: {
					hashCode: productid,
					latestQnt: latestQnt
			   },
			   cache: false,
               success:function(data) {
				$("#order").html(data);
               }
         });

			
		
	}

</script>