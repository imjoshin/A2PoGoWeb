<div class="container">
	<form class='nav-form nav-form-account'>
		<div class="row grid-x">
			<div class="columns small-6 form-field">
				<h3>Name</h3>
				<input type="text" id="name" name="name">
			</div>
			<div class="columns small-6 form-field">
				<h3>Type</h3>
				<select id="type" name="type" class="non-editable-input">
					<option value='phone'>Phone</option>
					<option value='email'>Email</option>
					<option value='slack'>Slack</option>
					<option value='discord'>Discord</option>
				</select>
			</div>
			<div class="columns small-6 form-field" data-type="address-email">
				<h3>Address</h3>
				<input type="text" id="address" name="address" class="non-editable-input">
			</div>
			<div class="columns small-6 form-field" data-type="address-phone">
				<h3>Phone Number</h3>
				<input type="text" id="number" name="number" class="non-editable-input">
			</div>
			<div class="columns small-6 form-field" data-type="address-phone">
				<h3>Carrier</h3>
				<select id="carrier" name="carrier" class="non-editable-input">
					<option value="txt.att.net">AT&amp;T</option>
					<option value="tmomail.net">T-Mobile</option>
					<option value="vtext.com">Verizon</option>
					<option value="messaging.sprintpcs.com ">Sprint</option>
					<option value="number@vmobl.com">Virgin Mobile</option>
					<option value="mmst5.tracfone.com">Tracfone</option>
					<option value="email.uscc.net">U.S. Cellular</option>
					<option value="mymetropcs.com">Metro PCS</option>
					<option value="myboostmobile.com">Boost Mobile</option>
					<option value="mms.cricketwireless.net">Cricket</option>
					<option value="ptel.com">Ptel</option>
					<option value="text.republicwireless.com">Republic Wireless</option>
					<option value="msg.fi.google.com">Google Fi</option>
					<option value="tms.suncom.com">Suncom</option>
					<option value="message.ting.com">Ting</option>
					<option value="cingularme.com">Consumer Cellular</option>
					<option value="cspire1.com">C-Spire</option>
					<option value="vtext.com">Page Plus</option>
				</select>
			</div>
			<div class="columns small-3 form-field" data-type="webhook-discord">
			</div>
			<div class="columns small-6 form-field" data-type="webhook">
				<h3>Webhook URL</h3>
				<input type="text" id="webhook" name="webhook">
			</div>
			<div class="columns small-6 form-field" data-type="webhook-slack">
				<h3>Channel ID</h3>
				<input type="text" id="channel" name="channel">
			</div>
			<div class="columns small-6 form-field" data-type="webhook">
				<h3>
					<span data-type="webhook-slack">Pokemon User</span>
					<span data-type="webhook-discord">Pokemon Title</span>
					<div class="info-icon">
						<i class="fa fa-info-circle"></i>
						<div class="info-icon-content">
							Variables for use:<br/>
							%NAME% - Pokemon Name<br/>
							%NUMBER% - Pokemon Number<br/>
							%MAPNAME% - Map Name<br/>
							%ENDTIME% - Despawn Time<br/>
							%URL% - URL to Google Maps
						</div>
					</div>
				</h3>
				<input type="text" id="pokemon-user" name="pokemon-user" class="formatter" value="%NAME%" maxlength="64"><br/>
			</div>
			<div class="columns small-6 form-field">
				<h3>
					Pokemon Format
					<div class="info-icon">
						<i class="fa fa-info-circle"></i>
						<div class="info-icon-content">
							Variables for use:<br/>
							%NAME% - Pokemon Name<br/>
							%NUMBER% - Pokemon Number<br/>
							%MAPNAME% - Map Name<br/>
							%ENDTIME% - Despawn Time<br/>
							%URL% - URL to Google Maps
						</div>
					</div>
				</h3>
				<input type="text" id="pokemon-format" name="pokemon-format" class="formatter" value="Active in %MAPNAME% until %ENDTIME%." maxlength="512"><br/>
			</div>
			<div class="columns small-6 form-field" data-type="webhook">
				<h3>
					<span data-type="webhook-slack">Raid User</span>
					<span data-type="webhook-discord">Raid Title</span>
					<div class="info-icon">
						<i class="fa fa-info-circle"></i>
						<div class="info-icon-content">
							Variables for use:<br/>
							%NAME% - Pokemon Name<br/>
							%NUMBER% - Pokemon Number<br/>
							%MAPNAME% - Map Name<br/>
							%GYMNAME% - Gym Name<br/>
							%STARTTIME% - Start Time<br/>
							%ENDTIME% - End Time<br/>
							%RAIDLEVEL% - Raid Level<br/>
							%URL% - URL to Google Maps
						</div>
					</div>
				</h3>
				<input type="text" id="raid-user" name="raid-user" class="formatter" value="RAID: %NAME% (Level %RAIDLEVEL%)" maxlength="64"><br/>
			</div>
			<div class="columns small-6 form-field">
				<h3>
					Raid Format
					<div class="info-icon">
						<i class="fa fa-info-circle"></i>
						<div class="info-icon-content">
							Variables for use:<br/>
							%NAME% - Pokemon Name<br/>
							%NUMBER% - Pokemon Number<br/>
							%MAPNAME% - Map Name<br/>
							%GYMNAME% - Gym Name<br/>
							%STARTTIME% - Start Time<br/>
							%ENDTIME% - End Time<br/>
							%RAIDLEVEL% - Raid Level<br/>
							%URL% - URL to Google Maps
						</div>
					</div>
				</h3>
				<input type="text" id="raid-format" name="raid-format" class="formatter" value="Active at %GYMNAME% until %ENDTIME%." maxlength="512"><br/>
			</div>
			<div class="columns small-6 form-field" data-type="webhook">
				<h3>
					<span data-type="webhook-slack">Raid Egg User</span>
					<span data-type="webhook-discord">Raid Egg Title</span>
					<div class="info-icon">
						<i class="fa fa-info-circle"></i>
						<div class="info-icon-content">
							Variables for use:<br/>
							%MAPNAME% - Map Name<br/>
							%GYMNAME% - Gym Name<br/>
							%STARTTIME% - Start Time<br/>
							%ENDTIME% - End Time<br/>
							%RAIDLEVEL% - Raid Level<br/>
							%URL% - URL to Google Maps
						</div>
					</div>
				</h3>
				<input type="text" id="raid-egg-user" name="raid-egg-user" class="formatter" value="Raid Incoming!" maxlength="64"><br/>
			</div>
			<div class="columns small-6 form-field">
				<h3>
					Raid Egg Format
					<div class="info-icon">
						<i class="fa fa-info-circle"></i>
						<div class="info-icon-content">
							Variables for use:<br/>
							%MAPNAME% - Map Name<br/>
							%GYMNAME% - Gym Name<br/>
							%STARTTIME% - Start Time<br/>
							%ENDTIME% - End Time<br/>
							%RAIDLEVEL% - Raid Level<br/>
							%URL% - URL to Google Maps
						</div>
					</div>
				</h3>
				<input type="text" id="raid-egg-format" name="raid-egg-format" class="formatter" value="A level %RAIDLEVEL% raid will be at %GYMNAME% starting at %STARTTIME%." maxlength="512"><br/>
			</div>
			<div class="columns small-6 form-field nav-form-address-verification hidden-edit-input" data-type="address">
				<h3>Verification Code</h3>
				<a class="btn">Send Code</a>
				<input type="text" id="verification" name="verification" style="display: none;">
			</div>
			<div class="columns small-12 form-field" data-type="address-phone">
				* Standard messaging rates apply
			</div>
		</div>
	</form>
</div>
<div class='row grid-x nav-tabs-container-buttons'>
	<div class='columns small-12'>
		<a class="btn btn-save" data-target='account-form'>Save</a>
	</div>
</div>
