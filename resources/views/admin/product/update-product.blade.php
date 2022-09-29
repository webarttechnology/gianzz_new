<x-adminheader />
<x-adminnav />
<div class="wave -three"></div>
<div class="app-content">
				<section class="section">


                        <!--page-header open-->
						<div class="page-header">
							<h4 class="page-title">Edit {{ $title }}</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#" class="text-light-color">Edit</a></li>
								<li class="breadcrumb-item active" aria-current="page">Edit {{ $title }}</li>
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
										<h4>Edit {{ $title}} Details</h4>
										<span id="errmsg" style="color:red">{{ Session::get('errmsg') }}</span>
									</div>
								<div class="card-body">
									<form class="form-horizontal"  action="{{ url('/author/product/update') }}" method='POST' onsubmit=" return valid(); " enctype="multipart/form-data" >
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>Categary<span style="color:red"> *</span></label>
                                                    <select type="text" name="categary_id" id="categary_id" class="form-control" onchange="getSubCategary()" >
                                                        <option value=" ">Select A Categary</option>
                                                        @foreach($categary as $item)
                                                        <option value="{{ $item ->id }}"{{ $item ->id == $blog->categary_id?"selected":"" }} >{{ $item ->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                           
                                        </div>

                                        

                                        <div class="row">
                                            <div class="col-md-6 col-xs-6">
                                                <div class="form-group">
                                                    <label>Name<span style="color:red"> *</span></label>
                                                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ $blog->name }}"  />
                                                    @if ($errors->has('name'))
                                                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xs-6">
                                                <div class="form-group">
                                                    <label>Tittle<span style="color:red"> *</span></label>
                                                    <input type="text" name="tittle" id="tittle" class="form-control" placeholder="Product Title" value="{{ $blog->tittle }}">
                                                    <input type="hidden" name="id" id="id" class="form-control" placeholder="categary Name" value="{{ $blog->id }}" />
                                                    @if ($errors->has('tittle'))
                                                                            <span class="text-danger">{{ $errors->first('tittle') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6 col-xs-6">
                                                        <div class="form-group">
                                                        <input type="checkbox"  {{ $blog->is_variation == 1?"checked":" "}} id="is_variation" name="is_variation" value="0" onchange="varidationornot()">
                                                        <label for="is_variation">Product Amount variation</label><br>
                                                        
                                                        </div>
                                                    </div>
                                        </div>

                                   
                                    
                                    

                                        <div class="row rope-chan">
                                            <div class="col-md-4 col-xs-12">
                                                    <div class="form-group">
                                                    <h2>Rope Chain Option Add</h2>
                                                    </div> 
                                            </div>
                                        </div>
                        
                                        @foreach($rope as $item)
                                        
                                        @if($item->id == $lastrope_id)
                                            <div class="row rope-chan" id="deleterope{{$item->id}}">
                                                <div class="col-md-2 col-xs-12">
                                                    <div class="form-group">
                                                        <input type="hidden" name="rope_id[]" id="rope_id" value="{{ $item->id }}" >
                                                        <input type="text" name="ropeChain[]" id="ropeChain1" class="form-control" placeholder="0.68 Mm Thickness 18 Inch" value="{{ $item->name }}" />
                                                        @if ($errors->has('ropeChain'))
                                                                            <span class="text-danger">{{ $errors->first('ropeChain') }}</span>
                                                        @endif
                                                    
                                                    </div>
                                                </div>

                                                <div class="col-md-2 col-xs-12">
                                                 <div class="form-group">
                                                  <input type="text" name="carat[]" id="carat" class="form-control" placeholder="Ex 14k" value="{{ $item -> carat != 'N/A'?$item -> carat:'' }}"  />                                     
                                                </div>
                                                </div>
                                                <div class="col-md-1 col-xs-12">
                                                    <div class="form-group">
                                                        <input type="text" name="amount[]" id="amount1" class="form-control" placeholder="Amount" value="{{ $item->amount }}" onkeyup="getdiscountprice(1)" />
                                                        @if ($errors->has('amount'))
                                                        <span class="text-danger">{{ $errors->first('amount') }}</span>
                                                        @endif                                                  
                                                    </div>
                                                </div>

                                                <div class="col-md-1 col-xs-12">
                                                    <div class="form-group">
                                                        <input type="text" name="gold_color[]" id="gold_color1" class="form-control" placeholder="Color" value="{{ $item->gold_color }}" />   
                                                        @if ($errors->has('gold_color'))
                                                        <span class="text-danger">{{ $errors->first('gold_color') }}</span>
                                                    @endif    
                                                    </div>
                                                </div>

                                                <div class="col-md-1 col-xs-12">
                                                    <div class="form-group">
                                                        <input type="num" name="discount_percentage[]" id="discount_percentage1" class="form-control" placeholder="Discount Percentage" value="{{ $item->discount_percentage}}" onkeyup="getdiscountprice(1)" /> 
                                                        @if ($errors->has('discount_percentage'))
                                                        <span class="text-danger">{{ $errors->first('discount_percentage') }}</span>
                                                    @endif
                                                        
                                                    </div>
                                                </div>

                                                <div class="col-md-1 col-xs-12">
                                                    <div class="form-group">
                                                        <input type="num" name="final_price[]" id="final_price1" class="form-control" placeholder="Final Price" value="{{ $item->final_price }}" /> 
                                                        <input type="hidden" name="discount_amt[]" id="discount_amt1" class="form-control" placeholder="Final Price" value="{{ $item->discount_amt }}" /> 
                                                        @if ($errors->has('final_price'))
                                                        <span class="text-danger">{{ $errors->first('final_price') }}</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-md-2 col-xs-12">
                                                        <div class="form-group">
                                                            <input type="file" name="otherimage[]" id="otherimage" class="form-control"/>                                       
                                                        </div>
                                                </div>
                                              

                                                <div class="col-md-2 col-xs-12">
                                                        <div class="fv-plugins-message-container d-inline-block">
                                                                <a class="btn btn-danger m-b-5 ml-2 py-2"  onclick="deleterope({{$item->id}})"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                            </div>
                                                </div> 

                                            </div>
                                        
                                                                            
                                            </div> 
                                            @else

                                            <div class="row rope-chan amt" id="deleterope{{$item->id}}">
                                                    <div class="col-md-2 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Variation :<span style="color:red"> *</span></label>
                                                            <input type="hidden" name="rope_id[]" id="rope_id" value="{{ $item->id }}" >
                                                            <input type="text" name="ropeChain[]" id="ropeChain{{$item->id}}" class="form-control" placeholder="0.68 Mm Thickness 18 Inch" value="{{ $item->name }}" />
                                                            @if ($errors->has('ropeChain'))
                                                                                <span class="text-danger">{{ $errors->first('ropeChain') }}</span>
                                                            @endif
                                                        
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-xs-12">
                                                 <div class="form-group">
                                                  <label>Size</label>
                                                  <input type="text" name="carat[]" id="carat" class="form-control" placeholder="Ex 14k" value="{{ $item -> carat != 'N/A'?$item -> carat:'' }}"  />                                     
                                                </div>
                                                </div>
                                                    <div class="col-md-1 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Amount :<span style="color:red"> *</span></label>
                                                            <input type="text" name="amount[]" id="amount{{$item->id}}" class="form-control" placeholder="Amount" value="{{ $item->amount }}" onkeyup="getdiscountprice({{$item->id}})" />
                                                            @if ($errors->has('amount'))
                                                            <span class="text-danger">{{ $errors->first('amount') }}</span>
                                                            @endif                                                     
                                                        </div>
                                                    </div>

                                                    <div class="col-md-1 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Color :<span style="color:red"> *</span></label>
                                                            <input type="text" name="gold_color[]" id="gold_color{{$item->id}}" class="form-control" placeholder="Color" value="{{ $item->gold_color }}" />   
                                                            @if ($errors->has('gold_color'))
                                                                                <span class="text-danger">{{ $errors->first('gold_color') }}</span>
                                                        @endif    
                                                        </div>
                                                    </div>

                                                    <div class="col-md-1 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Discount% :<span style="color:red"> *</span></label>
                                                            <input type="num" name="discount_percentage[]" id="discount_percentage{{$item->id}}" class="form-control" placeholder="Final Price" value="{{ $item->discount_percentage}}" onkeyup="getdiscountprice({{$item->id}})" /> 
                                                            @if ($errors->has('discount_percentage'))
                                                                                <span class="text-danger">{{ $errors->first('discount_percentage') }}</span>
                                                        @endif
                                                            
                                                        </div>
                                                    </div>

                                                    <div class="col-md-1 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Final Price :<span style="color:red"> *</span></label>
                                                            <input type="num" name="final_price[]" id="final_price{{$item->id}}" class="form-control" placeholder="Final Price" value="{{ $item->final_price }}" /> 
                                                            <input type="hidden" name="discount_amt[]" id="discount_amt{{$item->id}}" class="form-control" placeholder="Final Price" value="{{ $item->discount_amt }}" /> 
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
                                            
                                                    <div class="col-md-2 col-xs-12">
                                                <div class="form-group">
                                                
                                                <span class="btn btn-primary m-b-5 ml-2 py-2 amt" id="addrow"  style="float: left;"><i class="fa fa-plus"
                                                        aria-hidden="true"></i></span>
                                                </div> 
                                                                                  
                                                </div> 
                                            @endif    
                                        
                                    @endforeach
                               
                           
                              
                          
                            <span id="multipleimage"></span>                           
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div class="form-group">
                                        <label>SKU Code :<span style="color:red"> *</span></label>
                                        <input type="text" name="sku_code" id="sku_code" class="form-control" placeholder="SKU Code" value="{{ $blog-> sku_code}}" />
                                        @if ($errors->has('sku_code'))
                                                                <span class="text-danger">{{ $errors->first('sku_code') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                         


                            <div class="row">
                                <div class="col-md-12 col-xs-6">
                                    <div class="form-group">
                                        <label>Description<span style="color:red"> *</span></label>
                                        <textarea type="text" name="description" id="description" class="form-control"><?php echo htmlspecialchars_decode($blog->description)?></textarea>
                                        @if ($errors->has('description'))
                                                <span class="text-danger">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-xs-6">
                                    <div class="form-group">
                                        <label>Image1 :<span style="color:red"> *</span></label>
                                        <input type="file" name="image" id="image" class="form-control"  />
                                        @if ($errors->has('image'))
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                        @endif
                                    </div>
                                </div>

                            </div>                                               

                            <div class="row" >
                                <div class="col-md-6 col-xs-6">
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
    if($("#is_variation").is(":checked") == true){
            $(".rope-chan").show();
            $(".amt").show();
            $("#is_variation").val(1);
        }else{
            $(".rope-chan").hide();
            $(".amt").hide();
            $("#is_variation").val(0);
        }


                let lineNo = 2;
                $("#addrow").click(function () {
                    markup = '<div class="row"   id="deleterow'+ lineNo +'"><div class="col-md-2 col-xs-12" ><div class="form-group"><input type="text" class="d-inline-block form-control"  name="ropeChain[]" id="ropeChain'+ lineNo +'"  placeholder="0.68 Mm Thickness 18 Inch" style="width: 100%;"></div></div><div class="col-md-2 col-xs-12"><div class="form-group"><input type="text" name="carat[]" id="carat'+ lineNo +'" class="form-control" placeholder="Ex 14k"  /></div></div><div class="col-md-1 col-xs-12" ><div class="form-group"><input type="num" class="d-inline-block form-control"  name="amount[]" id="amount'+ lineNo +'"  placeholder="Amount" style="width: 100%;" onkeyup="getdiscountprice('+lineNo+')"></div></div><div class="col-md-1 col-xs-12" ><div class="form-group"><input type="text" class="d-inline-block form-control"  name="gold_color[]" id="gold_color'+ lineNo +'"  placeholder="Color" style="width: 100%;"></div></div> <div class="col-md-1 col-xs-12" ><div class="form-group"><input type="num" class="d-inline-block form-control"  name="discount_percentage[]" id="discount_percentage'+ lineNo +'"  placeholder="Discount Percentage" style="width: 100%;" onkeyup="getdiscountprice('+lineNo+')"></div></div><div class="col-md-1 col-xs-12" ><div class="form-group"><input type="num" class="d-inline-block form-control"  name="final_price[]" id="final_price'+ lineNo +'"  placeholder="Final Price" style="width: 100%;" ><input type="hidden" name="discount_amt[]" id="discount_amt'+lineNo+'" class="form-control"  /> </div></div><div class="col-md-2 col-xs-12"><div class="form-group"><input type="file" name="otherimage[]" id="otherimage" class="form-control"/></div></div><div class="fv-plugins-message-container d-inline-block"> <button class="btn btn-danger m-b-5 ml-2 py-2"  onclick="deleteRow('+ lineNo +')"><i class="fa fa-trash-o" aria-hidden="true"></i></button></div></div>' ;
                    tableBody = $("#multipleimage");
                   // alert(tableBody);
                    tableBody.append(markup);
                    lineNo++;
                });
              
            }); 
     
    function deleteRow(lineno){
         
        $("#deleterow"+lineno).click(function () {
                   
            $('#deleterow'+lineno).remove();
        });
    }
    function deleterope(id){
        $("#deleterope"+id).click(function (){
                var url = "<?php echo  URL::to('author/product/chain-rope/delete') ?>";
                console.log(url);
                $.ajax({
                type:"GET",
                url: url+'/'+id,
                success: function(response){
                    $('#deleterope'+id).remove();
                }
            });
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
            }else if ( $("#is_variation").val() == 0 && $("#p_amt").val() == '') {
                alert($("#p_amt").val());
                $("#errmsg").html("Please Enter Product amount !!");
                $("#p_amt").focus();
                return false;
            }else if ( $("#is_variation").val() == 1 && $("#ropeChain").val() == '') {
                $("#errmsg").html("Please Enter Rope Chain Option !!");
                $("#ropeChain").focus();
                return false;
            }else if ($("#is_variation").val() == 1 && $("#amount1").val() == '') {
                $("#errmsg").html("Please Enter Amount!!");
                $("#amount1").focus();
                return false;
            }else if ($("#is_variation").val() == 1 && $("#gold_color1").val() == '') {
                $("#errmsg").html("Please Enter Gold Color!!");
                $("#gold_color").focus();
                return false;
            }else if ($("#is_variation").val() == 1 && $("#discount_percentage1").val() == '') {
                $("#errmsg").html("Please Enter Gold Color!!");
                $("#discount_percentage1").focus();
                return false;
            }else if ($("#is_variation").val() == 1 && $("#final_price1").val() == '') {
                $("#errmsg").html("Please Enter Gold Color!!");
                $("#final_price1").focus();
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
        }

        function varidationornot(){
            if($("#is_variation").is(":checked") == true){
                $(".rope-chan").show();
                $(".amt").hide();
                $("#is_variation").val(1);
            }else{
                $(".rope-chan").hide();
                $(".amt").show();
                $("#is_variation").val(0);
            }

    }
      
</script>

<x-adminfooter />