<div class="dashbordMenu">
	<ul class="ps-0">
		<li>
			<a href="{{ url('my-account') }}" class="{{ $activeid == 1?'actives':' ' }}">User Dashboard</a>
		</li>
		<li>
			<a href="{{ url('edit-profile') }}" class="{{ $activeid == 2?'actives':' ' }}">Edit Profile</a>
		</li>
		<li>
			<a href="{{ url('password-change') }}" class="{{ $activeid == 3?'actives':' ' }}">Change Password</a>
		</li>
		<li>
			<a class="logout" href="{{ url('logout') }}">Logout</a>
		</li>
	</ul>
</div>