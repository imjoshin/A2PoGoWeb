
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
		<div id="login-modal">
			<div id="login-tabs">
				<div class="login-tabs-item login-tabs-item--active">
					Login
				</div>
				<div class="login-tabs-item">
					Register
				</div>
			</div>
			<div id="login-modal-form-login">

			</div>
			<div id="login-modal-form-register">

			</div>
		</div>
		<?php
	}
?>

<div id="map-container">
	<div id="map"></div>
</div>

<?php include "footer.php" ?>
