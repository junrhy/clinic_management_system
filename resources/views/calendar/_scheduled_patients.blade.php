<table class="table table-striped">
	<thead>
		<tr>
			<th style="width:40%;">Name</th>
			<th style="width:40%;">Description</th>
			<th style="width:20%;"></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			@foreach($scheduled as $schedule)
			<td>{{ $schedule->patient->first_name }} {{ $schedule->patient->last_name }}</td>
			<td>{{ $schedule->detail }}</td>
			<th>
				<a href="#">Show</a>
			</th>
			@endforeach
		</tr>
	</tbody>
</table>