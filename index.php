
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
?>

<div id="map-container">
	<div id="map"></div>
</div>

<?php include "footer.php" ?>
