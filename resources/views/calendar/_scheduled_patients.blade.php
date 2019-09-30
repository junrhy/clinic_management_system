<table class="table table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th style="width:30%;">Name</th>
			<th style="width:70%;">Description</th>
		</tr>
	</thead>
	<tbody>
		@foreach($scheduled as $key => $schedule)
		<tr>
			<td>{{ $key + 1 }}</td>
			<td>{{ $schedule->patient->first_name }} {{ $schedule->patient->last_name }}</td>
			<td>{{ $schedule->detail }}</td>
		</tr>
		@endforeach
	</tbody>
</table>