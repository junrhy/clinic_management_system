<br>
@foreach($messages as $message)

<?php 
if ($message->sender->id == auth()->user()->id) {
	$align = "left";
	$bg_color = "#E6E8FA";
} else {
	$align = "right";
	$bg_color = "#EEEEEE";
}
?>



<div class="col-md-12" align="{{ $align }}">
	@if($message->sender)
	<small style="font-size:8pt;">{{ $message->sender->first_name }} {{ $message->sender->last_name }}</small><br>
	@endif

	<div style="background-color: {{ $bg_color }};padding: 10px;border-radius: 15px;display: inline-block;">
		{{ $message->message }}
	</div>
</div>

@endforeach

<div class="col-md-12">
	<br>
</div>