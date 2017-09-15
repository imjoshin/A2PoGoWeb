<div class="nav">
		<div id="welcome"></div>
		<div class="container">
			<div class="nav-tabs">
				<div class="nav-tabs-item nav-tabs-item--active" data-tab="accounts">
					Accounts
				</div>
				<div class="nav-tabs-item" data-tab="maps">
					Maps
				</div>
			</div>
			<div class="nav-tabs-container nav-tabs-container--active" data-tab="accounts">
				<?php
					foreach ($accounts as $account)
					{
						echo "
						<div class='row grid-x nav-tabs-container-item " . ($account['id'] < 0 ? 'nav-tabs-container-item-template' : '') . "' data-id='{$account['id']}' data-fields='" . json_encode($account) . "'>
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
						<span class="btn btn-white btn-add" data-name="Add Account">Add Account</span>
					</div>
				</div>
			</div>
			<div class="nav-tabs-container" data-tab="maps">
				<?php
					foreach ($maps as $map)
					{
						echo "
						<div class='row grid-x nav-tabs-container-item " . ($map['id'] < 0 ? 'nav-tabs-container-item-template' : '') . "' data-id='{$map['id']}' data-fields='" . json_encode($map) . "'>
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
						<span class="btn btn-white btn-add" data-name="Add Map">Add Map</span>
					</div>
				</div>
			</div>
		</div>
	<!--
	<div class="sub-nav">
		<h2 class="sub-nav-header">Add Account</h2>
		<form class="sub-nav-form sub-nav-form-account">
			<?php //include 'views/account.php'; ?>
		</form>
		<form class="sub-nav-form sub-nav-form-map">
			<?php //include 'views/map.php'; ?>
		</form>
		<div class='message'></div>
	</div>
	-->
</div>
