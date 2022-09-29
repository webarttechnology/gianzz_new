<x-adminheader />
<x-adminnav />
<div class="wave -three"></div>
<div class="app-content">
					<section class="section">


                        <!--page-header open-->
						<div class="page-header">
							<h4 class="page-title">Change Password</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#" class="text-light-color">Password</a></li>
								<li class="breadcrumb-item active" aria-current="page">Change Password</li>
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
										<h4>Change Admin Password</h4>
                                        <span style="color:green" id="successmsg">{{ Session::get('successmsg') }}</span>
                                            <span style="color:red" id="errmsg">{{ Session::get('errmsg') }}</span>
									</div>
									<div class="card-body">
									<span id="errmsg" style="color:red"></span>
										<form class="form-horizontal"  action="{{ url('/author/password-change') }}" method='POST' onsubmit="return valid();" >
                                        @csrf
                                           

											<div class="form-group row">
												<label for="inputName" class="col-md-3 col-form-label">Old Password</label>
												<div class="col-md-9">
													<input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old Password" >
                                                    @if ($errors->has('old_password'))
                                                                <span class="text-danger">{{ $errors->first('old_password') }}</span>
                                                    @endif
												</div>
											</div>

                                            <div class="form-group row">
												<label for="inputName" class="col-md-3 col-form-label">New Password</label>
												<div class="col-md-9">
													<input type="password" class="form-control" id="pwd" name="pwd" placeholder="New Password" >
                                                    @if ($errors->has('pwd'))
                                                                <span class="text-danger">{{ $errors->first('pwd') }}</span>
                                                    @endif
												</div>
											</div>

                                            <div class="form-group row">
												<label for="inputName" class="col-md-3 col-form-label">Confirm Password</label>
												<div class="col-md-9">
													<input type="password" class="form-control" id="con_password" name="con_password" placeholder="Confirm Password" >
                                                    @if ($errors->has('con_password'))
                                                                <span class="text-danger">{{ $errors->first('con_password') }}</span>
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
            if ($("#old_password").val() == '') {
                $("#errmsg").html("Please Enter Old Password");
                //$("#email").css("border-color", "red");
                return false;
            }else if ($("#pwd").val() == '') {
                $("#errmsg").html("Please Enter New Password");
                //$("#email").css("border-color", "red");
                return false;
            }else if ($("#con_password").val() == '') {
                $("#errmsg").html("Please Enter A Confirm Password");
                //$("#email").css("border-color", "red");
                return false;
            }
        }
</script>
