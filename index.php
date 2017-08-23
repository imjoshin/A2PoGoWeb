
<?php include "header.php" ?>

<?php
	if (isset($_SESSION['id']))
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
					<span>Username</span>
					<input type="text">
					<span>Password</span>
					<input type="text"><br/><br/>
					<a class="btn btn-blue">Login</a>
				</div>
				<div class="login-modal-form" data-form="register">
					<span>Username</span>
					<input type="text">
					<span>Password</span>
					<input type="text">
					<span>Confirm Password</span>
					<input type="text">
					<span>Invite Code</span>
					<input type="text"><br/><br/>
					<a class="btn btn-blue">Register</a>
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
