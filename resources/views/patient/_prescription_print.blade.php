<div style="text-align: center;">
	<div style="font-size: 16pt;font-weight: bold;">{{ $prescription->clinic }}</div>
	<span>{{ $prescription->clinicObject->address }}</span><br>
	<span>{{ $prescription->clinicObject->contact_number }}</span>
</div>
<br>
<table cellpadding="0" cellspacing="0" width="100%">
<tr style="border-bottom: 1px dotted #000;">
	<td>Name:&nbsp;&nbsp;<u><strong>{{ $prescription->patient->first_name }} {{ $prescription->patient->last_name }}</u></td>
	<td colspan="2"></strong></td>
</tr>
<tr style="border-bottom: 1px dotted #000;">
	<td>Address:&nbsp;&nbsp;<u><strong>{{ $prescription->patient->address }}</strong></u></td>
	<td colspan="2"></td>
</tr>
<tr style="border-bottom: 1px dotted #000;">
	<td width="35%">Age: <u><strong>{{ $prescription->patient->dob->age }}</strong></u></td>
	<td width="35%">Sex: <u><strong>{{ $prescription->patient->gender }}</strong></u></td>
	<td width="35%" align="right">Date: <u><strong>{{ $prescription->created_at->format('M d, Y') }}</strong></u></td>
</tr>
</table>
<div style="height: 350px;">
	<span style="font-size: 100pt;font-weight: bold;position: relative;top: -40px;left: -10px;color: #eee;">℞</span>
	
</div>
<div style="position: relative;top: -350px;">
	<span style="position: relative; top:30px; left: 70px;font-size: 14pt;">{!! $prescription->prescription !!}</span>
</div>

<br>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td>&nbsp;</td>
	<td align="right">Physician's Signature:&nbsp;&nbsp;</td>
	<td width="30%" style="border-bottom: 1px dotted #000;"></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td align="right">License No.:&nbsp;&nbsp;</td>
	<td width="30%" style="border-bottom: 1px dotted #000;"></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td align="right">PTR No.:&nbsp;&nbsp;</td>
	<td width="30%" style="border-bottom: 1px dotted #000;"></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td align="right">S2 No.:&nbsp;&nbsp;</td>
	<td width="30%" style="border-bottom: 1px dotted #000;"></td>
</tr>
</table>