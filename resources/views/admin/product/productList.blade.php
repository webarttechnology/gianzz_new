<x-adminheader />
<x-adminnav />

<div class="app-content">
    <div class="section">
        <!--page-header open-->
        <div class="page-header">
            <h4 class="page-title">{{$title}} List</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="text-light-color">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$title}} List</li>
            </ol>
        </div>
        <!--page-header closed-->
        <!--row open-->
        <div class="row">
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{$title}} List
                            <a href="{{ url('author/product/add') }}" 
                                class="btn btn-primary m-b-5 m-t-5 pull-right"><i class="fa fa-plus"
                                    aria-hidden="true"></i></a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <!-- @foreach($errors -> all() as $errvalue)
                        <span style="color:red">{{ $errvalue }}</span>
                        @endforeach -->

                        <div style="color:green; padding-left:50px ">{{ Session::get('successmsg') }}</div>
                        <div style="color:red; padding-left:50px ">{{ Session::get('errmsg') }}</div>
                        <table id="customers2" class="table datatable">
                            <thead>
                                <tr>
                                    <th width="5%">ID</th>
                                    <th width="15%">Name</th> 
                                    <th width="15%">Categary</th>   
                                    <th width="15%">Final Price</th>
                                    <th width="15%">Discount Amount</th>    
                                    <th width="15%">Image</th>  
                                    <th width="15%">Video</th>                           
                                    <th width="15%">Status</th>
                                    <th width="5%">Action</th>
                                </tr>
                                <tbody>
                                @foreach($blog as $item)
                                <tr>
                                    <td style="color: black;">{{ $loop -> index + 1 }}</td>
                                    <td style="color: black;">{{ $item['product']-> name }}</span></td>
                                    <td style="color: black;">{{ $item['product'] -> categary == ''?'':$item['product']-> categary ->name }}</span></td>
                                    <td style="color: black;">{{ $item['maxprice'] == ''?'':$item['maxprice'] }}</span></td>
                                    <td style="color: black;"></span></td>
                                    <td style="color: black;"><div class="img">
                                        <img src="{{ asset($item['product'] -> image) }}" alt="" height="60px" weidth="40px">
                                    </div></span></td>
                                    <td style="color: black;"><div class="img">
                                    @if($item['product'] ->image4 == '')
																	    {{ "-" }}
																    @else
                                                                        <video autoplay="" loop="true" controlslist="nodownload" muted="muted" disableremoteplayback="" playsinline="" poster="{{ asset($item['product'] -> image4) }}">
                                                                            <source data-src="{{ asset($item['product'] -> image4) }}" type="video/mp4" src="{{ asset($item['product'] -> image4) }}">
                                                                        </video>
																	@endif
                                    
                                    </div></span></td>
                                    <td> <span
                                            class="badge {{ $item['product'] -> is_active?'badge-success':'badge-danger' }} m-b-5">{{ $item['product'] -> is_active?'Active':'Inactive' }}</span>
                                    </td>

                                    <td style="color: black;"><a
                                            href="{{ URL('/author/product/upate/'.$item['product'] -> id) }}"><i
                                                class="fa fa-pencil-square" aria-hidden="true"></i></a> | <a
                                            href="{{ URL('/author/product/delete/'.$item['product'] -> id) }}"
                                            onclick="return confirm('Do you really want to delete this data?')"><i
                                                class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>

                        <div class="text-center py-4">
				<nav aria-label="Page navigation example" class="d-inline-block">
					<ul class="pagination">
						<li class="page-item">
						@if($errorNo > 1)	
						@php 
							$endlimit = $errorNo - 1;
						@endphp
						<a class="page-link text-theme-red" href="{{ url($fullurl.'?page='.$endlimit) }}" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
						</a>
						@endif
						</li>

						@for($i = $starting; $i <= $ending; $i++)
						<li class="page-item"><a class="{{ $selectedPage == $i?'page-link bg-theme-red text-white':'page-link text-theme-red'}}" href="{{ url($fullurl.'?page='.$i) }}">{{ $i }}</a></li>
						@endfor					

											
						<li class="page-item">
						@if(round($maxCount) > $errorNo)	
						<a class="page-link text-theme-red" href="{{ url($fullurl.'?page='.++$errorNo) }}" aria-label="Next">
							<span aria-hidden="true">&raquo;</span>
						</a>
						@endif
						</li>
					</ul>
				</nav>
			</div>
                    </div>
                </div>
            </div>
        </div>
        <!--row closed-->
    </div>
</div>

<script>

CKEDITOR.replace( 'description' );

    function getSubCategary(){
            var data =$('#categary_id').val();
            $.ajax({
            type: "GET",
            url: "/author/product/getSubCategary",
            data: {
                categary_id: data
            },
            success: function(response) {
               $("#subcategary_id").html(response);
                
            }
        });
    }


    function getdiscountprice(){
        var price =$('#price').val();
        var disprice = $('#discount_percentage').val();
        var finalamount = price - (price * disprice / 100);
        var discountAmt = (price * disprice / 100);
        $('#final_price').val(finalamount);
        $('#discount_amt').val(discountAmt);

    }



   function valid() {
            if ($("#categary_id").val() == '') {
                $("#errmsg").html("Please Enter A Categary");
                //$("#email").css("border-color", "red");
                return false;
            }else if ($("#subcategary_id").val() == '') {
                $("#errmsg").html("Please Enter A Sub Categary Name");
                //$("#email").css("border-color", "red");
                return false;
            } else if ($("#tittle").val() == '') {
                $("#errmsg").html("Please Enter A Tittle");
                //$("#email").css("border-color", "red");
                return false;
            }else if ($("#price").val() == '') {
                $("#errmsg").html("Please Enter Product Price");
                //$("#email").css("border-color", "red");
                return false;
            }else if ($("#discount_percentage").val() == '') {
                $("#errmsg").html("Please Enter Discount Percentage");
                //$("#email").css("border-color", "red");
                return false;
            }else if ($("#final_price").val() == '') {
                $("#errmsg").html("Please Enter Final Price");
                //$("#email").css("border-color", "red");
                return false;
            }else if ($("#discount_amt").val() == '') {
                $("#errmsg").html("Please Enter Discount Amount");
                //$("#email").css("border-color", "red");
                return false;
            } else if ($("#description").val() == '') {
                $("#errmsg").html("Please Enter A Descriptuon");
                //$("#email").css("border-color", "red");
                return false;
            } 
            else if ($("#image").val() == '') {
                $("#errmsg").html("Please Upload a Picture");
                //$("#email").css("border-color", "red");
                return false;
            }
            //else{
            //     var form = $('#form')[0];
            //     console.log(form)
            //     var data = new FormData(form);
            //     console.log(data);
            //     $.ajax({
            //         url: "/author/product/add",
            //         enctype: 'multipart/form-data',
            //         type: "POST",
            //         data:data,
            //         processData: false, // Importent
            //         contentType: false, // Importent
            //         cache: false,
            //         timeout: 600000,
            //         success: function(response){
            //             if(response == 1){
            //                 console.log(response);
            //             }
            //         }

            //     });
            // }
        }

    function multipleimage1(){
        if($("#image").val() != ''){
         //   alert($("#image").val());
            $('#mulimage1').show();
            return false;
        }if($("#image1").val() != ''){
            alert($("#image1").val());
            $('#mulimage2').show();
            return false;
        }
    }

    function multipleimage2(){
        if($("#image1").val() != ''){
            $('#mulimage2').show();
            return false;
        } 
    }
</script>
<x-adminfooter />