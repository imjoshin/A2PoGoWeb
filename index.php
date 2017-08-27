
<?php include "header.php" ?>

<?php
	if (isset($_SESSION['id']))
	{
		extract(init());
		include 'views/nav.php';
		?>
		<span id="floating-logout" class="logout">
			Logout
		</span>
		<?php
	}
	else
	{
		include 'views/login.php';
	}
?>

<div id="map-container">
	<div id="map"></div>
</div>

<?php include "footer.php" ?>
