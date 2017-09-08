<div id="nav">
	<div class="main-nav">
		<div id="welcome"></div>
		<div class="nav-container nav-container-accounts <?php echo count($accounts) ? "" : "nav-container--empty"; ?>">
			<label>Accounts</label>
			<i class="btn-add fa fa-plus-square-o <?php echo count($accounts) ? "" : "bouncy"; ?>" data-name="Add Account" data-target="account"></i>
			<div class="nav-container-options">
				<?php
					foreach ($accounts as $account)
					{

						echo "
						<div class='nav-container-options-item' data-id='{$account['id']}'>
							<i class='fa {$account['icon']}' aria-hidden='true'></i>
							{$account['name']}
						</div>";
					}
				?>
			</div>
		</div>
		<div class="nav-container nav-container-maps <?php echo (count($accounts) ? " " : "disabled ") . (count($maps) ? "" : "nav-container--empty"); ?>">
			<label>Maps</label>
			<i class='btn-add fa fa-plus-square-o  <?php echo count($maps) ? "" : "bouncy"; ?>' <?php echo count($accounts) ? "" : "style='display: none;'"; ?> data-name="Add Map" data-target="map"></i>
			<div class="nav-container-options">
				<?php
					foreach ($maps as $map)
					{

						echo "
						<div class='nav-container-options-item' data-id='{$map['id']}'>
							<i class='fa {$map['icon']}' aria-hidden='true'></i>
							{$map['name']}
						</div>";
					}
				?>
			</div>
		</div>
	</div>
	<div class="sub-nav">
		<h2 class="sub-nav-header">Add Account</h2>
		<form class="sub-nav-form sub-nav-form-account">
			<?php include 'views/account.php'; ?>
		</form>
		<form class="sub-nav-form sub-nav-form-map">
			<?php include 'views/map.php'; ?>
		</form>
		<div class='message'></div>
	</div>
</div>