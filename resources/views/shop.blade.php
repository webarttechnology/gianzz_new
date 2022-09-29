<x-header-component/>


<div class="innerBanner">
	<div class="container">
	    <div class="row">
	      <div class="col-md-12 text-center">
	        <h3>Shop</h3>
	        <nav aria-label="breadcrumb">
	          <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
	            <li class="breadcrumb-item active" aria-current="page">Shop</li>
	          </ol>
	        </nav>
	      </div>
	    </div>
	  </div>
</div>

<div class="productFilter">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="productCatagori">
					<ul class="ps-0 mb-0 text-center">
                        @foreach($categories as $val)
						<li><a href="{{ url('shop?cat='. $val -> slug_categary )}}" class="{{ $activeCategory == $val -> id?'activeCat':''}}">{{ $val -> name }}</a></li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
		<div class="row mt-5">
            @foreach($products as $val)
			<div class="col-md-4">
				<a href="{{ url('product/'.$val['product']->slug_name) }}">
					<div class="product-card card">
					    <div class="align-items-center d-flex justify-content-around p-5 product-header">
					      <img class='product-picture' src="{{ $val['product']-> image }}" />
					    </div>
					    <div class="card-details">
					      <h3 class="product-name">{{ $val['product']-> tittle }}</h3>
					      <div class="bottom-row">
					        <p class="price"> ${{$val['product']-> is_variation == 0?number_format($val['product']-> p_amt,2):number_format($val['maxprice'],2) ."-".number_format($val['minprice'],2)  }}</p>
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