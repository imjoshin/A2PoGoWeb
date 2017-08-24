
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
					<div class="nav-container-options">
						<?php
							for($i = 1; $i <= 10; $i++)
							{
								echo "<div class='nav-container-options-item'>$i</div>";
							}
						?>
					</div>
				</div>
				<div class="nav-container">
					<label>Maps</label>
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
						<input type="text">
						<span>Password</span>
						<input type="text">
						<br/><br/>
						<a class="btn btn-blue">Login</a>
					</form>
				</div>
				<div class="login-modal-form" data-form="register">
					<form id="register-form">
						<span>Username</span>
						<input type="text">
						<span>Password</span>
						<input type="text">
						<span>Confirm Password</span>
						<input type="text">
						<?php
						if (REQUIRE_INVITE)
						{
							echo "<span>Invite Code</span><input type='text'>";
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
