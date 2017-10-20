
<?php include "header.php" ?>

<?php
	if (isset($_SESSION['id']))
	{
		extract(init());
		include 'views/nav.php';
		include 'views/monselect.php';
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

<div class="map-container" data-boundaries='<?php echo isset($boundaries) ? json_encode($boundaries) : ''; ?>'>
	<div class="map-container-object" id="map-container-object"></div>
</div>

<?php include "footer.php" ?>
