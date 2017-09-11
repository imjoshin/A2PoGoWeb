<h3>Name</h3>
<input type="text" id="name" name="name">
<h3>Type</h3>
<select id="type" name="type" class="non-editable-input">
	<option value='phone'>Phone</option>
	<option value='email'>Email</option>
	<option value='slack'>Slack</option>
	<option value='discord'>Discord</option>
</select>
<span class="sub-nav-form-address">
	<span class="sub-nav-form-address-email" style="display: none;">
		<h3>Address</h3>
		<input type="text" id="address" name="address" class="non-editable-input">
	</span>
	<span class="sub-nav-form-address-phone">
		<h3>Phone Number</h3>
		<input type="text" id="number" name="number" class="non-editable-input">
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
	</span>
	<span class="sub-nav-form-address-verification hidden-edit-input">
		<h3>Verification Code</h3>
		<a class="btn">Send Code</a>
		<input type="text" id="verification" name="verification" style="display: none;">
	</span>
</span>
<span class="sub-nav-form-webhook" style="display: none;">
	<h3>Webhook URL</h3>
	<input type="text" id="webhook" name="webhook">
	<h3>Channel ID</h3>
	<input type="text" id="channel" name="channel">
</span>
<input type="hidden" name="new" value="1">
<input type="hidden" id="id" name="id" value="-1">
<br/><br/>
<a class="btn btn-save">Save</a>
