
<?php include "header.php" ?>

<?php
	if (isset($_SESSION['id']))
	{
		?>
		<div id="nav">
			<div class="main-nav">
				<div id="welcome"></div>
				<div class="nav-container <?php echo count($accounts) ? "" : "nav-container--empty"; ?>">
					<label>Accounts</label>
					<i class="btn-add fa fa-plus-square-o <?php echo count($accounts) ? "" : "bouncy"; ?>"></i>
					<div class="nav-container-options">
						<!--<div class='nav-container-options-item'></div>-->
					</div>
				</div>
				<div class="nav-container <?php echo (count($accounts) ? " " : "disabled ") . (count($maps) ? "" : "nav-container--empty"); ?>">
					<label>Maps</label>
					<i class='btn-add fa fa-plus-square-o  <?php echo count($maps) ? "" : "bouncy"; ?>' <?php echo count($accounts) ? "" : "style='display: none;'"; ?>></i>
					<div class="nav-container-options">
					</div>
				</div>

			</div>
			<div class="sub-nav">
				<span class="sub-nav-header">Add Account</span>
				<div class="sub-nav-form sub-nav-form-account">
					<span>Name</span>
					<input type="text" id="name" name="name">
					<span>Type</span>
					<select id="type" name="type">
						<option>Phone/Email</option>
						<option>Slack</option>
						<option>Discord</option>
					</select>
					<span class="sub-nav-form-address">
						<span>Address</span>
						<input type="text" id="address" name="address">
						<span class="sub-nav-form-address-verification">
							<span>Verification Code</span>
							<a class="btn">Send Code</a>
							<input type="text" id="verification" name="verification" style="display: none;">
						</span>
					</span>
					<span class="sub-nav-form-webhook" style="display: none;">
						<span>Webhook URL</span>
						<input type="text" id="webhook" name="webhook">
						<span>Channel ID</span>
						<input type="text" id="channel" name="channel">
					</span>
					<br/>
					<a class="btn">Save</a>
				</div>
				<div class="sub-nav-form sub-nav-form-map">

				</div>
				<div class='message'></div>
			</div>
		</div>
		<span id="floating-logout" class="logout">
			Logout
		</span>
		<?php
	}
	else
	{
		?>
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
		<?php
	}
?>

<div id="map-container">
	<div id="map"></div>
</div>

<?php include "footer.php" ?>
