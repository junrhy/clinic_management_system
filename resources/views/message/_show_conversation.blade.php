<?php 
$prev_sender_id = 0;
?>

<br>
<input type="hidden" id="is-no-reply" value="{{ $room->is_no_reply }}">

@foreach($messages as $message)

<?php 
if ($message->user_id == 0 || $message->sender->id == auth()->user()->id) {
	$align = "left";
	$bg_color = "#00c0ff";
	$color = "#FFFFFF";
	$border_radius = "3px 15px 15px 3px";
} else {
	$align = "right";
	$bg_color = "#EEEEEE";
	$color = "#000000";
	$border_radius = "15px 3px 3px 15px";
}
?>



<div class="col-md-12" align="{{ $align }}">
	@if($message->user_id != 0 && $message->sender && $prev_sender_id != $message->sender->id)
	<small style="font-size:8pt;font-family: sans-serif;">{{ $message->sender->first_name }} {{ $message->sender->last_name }} | 
		{{ $message->created_at->format('D') }} at {{ $message->created_at->format('h:iA') }}
	</small><br>
	@else
	<small style="font-size:8pt;font-family: sans-serif;">Guest | 
		{{ $message->created_at->format('D') }} at {{ $message->created_at->format('h:iA') }}
	</small><br>
	@endif

	<div style="background-color: {{ $bg_color }};color: {{ $color }};padding: 10px;border-radius: {{ $border_radius }};display: inline-block;border-bottom: 1px solid #fff;">
		{!! $message->message !!}
	</div>
</div>

<?php 

if ($message->user_id != 0) {
	$prev_sender_id = $message->sender->id;
}

?>

@endforeach

<div class="col-md-12">
	<br>
	@if($room->is_no_reply == 1)
	<div align="center" style="color: #ccc;font-size: 8pt;font-weight: bold;">Conversation is disabled. You cannot reply on this message.</div>
	@endif
</div>