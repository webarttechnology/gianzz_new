<x-adminheader />
<x-adminnav />
<div class="wave -three"></div>
<div class="app-content">
					<section class="section">


                        <!--page-header open-->
						<div class="page-header">
							<h4 class="page-title">Edit Categary</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#" class="text-light-color">Edit</a></li>
								<li class="breadcrumb-item active" aria-current="page">Edit Customer Details</li>
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
										<h4>Edit Categary Details</h4>
					
									</div>
									<div class="card-body">
									<span id="errmsg" style="color:red"></span>
										<form class="form-horizontal"  action="{{ url('/author/category/update') }}" method='POST' onsubmit="return valid();" enctype="multipart/form-data" >
                                        @csrf
											<div class="form-group row">
												<label for="inputName" class="col-md-3 col-form-label">Categary Name</label>
												<div class="col-md-9">
													<input type="text" class="form-control" id="name" name="name" placeholder="Customer Name" value="{{ $categary['name'] }}">
													<input type="hidden" name="id" value="{{ $categary['id'] }}" >
													@if ($errors->has('name'))
                                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            		@endif
												</div>
											</div>
											<div class="form-group row">
												<label for="inputName" class="col-md-3 col-form-label">Image</label>
												<div class="col-md-9">
													<input type="file" class="form-control" id="image" name="image" >
													
													@if ($errors->has('image'))
                                                                <span class="text-danger">{{ $errors->first('image') }}</span>
                                            		@endif
												</div>
											</div>
											<div class="form-group mb-0 mt-2 row justify-content-end">
												<div class="col-md-9">
													<button type="submit" class="btn btn-info">Edit</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<!--row closed-->

                        <!--row open-->
						<div class="row">
							<div class="col-12 ">
								
							</div>
						</div>
						<!--row close-->

                        <!--row open-->
						
						<!--row close-->

                        <!--row open-->
						<div class="row">
							<div class="col-lg-12">
								
							</div>
						</div>
						<!--row close-->

					</section>
				</div>

<x-adminfooter />

<script>
    function valid() {
            if ($("#name").val() == '') {
                $("#errmsg").html("Please Enter A Categary");
                //$("#email").css("border-color", "red");
                return false;
            }
        }
</script>
