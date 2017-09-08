<h3>Name</h3>
<input type="text" id="name" name="name">
<h3>Days Active</h3>
<table>
	<tr>
		<td><input type="checkbox" name="days[s]" /></td>
		<td>Sunday</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="days[m]" /></td>
		<td>Monday</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="days[t]" /></td>
		<td>Tuesday</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="days[w]" /></td>
		<td>Wednesday</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="days[h]" /></td>
		<td>Thursday</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="days[f]" /></td>
		<td>Friday</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="days[a]" /></td>
		<td>Saturday</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="days[a]" /></td>
		<td>Sunday</td>
	</tr>
</table>
<h3>Time Active</h3>
<input type="time" id="start-time" name="start-time" value="09:00:00.00"> -
<input type="time" id="end-time" name="end-time" value="17:00:00.00">
<h3>Accounts</h3>
<table id='map-accounts'>
</table>
<h3>Notifications</h3>
<h4>Pokemon</h4>
<br/>
<a class="btn btn-pokemon-select">Select Pokemon</a>
<input type="hidden" name="pokemon-selected" id="pokemon-selected" value="" />
<h4>Raids</h4>
<table>
	<tr>
		<td><input type="checkbox" name="raids[1]" /></td>
		<td>Level 1</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="raids[2]" /></td>
		<td>Level 2</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="raids[3]" /></td>
		<td>Level 3</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="raids[4]" /></td>
		<td>Level 4</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="raids[5]" /></td>
		<td>Level 5</td>
	</tr>
</table>
<br/><br/>
<a class="btn btn-save">Save</a>
