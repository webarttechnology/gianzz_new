<x-adminheader />
<x-adminnav />
<div class="wave -three"></div>
<div class="app-content">
				<section class="section">


                        <!--page-header open-->
						<div class="page-header">
							<h4 class="page-title">ADD {{$title}} :</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#" class="text-light-color">Add</a></li>
								<li class="breadcrumb-item active" aria-current="page">ADD {{ $title }}</li>
							</ol>
						</div>
						<!--page-header closed-->

                        <!--row open-->
						
						<!--row closed-->

                        <!--row open-->
				    <div class="row justify-content-center " >
						
					    <div class="col-12">
						    <div class="card" style="style">
									<div class="card-header">
										<h4>ADD {{$title}} Details :</h4>
                                        <div style="color:green; padding-left:5px " id="successmsg">{{ Session::get('successmsg') }}</div>
                                        <div style="color:red; padding-left:5px " id="errmsg">{{ Session::get('errmsg') }}</div>
									</div>
								<div class="card-body">
                                <form    class="form-horizontal" onsubmit="return valid();" action="{{ url('/author/csv/product/add') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Categary :<span style="color:red"> *</span></label>
                                        <select type="text" name="categary_id" id="categary_id" class="form-control" onchange="getSubCategary()" >
                                            <option value=" ">Select A Categary</option>
                                            @foreach($categary as $item)
                                               <option value="{{ $item ->id }}" {{ $item ->id == old('categary_id')?"Selected":''}} >{{ $item ->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('categary_id'))
                                                                <span class="text-danger">{{ $errors->first('categary_id') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6 col-xs-12" >
                                    <div class="form-group">
                                        <label>Sub Categary :</label>
                                        <select type="text" name="subcategary_id" id="subcategary_id" class="form-control"  >
                                            <option value=" ">Sub Categary</option>
                                        </select>
                                    </div>
                                </div>

                              
                            </div>

                          
<!-- 
                            <div class="row">
                                <div class="col-md-6 col-xs-6">
                                    <div class="form-group">
                                        <label>Name :<span style="color:red"> *</span></label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="name"  value="{{ old('name') }}" />
                                        @if ($errors->has('name'))
                                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6 col-xs-6">
                                    <div class="form-group">
                                        <label>Tittle :<span style="color:red"> *</span></label>
                                        <input type="text" name="tittle" id="tittle" class="form-control" placeholder="Title" value="{{ old('tittle') }}" >
                                        @if ($errors->has('tittle'))
                                                                <span class="text-danger">{{ $errors->first('tittle') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div> -->


                            <div class="row" >
                                <div class="col-md-12 col-xs-6">
                                    <div class="form-group">
                                        <label>CSV file :</label>
                                        <input type="file" name="csvfile" id="csvfile" class="form-control" />
                                        @if ($errors->has('csvfile'))
                                                                <span class="text-danger">{{ $errors->first('csvfile') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-xs-6">
                                    <div class="form-group">
                                        <input type="Submit" class="btn btn-primary" 
                                            value="Save" />
                                    </div>
                                </div>
                            </div>

                        </form>
								</div>
							</div>
						</div>
					</div>
					
				</section>
			</div>



<script>

     
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


    function getdiscountprice(id){
        var price =$('#amount'+id).val();
        var disprice = $('#discount_percentage'+id).val();
        //alert(disprice);
        var finalamount = price - (price * disprice / 100);
        var discountAmt = (price * disprice / 100);
        $('#final_price'+id).val(finalamount);
        $('#discount_amt'+id).val(discountAmt);
    }
    
    




    function valid() {
            if ($("#categary_id").val() == '') {
                $("#errmsg").html("Please Enter A Categary!!");
                //$("#email").css("border-color", "red");
                return false;
            }else if ($("#name").val() == '') {
                $("#errmsg").html("Please Enter A Name!!");
                //$("#email").css("border-color", "red");
                return false;
            } else if ($("#tittle").val() == '') {
                $("#errmsg").html("Please Enter A Tittle!!");
                //$("#email").css("border-color", "red");
                return false;
            }else if ($("#ropeChain").val() == '') {
                $("#errmsg").html("Please Enter Rope Chain Option !!");
                //$("#email").css("border-color", "red");
                return false;
            }else if ($("#amount1").val() == '') {
                $("#errmsg").html("Please Enter Amount!!");
                //$("#email").css("border-color", "red");
                return false;
            }else if ($("#gold_color").val() == '') {
                $("#errmsg").html("Please Enter Gold Color!!");
                //$("#email").css("border-color", "red");
                return false;
            }else if ($("#discount_percentage1").val() == '') {
                $("#errmsg").html("Please Enter Gold Color!!");
                //$("#email").css("border-color", "red");
                return false;
            }else if ($("#final_price1").val() == '') {
                $("#errmsg").html("Please Enter Gold Color!!");
                //$("#email").css("border-color", "red");
                return false;
            }else if ($("#sku_code").val() == '') {
                $("#errmsg").html("Please Enter SKU Code!!");
                //$("#email").css("border-color", "red");
                return false;
            } else if ($("#description").val() == '') {
                $("#errmsg").html("Please Enter A Descriptuon!!");
                //$("#email").css("border-color", "red");
                return false;
            } 
            else if ($("#image").val() == '') {
                $("#errmsg").html("Please Upload a Picture!!");
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
           // alert($("#image1").val());
            $('#mulimage2').show();
            return false;
        } 
    }


    function multipleimage3(){
        if($("#image2").val() != ''){
           // alert($("#image1").val());
            $('#mulimage3').show();
            return false;
        } 
    }


   

    
</script>

<x-adminfooter />

