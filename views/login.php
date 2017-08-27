<div id="login-wrapper">
	<div id="login-wrapper-logo"></div>
	<div class="login-modal">
		<div class="login-modal-tabs">
			<div class="login-modal-tabs-item login-modal-tabs-item--active" data-form="login">
				Login
			</div>
			<div class="login-modal-tabs-item" data-form="register">
				Register
			</div>
		</div>
		<div class="login-modal-form login-modal-form--active" data-form="login">
			<form id="login-form">
				<span>Username</span>
				<input type="text" name="username">
				<span>Password</span>
				<input type="password" name="password">
				<br/><br/>
				<a class="btn btn-blue">Login</a>
			</form>
		</div>
		<div class="login-modal-form" data-form="register">
			<form id="register-form">
				<span>Username</span>
				<input type="text" name="username">
				<span>Password</span>
				<input type="password" name="password">
				<span>Confirm Password</span>
				<input type="password" name="confirm_password">
				<?php
				if (REQUIRE_INVITE)
				{
					echo "<span>Invite Code</span><input type='text' name='invitation_code'>";
				}
				?>
				<br/><br/>
				<a class="btn btn-blue">Register</a>
			</form>
		</div>
		<div class='message'></div>
	</div>
</div>
