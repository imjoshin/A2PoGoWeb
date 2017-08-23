
<?php include "header.php" ?>

<div id="nav">
	<div id="main-nav">
		<div id="welcome"></div>
		<div class="nav-container">
			Accounts
			<div class="nav-container-options">
				<?php
					for($i = 1; $i <= 10; $i++)
					{
						echo "<div class='nav-container-options-item'>$i</div>";
					}
				?>
			</div>
		</div>

	</div>
	<div id="sub-nav">
		<nav class="navbar navbar-default">
			<li class="active"><a href="#">Home</a></li>
			<li><a href="#">Page 1</a></li>
			<li><a href="#">Page 2</a></li>
			<li><a href="#">Page 3</a></li>
		</nav>
	</div>
</div>
<div id="map-container">
	<div id="map"></div>
</div>

<?php include "footer.php" ?>
