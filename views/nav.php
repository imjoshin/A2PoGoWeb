<div class="nav">
	<div id="welcome"></div>
	<div class="container">
		<div class="row nav-tabs">
			<div class="nav-tabs-item nav-tabs-item--active" data-view="accounts">
				Feeds
			</div>
			<div class="nav-tabs-item <?php echo (count($accounts) <= 1 ? 'disabled' : ''); ?>" data-view="maps">
				Maps
			</div>
		</div>
		<div class="row nav-tabs-track">
			<div class="nav-tabs-track-slider" data-place='1'></div>
		</div>
		<div class="row nav-content">
			<div class="nav-tabs-container nav-tabs-container--active" data-view="accounts">
				<?php
					foreach ($accounts as $account)
					{
						echo "
						<div class='row grid-x nav-tabs-container-item " . ($account['id'] < 0 ? 'nav-tabs-container-item-template' : '') . "' data-id='{$account['id']}' data-fields='" . json_encode($account) . "' data-view='account-form'>
							<div class='columns small-1 nav-tabs-container-item-icon'>
								<i class='fa {$account['icon']}' aria-hidden='true'></i>
							</div>
							<div class='columns small-11 nav-tabs-container-item-info'>
								<div class='row nav-tabs-container-item-info-name'>
									<label class='account-name'>{$account['name']}</label>
								</div>
								<div class='row nav-tabs-container-item-info-details'>
									<label class='account-address'>{$account['detail']}</label>
								</div>
							</div>
						</div>";
					}
				?>
				<div class='row grid-x nav-tabs-container-buttons'>
					<div class='columns small-12'>
						<span class="btn btn-white btn-add" data-name="Add Feed" data-view="account-form">Add Feed</span>
					</div>
				</div>
			</div>
			<div class="nav-tabs-container nav-tabs-container--right" data-view="maps">
				<?php
					foreach ($maps as $map)
					{
						echo "
						<div class='row grid-x nav-tabs-container-item " . ($map['id'] < 0 ? 'nav-tabs-container-item-template' : '') . "' data-id='{$map['id']}' data-fields='" . json_encode($map) . "' data-view='map-form'>
							<div class='columns small-1 nav-tabs-container-item-icon'>
								<i class='fa {$map['icon']}' aria-hidden='true'></i>
							</div>
							<div class='columns small-11 nav-tabs-container-item-info'>
								<div class='row nav-tabs-container-item-info-name'>
									<label class='account-name'>{$map['name']}</label>
								</div>
								<div class='row nav-tabs-container-item-info-details'>
									<label class='account-address'>{$map['detail']}</label>
								</div>
							</div>
						</div>";
					}
				?>
				<div class='row grid-x nav-tabs-container-buttons'>
					<div class='columns small-12'>
						<span class="btn btn-white btn-add" data-name="Add Map" data-view="map-form">Add Map</span>
					</div>
				</div>
			</div>
			<div class="nav-tabs-container nav-tabs-container--right" data-view="account-form">
				<?php include 'views/account.php'?>
				<div class='columns small-12 message'></div>
			</div>
			<div class="nav-tabs-container nav-tabs-container--right" data-view="map-form">
				<?php include 'views/map.php'?>
				<div class='columns small-12 message'></div>
			</div>
		</div>
	</div>
</div>
