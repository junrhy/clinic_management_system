<div style="font-family: Arial, Helvetica, sans-serif;background-color: #ffffff;color: #000;">
	@if (auth()->user()->client->logo != "")
		@if(env('FILESYSTEM_DRIVER') == 'spaces')
		<?php $image_link = asset("https://file-server1.sfo2.digitaloceanspaces.com/" . auth()->user()->client->logo); ?>
        <div style="background-image: url('{{ $image_link }}');height: 75px;width: 100%;background-repeat: no-repeat;background-size: 300px 75px;background-position: center;">
        	
        	<div style="text-align: center;position: relative;top: 65px;">
        		<span>{{ $prescription->clinicObject->address }}</span><br>
				<span>{{ $prescription->clinicObject->contact_number }}</span>
        	</div>
        </div>
        @endif

        @if(env('FILESYSTEM_DRIVER') == 'public')
        <?php $image_link = asset("storage/" . auth()->user()->client->logo); ?>
        <div style="background-image: url('{{ $image_link }}');height: 75px;width: 100%;background-repeat: no-repeat;background-size: 300px 75px;background-position: center;">

        	<div style="text-align: center;position: relative;top: 65px;;">
        		<span>{{ $prescription->clinicObject->address }}</span><br>
				<span>{{ $prescription->clinicObject->contact_number }}</span>
        	</div>
        </div>
        @endif
        
        <br>
	@else
		<div style="font-size: 16pt;font-weight: bold;">{{ $prescription->clinic }}</div>
		<div style="text-align:center;">
			<span>{{ $prescription->clinicObject->address }}</span><br>
			<span>{{ $prescription->clinicObject->contact_number }}</span>
		</div>
	@endif
	<br>
	<table cellpadding="0" cellspacing="0" width="100%">
	<tr style="border-bottom: 1px solid #fff;">
		<td colspan="3" align="right">Date: {{ $prescription->created_at->format('M d, Y') }}</td>
	</tr>
	<tr style="border-bottom: 1px solid #000;">
		<td colspan="3">Patient:&nbsp;&nbsp;{{ $prescription->patient->first_name }} {{ $prescription->patient->last_name }}</td>
	</tr>
	<tr style="border-bottom: 1px solid #000;">
		<td colspan="3">Address:&nbsp;&nbsp;{{ $prescription->patient->address }}</td>
	</tr>
	<tr style="border-bottom: 1px solid #000;">
		<td width="35%">Age: {{ $prescription->patient->dob->age }}</td>
		<td colspan="2">Sex: {{ $prescription->patient->gender }}</td>
	</tr>
	</table>

	<div style="height: 350px;overflow-y: auto;">
		<span style="font-size: 100pt;font-weight: bold;position: relative;top: -40px;left: -10px;height: 380px;float: left;">℞</span>
		<span style="position: relative; top:10px; left: 0px;font-size: 12pt;">{!! $prescription->prescription !!}</span>
	</div>

	<br>
	<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>&nbsp;</td>
		<td align="right">Physician's Signature:&nbsp;&nbsp;</td>
		<td width="30%" style="border-bottom: 1px solid #000;text-align: center;">{{ $prescription->doctor }}</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td align="right">License No.:&nbsp;&nbsp;</td>
		<td width="30%" style="border-bottom: 1px solid #000;text-align: center;">{{ $prescription->doctorObject->license_no }}</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td align="right">PTR No.:&nbsp;&nbsp;</td>
		<td width="30%" style="border-bottom: 1px solid #000;text-align: center;">{{ $prescription->doctorObject->ptr_no }}</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td align="right">S2 No.:&nbsp;&nbsp;</td>
		<td width="30%" style="border-bottom: 1px solid #000;"></td>
	</tr>
	</table>

</div>