<x-header-component/>
<div class="innerBanner">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h3>Product Details</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product Details</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>
<div class = "card-wrapper">
  <div class = "card">
    <!-- card left -->
    <div class = "product-imgs">
      <div class = "img-display">
        <div class = "img-showcase">
          <img src = "{{ asset($productDetails->image) }}" alt = "shoe image">
          <img src = "{{ asset($productDetails->image1) }}" alt = "shoe image">
          <img src = "{{ asset($productDetails->image2) }}" alt = "shoe image">
          <img src = "{{ asset($productDetails->image3) }}" alt = "shoe image">
        </div>
      </div>
      <div class = "img-select">
      
        <div class = "img-item">
          <a href = "{{ asset($productDetails->image) }}" data-id ="1">
            <img src = "{{ asset($productDetails->image) }}" alt = "shoe image" >
          </a>
        </div>
        
        @if($productDetails ->image1 != Null)
        <div class = "img-item">
       
          <a href = "{{ asset($productDetails->image1) }}" data-id ="2">
            <img src = "{{ asset($productDetails->image1) }}" alt = "shoe image">
          </a>
          
        </div>
        @else

        <div class = "img-item sliderItem">
       
       <a href = "{{ asset($productDetails->image1) }}" data-id ="2">
         <img src = "{{ asset($productDetails->image1) }}" alt = "shoe image">
       </a>
       
     </div>

        @endif
        
        @if($productDetails ->image2 != Null)
        <div class = "img-item">
        
          <a href = "{{ asset($productDetails->image2) }}" data-id = "3">
            <img src = "{{ asset($productDetails->image2) }}" alt = "shoe image">
          </a>
        </div>
        @else
        <div class = "img-item sliderItem">
        
        <a href = "{{ asset($productDetails->image2) }}" data-id = "3">
          <img src = "{{ asset($productDetails->image2) }}" alt = "shoe image">
        </a>
      </div>
        @endif
       
        @if($productDetails ->image3 != Null)
        <div class = "img-item">
            <a href = "{{ asset($productDetails->image3) }}" data-id = "4">
              <img src = "{{ asset($productDetails->image3) }}" alt = "shoe image">
            </a>
        </div>
        @else
        <div class = "img-item sliderItem">
            <a href = "{{ asset($productDetails->image3) }}" data-id = "4">
              <img src = "{{ asset($productDetails->image3) }}" alt = "shoe image">
            </a>
        </div>
        @endif
       
      </div>
    </div>
    <!-- card right -->
    <div class = "product-content product_details">
      <h2 id="title_p" class = "product-title">{{ $productDetails->tittle }}</h2>
      <div class = "product-rating">
        <i class = "fas fa-star"></i>
        <i class = "fas fa-star"></i>
        <i class = "fas fa-star"></i>
        <i class = "fas fa-star"></i>
        <i class = "fas fa-star-half-alt"></i>
        
      </div>

      <div class = "product-price">
        <p class = "last-price">Old Price: $<span id="price">{{ $productDetails->is_variation == 1?number_format($rope_chain->amount,2):number_format($productDetails->p_amt,2) }}</span></p>
        <p class = "new-price">New Price: $<span id="finalPrice">{{ $productDetails->is_variation == 1?number_format($rope_chain->final_price,2):number_format($productDetails->final_price,2) }} </span>(<span id="discountpercentage">{{ $productDetails->is_variation == 1?$rope_chain->discount_percentage:$productDetails->discount_percentage }}</span>%)</p>
      </div>

      <div class = "product-detail">
        <h5>Describe: </h5>
        <p>{{ htmlspecialchars($productDetails->tittle) }}</p>
      </div>

      <div class = "product-detail">
        <input type="hidden" id="imag" value="{{ $productDetails->image}}" >
        <h5>Rope chain: <span id="chain">{{ $productDetails->is_variation == 1?$rope_chain->name:$productDetails->rope_chain}}</span> </h5>
        
      </div>

      <div class = "product-detail">
        
        <h5>Color: <span id="chain_color">{{ $productDetails->is_variation == 1?$rope_chain->gold_color:$productDetails->gold_color }}</span> </h5>
        
      </div>
      
      @if($productDetails->is_variation == 1)
          <div class="radio_container">
            @foreach($rope as $item)
            <input type="radio" name="rope" id="one{{ $item->id}}"  {{$rope_chain->id == $item->id?"checked":" "}}  onclick="getprice({{ $item->id }})">
            <label for="one{{ $item->id}}">{{$item->carat }}</label>
            @endforeach
            <input type="hidden" id="blog_id" value="{{ $productDetails->id }}">
            <input type="hidden" id="carat_q" value="{{ $productDetails->carat }}" >
            <input type="hidden" id="sku_code" value="{{ $productDetails->sku_code  }}" >
            <input type="hidden" id="final_p" value="{{ $productDetails->final_price  }}" >
            <input type="hidden" id="amount_p" value="{{ $productDetails->p_amt  }}" >
          </div>
      @endif

      <div class = "purchase-info">
        <div class="adetsay">
        <input type="button" value="-" id="minus_"  data-field="quantity" onclick="minus()">
        @if($productquantatity == 0)
          <input type="button" step="1" max="10" value="{{ 1}}" name="quantity" id="quantity" >
        @else
          <input type="text" step="1" max="10" value="{{ $newcartItem[0]['quantatity']}}" name="quantity" id="quantity" >
        @endif
          <input type="button" value="+" id="add_" class="barti" onclick="add()">
        </div>
        <a onclick="addtocartprodect()" class ="btn">
          Add to Cart <i class="bi bi-cart"></i>
        </a>
      </div>
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
  </div>
</div>
<div class="productFilter">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h4 class="fs-4">Related Product</h4>
      </div>
    </div>
    <div class="row mt-5">
      @foreach($similarproduct as $item)
      <div class="col-md-4">
       <a href="{{ url('product/'.$item -> slug_name) }}">
        <div class="product-card card">
            <div class="align-items-center d-flex justify-content-around p-5 product-header">
              <img class="product-picture" src="{{ asset($item->image) }}">
            </div>
            <div class="card-details">
              <h3 class="product-name">{{ $item -> tittle }}</h3>
              <div class="bottom-row">
                <p class="price">$475.60- $632.35</p>
                <button class="add-cart"><i class="bi bi-cart-fill"></i></button>
              </div>
            </div>
        </div>
       </a>
      </div>
      @endforeach
    </div>
  </div>
</div>



<x-footer-component/>



<script>


  function getprice(id){
    blog_id = $("#blog_id").val();
    //alert(blog_id);
			  $.ajax({
            type: "GET",
            url: "/product-details-price",
            data: {
                id : id,
				        blog_id :blog_id
            },
            success: function(response) {
				      // alert(response['amount']);
              $('#price').html(parseFloat(response['amount']).toFixed(2));
			        $('#finalPrice').html(parseFloat(response['final_price']).toFixed(2));
			        $('#discountamount').html(parseFloat(response['discount_amt']).toFixed(2));
			        $('#discountpercentage').html(parseFloat(response['discount_percentage']));
              $('#chain').html(response['name']);
              $('#chain_color').html(response['gold_color']);
              $('#carat_q').val(response['carat']);
              $('#final_p').val(response['final_price']);
              $('#amount_p').val(response['amount']);
              
			  
              // if(response.id == null){
              //   $('#addtocart').hide();
              //   $('#errmsg').html('This Product Not Available');
              // }else{
              // $('#addtocart').show();
              // $('#errmsg').html();
              // }
                
            }
        }); 
  }

  function addtocartprodect(){ 
    const shopping ={
      id : $('#blog_id').val(),
      title :$('#title_p').html(),
      quantatity :$('#quantity').val(),
      price :$('#finalPrice').html(),
      color :$('#chain_color').html(),
      size :$('#chain').html(),
      carat :$('#carat_q').val(),
      amount:$('#price').html(),
      img : $('#imag').val(), 
      sku_code : $('#sku_code').val(),
      // discountamount : $('#discountamount').html()
    };

    console.log(shopping);

    $.ajax({
              type: "get",
              url: "/add-cart",
              data: {
                  item : shopping
              },
              success: function(response) {
              alert(response);
          $("#add_success").html('Product added successfully.');
          $('#courtcount').html(response);			  
        }
          });
  }


  function add(){
    const id = "minus_"
    const qtid = "quantity"
    const latestQnt = parseInt($("#"+qtid).val())+1;
    $("#"+qtid).val(latestQnt);
    if(latestQnt == 1){
        $("#"+id).css("visibility", "hidden")
    }else{
        $("#"+id).css("visibility", "visible")
    }
  }

function minus(){
    const id = "minus_"
        const qtid = "quantity"
        const latestQnt = parseInt($("#"+qtid).val())-1;
        if(latestQnt >=1){
            $("#"+qtid).val(latestQnt);
        }
        if(latestQnt <= 1){
            $("#"+id).css("visibility", "hidden")
        }else{
            $("#"+id).css("visibility", "visible")
        }
}


</script>