<div>
	Hi <strong>{{ env('MAIL_CONTACT_US_RECIPIENT_NAME') }}</strong>,<br>
	<br>
	Someone is asking for product demo. Please contact immediately. <br>
	<br>
	<table border="1" cellspacing="0" cellpadding="5">
		<tr>
			<td>First Name</td>
			<td>{{ $firstName }}</td>
		</tr>
		<tr>
			<td>Last Name</td>
			<td>{{ $lastName }}</td>
		</tr>
		<tr>
			<td>Phone</td>
			<td>{{ $phone }}</td>
		</tr>
		<tr>
			<td>Email</td>
			<td>{{ $email }}</td>
		</tr>
	</table>
</div>