<span>Name</span>
<input type="text" id="name" name="name">
<span>Type</span>
<select id="type" name="type">
	<option>Phone</option>
	<option>Email</option>
	<option>Slack</option>
	<option>Discord</option>
</select>
<span class="sub-nav-form-address">
	<span class="sub-nav-form-address-email" style="display: none;">
		<span>Address</span>
		<input type="text" id="address" name="address">
	</span>
	<span class="sub-nav-form-address-phone">
		<span>Phone Number</span>
		<input type="text" id="number" name="number">
		<span>Carrier</span>
		<select id="carrier" name="carrier">
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
	<span class="sub-nav-form-address-verification">
		<span>Verification Code</span>
		<a class="btn">Send Code</a>
		<input type="text" id="verification" name="verification" style="display: none;">
	</span>
</span>
<span class="sub-nav-form-webhook" style="display: none;">
	<span>Webhook URL</span>
	<input type="text" id="webhook" name="webhook">
	<span>Channel ID</span>
	<input type="text" id="channel" name="channel">
</span>
<br/>
<a class="btn btn-save">Save</a>
