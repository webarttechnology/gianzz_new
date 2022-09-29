<x-adminheader />
<x-adminnav />
<div class="wave -three"></div>
<div class="app-content">
					<section class="section">


                        <!--page-header open-->
						<div class="page-header">
							<h4 class="page-title">Edit {{ $title}}</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#" class="text-light-color">Edit</a></li>
								<li class="breadcrumb-item active" aria-current="page">Edit {{ $title}}</li>
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
										<h4>Edit {{$title}} Details</h4>
										<span id="errmsg" style="color:red"></span>
									</div>
									<div class="card-body">
										<form class="form-horizontal"  action="{{ url('/author/subcategory/update') }}" method='POST' onsubmit=" return valid(); " >
                                        @csrf
                                        <div class="row">
                                <div class="col-md-12 col-xs-6">
                                    <div class="form-group">
                                        <label>Categary<span style="color:red"> *</span></label>
                                        <select name="categary_id" id="categary_id" class="form-control"  >
                                            <option value=" ">Select A Categary</option>
                                            @foreach($categary as $cat)
                                               <option value="{{ $cat ->id }}" {{ $cat ->id == $subcategary->categary_id?"selected":"" }}>{{ $cat ->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-xs-6">
                                    <div class="form-group">
                                        <label>Sub-Categary Name<span style="color:red"> *</span></label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ $subcategary->name }}" />
                                        <input type="hidden" name="id" id="id" class="form-control" value="{{ $subcategary->id }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-xs-6">
                                    <div class="form-group">
                                        <label>Status<span style="color:red"> *</span></label>
                                        <select type="text" name="is_active" id="is_active" class="form-control"
                                            placeholder="categary Name" >
                                        <option value=1 {{ $subcategary->is_active == 1?"Selected":""}} >Active</option>
                                        <option value=0 {{ $subcategary->is_active == 0?"Selected":""}} >Inactive</option>
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