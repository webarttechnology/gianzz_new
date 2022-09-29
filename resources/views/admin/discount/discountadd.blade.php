<x-adminheader />
<x-adminnav />
<div class="wave -three"></div>
<div class="app-content">
					<section class="section">


                        <!--page-header open-->
						<div class="page-header">
							<h4 class="page-title">Add {{ $title}} Details</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#" class="text-light-color">Add</a></li>
								<li class="breadcrumb-item active" aria-current="page">Add {{ $title}}</li>
							</ol>
						</div>
						<!--page-header closed-->

                        <!--row open-->
						
						<!--row closed-->

                        <!--row open-->
						<div class="row justify-content-center" >
						
							<div class="col-12">
								<div class="card" style="style">
									<div class="card-header">
										<h4>Add {{$title}} Details</h4>
										<span id="errmsg" style="color:red">{{ Session::get('errmsg') }}</span>
									</div>
									<div class="card-body">
										<form class="form-horizontal"  action="{{ url('/author/product-discount/add') }}" method='POST' onsubmit=" return valid(); " >
                                        @csrf
                                        <div class="row">
                                <div class="col-md-12 col-xs-6">
                                    <div class="form-group">
                                        <label>Discount Category<span style="color:red"> *</span></label>
                                        <select name="name" id="name" class="form-control"  >
                                            <option value=" ">Select A Categary</option>
                                               <option value="Valentine's Day" {{ old('name') == "Valentine's"?"selected":'' }}>Valentine's Day Offer %</option>
                                               <option value="Mother's Day" {{ old('name') == "Mother's"?"selected":'' }} >Mother's Day Offer %</option>
                                               <option value="Christmas Day" {{ old('name') == "Christmas"?"selected":'' }} >Christmas Offer %</option>
                                               <option value="GemStone" {{ old('name') == "GemStone"?"selected":'' }} >Sunshine GemStone Offer %</option>
                                               <option value="Login" {{ old('name') == "Login"?"selected":'' }} >1st Login Offer %</option>
                                        </select>
                                        @if ($errors->has('name'))
                                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            		@endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-xs-6">
                                    <div class="form-group">
                                        <label>Amount<span style="color:red"> *</span></label>
                                        <input type="number" name="amount" id="amount" class="form-control" placeholder="Discount Amount" value="{{ old('amount') }}" />
                                        @if ($errors->has('amount'))
                                            <span class="text-danger">{{ $errors->first('amount') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Start Date<span style="color:red"> *</span></label>
                                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}" />
                                        @if ($errors->has('start_date'))
                                            <span class="text-danger">{{ $errors->first('start_date') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label>End Date<span style="color:red"> *</span></label>
                                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}" />
                                        @if ($errors->has('end_date'))
                                            <span class="text-danger">{{ $errors->first('end_date') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-xs-6">
                                    <div class="form-group">
                                        <label>Status<span style="color:red"> *</span></label>
                                        <select type="text" name="is_active" id="is_active" class="form-control"
                                            placeholder="categary Name" >
                                        <option value=1 Selected >Active</option>
                                        <option value=0 >Inactive</option>
                                        </select>
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
						<!--row closed-->

                       
						
					

					</section>
				</div>

 <x-adminfooter />

<script>
 function valid() {
            if ($("#categary_id").val() == '') {
                $("#errmsg").html("Please Enter A Categary");
                //$("#email").css("border-color", "red");
                return false;
            }else if ($("#name").val() == '') {
                $("#errmsg").html("Please Enter A Sub Categary Name");
                //$("#email").css("border-color", "red");
                return false;
            } else if ($("#is_active").val() == '') {
                $("#errmsg").html("Please Select a Status");
                //$("#email").css("border-color", "red");
                return false;
            } 
        }

</script>