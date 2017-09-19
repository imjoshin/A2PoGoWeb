<div class="container">
	<form class='nav-form nav-form-map'>
		<div class="row grid-x">
			<div class="columns small-6 small-offset-3 form-field">
				<h3>Name</h3>
				<input type="text" id="name" name="name" notab>
			</div>
		</div>
		<div class="row grid-x">
			<div class="columns small-6 form-field">
				<h3>Accounts</h3>
				<table id='map-accounts'></table>
			</div>
			<div class="columns small-6 form-field">
				<h3>Days Active</h3>
				<table>
					<tr>
						<td><input type="checkbox" id="days[1]" name="days[1]" /></td>
						<td>Monday</td>
					</tr>
					<tr>
						<td><input type="checkbox" id="days[2]" name="days[2]" /></td>
						<td>Tuesday</td>
					</tr>
					<tr>
						<td><input type="checkbox" id="days[3]" name="days[3]" /></td>
						<td>Wednesday</td>
					</tr>
					<tr>
						<td><input type="checkbox" id="days[4]" name="days[4]" /></td>
						<td>Thursday</td>
					</tr>
					<tr>
						<td><input type="checkbox" id="days[5]" name="days[5]" /></td>
						<td>Friday</td>
					</tr>
					<tr>
						<td><input type="checkbox" id="days[6]" name="days[6]" /></td>
						<td>Saturday</td>
					</tr>
					<tr>
						<td><input type="checkbox" id="days[7]" name="days[7]" /></td>
						<td>Sunday</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="row grid-x">
			<div class="columns small-12 form-field">
				<h3>Time Active</h3>
				<input type="time" id="start-time" name="start-time" value="09:00:00.00"> -
				<input type="time" id="end-time" name="end-time" value="17:00:00.00">
			</div>
		</div>
		<div class="row grid-x">
			<div class="columns small-6 form-field">
				<h3>Pokemon</h3>
				<br/>
				<a class="btn btn-pokemon-select">Select Pokemon</a>
			</div>
			<div class="columns small-6 form-field">
				<h3>Raids</h3>
				<table>
					<tr>
						<td><input type="checkbox" id="raids[1]" name="raids[1]" /></td>
						<td>Level 1</td>
					</tr>
					<tr>
						<td><input type="checkbox" id="raids[2]" name="raids[2]" /></td>
						<td>Level 2</td>
					</tr>
					<tr>
						<td><input type="checkbox" id="raids[3]" name="raids[3]" /></td>
						<td>Level 3</td>
					</tr>
					<tr>
						<td><input type="checkbox" id="raids[4]" name="raids[4]" /></td>
						<td>Level 4</td>
					</tr>
					<tr>
						<td><input type="checkbox" id="raids[5]" name="raids[5]" notab/></td>
						<td>Level 5</td>
					</tr>
				</table>
			</div>
		</div>
		<input type="hidden" name="pokemon-selected" id="pokemon-selected" value="" />
	</form>
</div>
<div class='row grid-x nav-tabs-container-buttons'>
	<div class='columns small-12'>
		<a class="btn btn-save" data-target='map-form'>Save</a>
	</div>
</div>
