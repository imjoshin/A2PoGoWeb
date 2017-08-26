
<?php include "header.php" ?>

<?php
	if (isset($_SESSION['id']) || isset($_GET['fake']))
	{
		?>
		<div id="nav">
			<div id="main-nav">
				<div id="welcome"></div>
				<div class="nav-container">
					<label>Accounts</label>
					<i class="btn-add fa fa-plus-square-o <?php echo count($accounts) ? "" : "bouncy"; ?>"></i>
					<div class="nav-container-options">
					</div>
				</div>
				<div class="nav-container <?php echo count($accounts) ? "" : "disabled"; ?>">
					<label>Maps</label>
					<i class='btn-add fa fa-plus-square-o  <?php echo count($maps) ? "" : "bouncy"; ?>' <?php echo count($accounts) ? "" : "style='display: none;'"; ?>></i>
					<div class="nav-container-options">
						<?php
							for($i = 1; $i <= 20; $i++)
							{
								echo "<div class='nav-container-options-item'>$i</div>";
							}
						?>
					</div>
				</div>

			</div>
			<div id="sub-nav">

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
