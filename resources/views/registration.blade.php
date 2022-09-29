<x-header-component/>

<div class="signUp">
	<div class="containers">
		  <input id="input" class="input" type="checkbox" />
		  
		 
		<div class="card">
		    <div class="content sign">
		        <h2 class="title">Sign Up</h2>
                <span id="errmsg" style="color:red;">{{ Session::get('errmsg') }}</span>
                
		        <div class="fields">
				<form  action="{{ URL::to('/registration') }}" method='POST' onsubmit="return valid();" >
                    @csrf
		            <label class="field">
		                <div class="icon">
		                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
		                    <g>
		                    <path fill="none" d="M0 0h24v24H0z"></path>
		                    <path d="M4 22a8 8 0 1 1 16 0h-2a6 6 0 1 0-12 0H4zm8-9c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm0-2c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z"></path>
		                    </g>
		                </svg>
		                </div>
		                <input type="text" class="name" id="name" name="name" placeholder="Your name"  value="{{old('name')}}"/>
                       
		            </label>
					@if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif

		            <label class="field">
		                <div class="icon">
		                <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
		                    <circle cx="12" cy="12" r="4"></circle>
		                    <path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path>
		                </svg>
		                </div>
		                <input type="email" class="email" id="email_id" name="email_id" placeholder="Email Address" value="{{old('email_id')}}"/>
                       
		            </label>
					@if ($errors->has('email_id'))
                                    <span class="text-danger">{{ $errors->first('email_id') }}</span>
                    @endif

		            <label class="field">
		                <div class="icon">
		                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
		                    <path d="M12 2C9.243 2 7 4.243 7 7v2H6c-1.103 0-2 .897-2 2v9c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-9c0-1.103-.897-2-2-2h-1V7c0-2.757-2.243-5-5-5zM9 7c0-1.654 1.346-3 3-3s3 1.346 3 3v2H9V7zm9.002 13H13v-2.278c.595-.347 1-.985 1-1.722 0-1.103-.897-2-2-2s-2 .897-2 2c0 .736.405 1.375 1 1.722V20H6v-9h12l.002 9z"></path>
		                </svg>
		                </div>
		                <input type="password" class="password" placeholder="Your Password" id="password" name="password" placeholder="Password"/>
                      
		            </label>
					@if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif

		            <label class="field">
		                <div class="icon">
		                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
		                    <path d="M12 2C9.243 2 7 4.243 7 7v2H6c-1.103 0-2 .897-2 2v9c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-9c0-1.103-.897-2-2-2h-1V7c0-2.757-2.243-5-5-5zM9 7c0-1.654 1.346-3 3-3s3 1.346 3 3v2H9V7zm9.002 13H13v-2.278c.595-.347 1-.985 1-1.722 0-1.103-.897-2-2-2s-2 .897-2 2c0 .736.405 1.375 1 1.722V20H6v-9h12l.002 9z"></path>
		                </svg>
		                </div>
		                <input type="password" class="password" id="con_password" name="con_password" placeholder="Conform Password"/>
                       
		            </label>
					@if ($errors->has('con_password'))
                                    <span class="text-danger">{{ $errors->first('con_password') }}</span>
                    @endif

		        </div>

		        <div class="submit">
		            <button type="submit" class="button-submit">Submit</button>
		            <p class="mt-3">Already you have a account ? <a href="{{ url('login') }}">login</a></p>
		        </div>
				</form>
		    </div>
		    
		</div>
</div>
</div>

<x-footer-component/>

<script>
    function valid() {
		    password = $("#password").val();
			confirm_password = $("#con_password").val();
            if ($("#name").val() == '') {
                $("#errmsg").html("Please enter your name!!");
                $("#name").focus();
                return false;
            }else if ($("#email_id").val() == '') {
                $("#errmsg").html("Please enter Email ID!!");
                $("#email_id").focus();
                return false;
            }else if ($("#password").val() == '') {
                $("#errmsg").html("Please enter password!!");
                $("#password").focus();
                return false;
            }else if (password.length < 8) {
                $("#errmsg").html("password must be 8 charactor!!");
                $("#password").focus();
                return false;
            }else if ($("#con_password").val() == '') {
                $("#errmsg").html("Please enter confirm password!!");
                $("#con_password").focus();
                return false;
            }else if (confirm_password.length < 8) {
                $("#errmsg").html("Please enter confirm password!!");
                $("#con_password").focus();
                return false;
            }else if (password != confirm_password) {
                $("#errmsg").html("Password and confirm password must be same!!");
                $("#con_password").focus();
                return false;
            }
        }
</script>