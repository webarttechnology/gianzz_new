<x-header-component/>

<div class="signUp">
	<div class="containers">
		  <input id="input" class="input" type="checkbox" />
		  
		  <!-- <label for="input" class="toggle">
		    <span class="text sign-text">Sign Up</span>
		    <span class="icon">
		      <svg class="arrow" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" height="32" width="32" xmlns="http://www.w3.org/2000/svg">
		        <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"></path>
		      </svg>
		    </span>
		    <span class="text log-text">Log In</span>
		</label> -->
		  
		<div class="card">
		    
		    <div class="content logs justify-content-center">
		      <h2 class="title">Log In</h2>
			  <span style="color:green">{{Session::get('successmsg')}}</span><br/>
              <span id="errmsg" style="color:red">{{Session::get('errmsg')}}</span><br/>
		      <div class="fields">
			  <form  action="{{ url('/login') }}" method='POST' onsubmit="return valid();" > 
					@csrf
		        <label class="field">
		          <div class="icon">
		            <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
		              <circle cx="12" cy="12" r="4"></circle>
		              <path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path>
		            </svg>
		          </div>
		          <input type="email" class="email" placeholder="Your Email" id="emailid" name="emailid" placeholder="Email Address" value="{{ old('email_id') }}"/>
		        </label>
				@if ($errors->has('emailid'))
                    <span class="text-danger">{{ $errors->first('emailid') }}</span>
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
		      </div>

		      <div class="submit">
		       	<button type="submit" class="button-submit">Submit</button>
		      </div>
			</form>
		      <!-- <a href="#" class="forgotPass">Forgot password ?</a> -->
		      <p class="mt-3">You don't have any account ? <a href="{{ url('registration') }}">Signup</a></p>
		  </div>
		</div>
</div>
</div>


<x-footer-component/>
<script>
    function valid() {
             if ($("#emailid").val() == '') {
                $("#errmsg").html("Please Enter Email ID!!");
                //$("#email").css("border-color", "red");
                return false;
            }else if ($("#password").val() == '') {
                $("#errmsg").html("Please Enter Password!!");
                //$("#email").css("border-color", "red");
                return false;
            }
        }
</script>