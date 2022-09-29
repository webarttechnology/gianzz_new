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
                                <form    class="form-horizontal" onsubmit="return valid();" action="{{ url('/author/product/add') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Categary :<span style="color:red"> *</span></label>
                                        <select type="text" name="categary_id" id="categary_id" class="form-control" onchange="getSubCategary()" >
                                            <option value="">Select A Categary</option>
                                            @foreach($categary as $item)
                                               <option value="{{ $item ->id }}" {{ $item ->id == old('categary_id')?"Selected":''}} >{{ $item ->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('categary_id'))
                                                                <span class="text-danger">{{ $errors->first('categary_id') }}</span>
                                        @endif
                                    </div>
                                </div>

                              
                            </div>

                          

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
                            </div>

                            <!-- <div class="row">
                                <div class="col-md-6 col-xs-6">
                                            <div class="form-group">
                                            <input type="checkbox" id="is_variation" name="is_variation" value="0" onchange="varidationornot()">
                                            <label >Product Amount variation</label><br>
                                              
                                            </div>
                                        </div>
                            </div> -->

                         

                        
                            <div class="row ">
                                <div class="col-md-2 col-xs-12">
                                    <div class="form-group">
                                        <label>Variation</label>
                                        <input type="text" name="ropeChain[]" id="ropeChain" class="form-control" placeholder="0.68 Mm Thickness 18 Inch" value=""  />
                                       
                                       
                                    </div>
                                </div>
                                <div class="col-md-2 col-xs-12">
                                    <div class="form-group">
                                        <label>Size</label>
                                        <input type="text" name="carat[]" id="carat" class="form-control" placeholder="Ex 14k" value="{{ old('carat') }}"  />
                                       
                                       
                                    </div>
                                </div>
                                <div class="col-md-1 col-xs-12">
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="num" name="amount[]" id="amount1" class="form-control" placeholder="Amount" onkeyup="getdiscountprice(1)" value="{{ old('amount') }}"  />  
                                        @if ($errors->has('amount'))
                                                <span class="text-danger">{{ $errors->first('amount') }}</span>
                                        @endif     
                                    </div>
                                </div>

                                <div class="col-md-1 col-xs-12">
                                    <div class="form-group">
                                        <label>Color</label>
                                        <input type="text" name="gold_color[]" id="gold_color" class="form-control" placeholder="Color" value="{{ old('gold_color') }}"  /> 
                                        @if ($errors->has('gold_color'))
                                                                <span class="text-danger">{{ $errors->first('gold_color') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-1 col-xs-12">
                                    <div class="form-group">
                                        <label>Discount%</label>
                                        <input type="num" name="discount_percentage[]" id="discount_percentage1" class="form-control" placeholder="Discount Percentage" onkeyup="getdiscountprice(1)" value="{{ old('discount_percentage') }}"  /> 
                                        @if ($errors->has('discount_percentage'))
                                                                <span class="text-danger">{{ $errors->first('discount_percentage') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-1 col-xs-12">
                                    <div class="form-group">
                                        <label>Final Price</label>
                                        <input type="num" name="final_price[]" id="final_price1" class="form-control" placeholder="Final Price" value="{{ old('final_price') }}" /> 
                                        <input type="hidden" name="discount_amt[]" id="discount_amt1" class="form-control" placeholder="Final Price" value="{{ old('discount_amt') }}" /> 
                                        @if ($errors->has('final_price'))
                                        <span class="text-danger">{{ $errors->first('final_price') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-2 col-xs-12">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="otherimage[]" id="otherimage" class="form-control"/>                                       
                                    </div>
                                </div>

                                <div class="col-md-2 col-xs-12 rope-chan">
                                        <span class="btn btn-primary m-b-5 m-t-5" id="addrow" style="float: left;"><i class="fa fa-plus"
                                        aria-hidden="true"></i></span>
                                </div>
                                
                            </div>
                            <span id="multipleimage"></span>
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div class="form-group">
                                        <label>SKU Code :<span style="color:red"> *</span></label>
                                        <input type="text" name="sku_code" id="sku_code" class="form-control" placeholder="SKU Code" value="{{ old('sku_code') }}" />
                                        @if ($errors->has('sku_code'))
                                        <span class="text-danger">{{ $errors->first('sku_code') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        

                            <div class="row">
                                <div class="col-md-12 col-xs-6">
                                    <div class="form-group">
                                        <label>Description :<span style="color:red"> *</span></label>
                                        <textarea type="text" name="description" id="description" class="form-control"placeholder="categary Name" >{{ old('description') }}</textarea>
                                        @if ($errors->has('description'))
                                         <span class="text-danger">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-xs-6">
                                    <div class="form-group">
                                        <label>Image1 :<span style="color:red"> *</span></label>
                                        <input type="file" name="image" id="image" class="form-control" />
                                        @if ($errors->has('image'))
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        

                            <div class="row" >
                                <div class="col-md-12 col-xs-6">
                                    <div class="form-group">
                                        <label>Video :</label>
                                        <input type="file" name="image4" id="image4" class="form-control" />
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
CKEDITOR.replace( 'description' );

$(document).ready(function () {
                
                let lineNo = 2;
                $("#addrow").click(function () {                   
                    markup = '<div class="row"   id="deleterow'+ lineNo +'"><div class="col-md-2 col-xs-12" ><div class="form-group"><input type="text" class="d-inline-block form-control"  name="ropeChain[]" id="ropeChain'+ lineNo +'"  placeholder="0.68 Mm Thickness 18 Inch" style="width: 100%;"></div></div><div class="col-md-2 col-xs-12"><div class="form-group"><input type="text" name="carat[]" id="carat'+ lineNo +'" class="form-control" placeholder="Ex 14k"  /></div></div><div class="col-md-1 col-xs-12" ><div class="form-group"><input type="num" class="d-inline-block form-control"  name="amount[]" id="amount'+ lineNo +'"  placeholder="Amount" style="width: 100%;" onkeyup="getdiscountprice('+lineNo+')"></div></div><div class="col-md-1 col-xs-12" ><div class="form-group"><input type="text" class="d-inline-block form-control"  name="gold_color[]" id="gold_color'+ lineNo +'"  placeholder="Color" style="width: 100%;"></div></div> <div class="col-md-1 col-xs-12" ><div class="form-group"><input type="num" class="d-inline-block form-control"  name="discount_percentage[]" id="discount_percentage'+ lineNo +'"  placeholder="Discount Percentage" style="width: 100%;" onkeyup="getdiscountprice('+lineNo+')"></div></div><div class="col-md-1 col-xs-12" ><div class="form-group"><input type="num" class="d-inline-block form-control"  name="final_price[]" id="final_price'+ lineNo +'"  placeholder="Final Price" style="width: 100%;" ><input type="hidden" name="discount_amt[]" id="discount_amt'+lineNo+'" class="form-control"  /> </div></div><div class="col-md-2 col-xs-12"><div class="form-group"><input type="file" name="otherimage[]" id="otherimage" class="form-control"/></div></div><div class="fv-plugins-message-container d-inline-block"> <button class="btn btn-danger m-b-5 ml-2 py-2"  onclick="deleteRow('+ lineNo +')"><i class="fa fa-trash-o" aria-hidden="true"></i></button></div></div>' ;
                    tableBody = $("#multipleimage");
                    tableBody.append(markup);
                    lineNo++;
                });

              
            }); 
     


     function deleteRow(lineno){
         
        $("#deleterow"+lineno).click(function () {
                   
            $('#deleterow'+lineno).remove();
        });
     }


    






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
                $("#categary_id").focus();
                return false;
            }else if ($("#name").val() == '') {
                $("#errmsg").html("Please Enter A Name!!");
                $("#name").focus();
                return false;
            } else if ($("#tittle").val() == '') {
                $("#errmsg").html("Please Enter A Tittle!!");
                $("#tittle").focus();
                return false;
            }
            // else if ( $("#is_variation").val() == 0 && $("#p_amt").val() == '') {
            //     alert($("#p_amt").val());
            //     $("#errmsg").html("Please Enter Product amount !!");
            //     $("#p_amt").focus();
            //     return false;
            // }
            if ( $("#amount1").val() == '') {
                $("#errmsg").html("Please Enter Amount!!");
                $("#amount1").focus();
                return false;
            }else if ($("#gold_color").val() == '') {
                $("#errmsg").html("Please Enter Gold Color!!");
                $("#gold_color").focus();
                return false;
            }else if ($("#discount_percentage1").val() == '') {
                $("#errmsg").html("Please Enter Gold Color!!");
                $("#discount_percentage1").focus();
                return false;
            }else if ($("#final_price1").val() == '') {
                $("#errmsg").html("Please Enter Gold Color!!");
                $("#final_price1").focus();
                return false;
            }else if ($("#sku_code").val() == '') {
                $("#errmsg").html("Please Enter SKU Code!!");
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




    // function varidationornot(){
    //     if($("#is_variation").is(":checked") == true){
    //         $(".rope-chan").show();
    //         $(".amt").hide();
    //         $("#is_variation").val(1);
    //     }else{
    //         $(".rope-chan").hide();
    //         $(".amt").show();
    //         $("#is_variation").val(0);
    //     }

    // }


   

    
</script>

<x-adminfooter />

