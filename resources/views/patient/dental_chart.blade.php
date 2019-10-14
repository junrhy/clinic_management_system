<style type="text/css">
	img {
		height: 150px;
		width: 40px;
	}

	.chart {
		background:#ffe6ee;
		margin-left: 13px;
		margin-right: 20px;
		width: 54em;
		padding:10px;
	}

	.tooth-number {
		width: 30px;
		height:30px;
		background:#fff;
		display: inline-block;
		text-align: center;
		font-size: 12pt;
		margin:5px;
		padding-top: 2px;
		border-radius: 50%;
		cursor: pointer;
	}

	.tooth-no-selected {
		background-color: #01d8da;
		color:#fff;
	}

	.vl {
	  	border-left: 1px solid #ffb3b3;
	}

	.hl {
		border-bottom: 3px solid #ffb3b3;
		margin-top: 5px;
		margin-bottom: 5px;
	}

	.tooth-details {
		border: 1px solid #eee;
	}

	.tooth-details img {
		height: 200px;
		width: 60px;
	}

	.extracted {
		position: absolute;
		width: 30px;
	}
</style>

<div class="table-responsive" class="col-md-12">
	<div class="col-md-6 chart">
		<div>
			<img src="/img/dental-chart/18.gif">
			<img class="extracted" style="left:16px;" src="/img/dental-chart/extracted.gif">
			<img src="/img/dental-chart/17.gif">
			<img class="extracted" style="left:58px;" src="/img/dental-chart/extracted.gif">
			<img src="/img/dental-chart/16.gif">
			<img src="/img/dental-chart/15.gif">
			<img src="/img/dental-chart/14.gif">
			<img src="/img/dental-chart/13.gif">
			<img src="/img/dental-chart/12.gif">
			<img src="/img/dental-chart/11.gif">
			
			<img class="vl" src="/img/dental-chart/21.gif">
			<img src="/img/dental-chart/22.gif">
			<img src="/img/dental-chart/23.gif">
			<img src="/img/dental-chart/24.gif">
			<img src="/img/dental-chart/25.gif">
			<img src="/img/dental-chart/26.gif">
			<img src="/img/dental-chart/27.gif">
			<img src="/img/dental-chart/28.gif">
		</div>
		<div>
			<div class="tooth-number tooth-no-selected" data-tooth-no="18">18</div>
			<div class="tooth-number" data-tooth-no="17">17</div>
			<div class="tooth-number" data-tooth-no="16">16</div>
			<div class="tooth-number" data-tooth-no="15">15</div>
			<div class="tooth-number" data-tooth-no="14">14</div>
			<div class="tooth-number" data-tooth-no="13">13</div>
			<div class="tooth-number" data-tooth-no="12">12</div>
			<div class="tooth-number" data-tooth-no="11">11</div>

			<div class="tooth-number" data-tooth-no="21">21</div>
			<div class="tooth-number" data-tooth-no="22">22</div>
			<div class="tooth-number" data-tooth-no="23">23</div>
			<div class="tooth-number" data-tooth-no="24">24</div>
			<div class="tooth-number" data-tooth-no="25">25</div>
			<div class="tooth-number" data-tooth-no="26">26</div>
			<div class="tooth-number" data-tooth-no="27">27</div>
			<div class="tooth-number" data-tooth-no="28">28</div>
		</div>
		<div class="hl"></div>
		<div>
			<div class="tooth-number" data-tooth-no="48">48</div>
			<div class="tooth-number" data-tooth-no="47">47</div>
			<div class="tooth-number" data-tooth-no="46">46</div>
			<div class="tooth-number" data-tooth-no="45">45</div>
			<div class="tooth-number" data-tooth-no="44">44</div>
			<div class="tooth-number" data-tooth-no="43">43</div>
			<div class="tooth-number" data-tooth-no="42">42</div>
			<div class="tooth-number" data-tooth-no="41">41</div>

			<div class="tooth-number" data-tooth-no="31">31</div>
			<div class="tooth-number" data-tooth-no="32">32</div>
			<div class="tooth-number" data-tooth-no="33">33</div>
			<div class="tooth-number" data-tooth-no="34">34</div>
			<div class="tooth-number" data-tooth-no="35">35</div>
			<div class="tooth-number" data-tooth-no="36">36</div>
			<div class="tooth-number" data-tooth-no="37">37</div>
			<div class="tooth-number" data-tooth-no="38">38</div>
		</div>
		<div>
			<img src="/img/dental-chart/48.gif">
			<img src="/img/dental-chart/47.gif">
			<img src="/img/dental-chart/46.gif">
			<img src="/img/dental-chart/45.gif">
			<img src="/img/dental-chart/44.gif">
			<img src="/img/dental-chart/43.gif">
			<img src="/img/dental-chart/42.gif">
			<img src="/img/dental-chart/41.gif">

			<img class="vl" src="/img/dental-chart/31.gif">
			<img src="/img/dental-chart/32.gif">
			<img src="/img/dental-chart/33.gif">
			<img src="/img/dental-chart/34.gif">
			<img src="/img/dental-chart/35.gif">
			<img src="/img/dental-chart/36.gif">
			<img src="/img/dental-chart/37.gif">
			<img src="/img/dental-chart/38.gif">
		</div>

	</div>

	<div class="col-md-2">
		Details:<br>
		<div class="tooth-details text-center">
			<img id="selected-tooth" class="hidden">
		</div>
	</div>
</div>




<script type="text/javascript">
$(document).ready(function() {
	$(".tooth-number").unbind().click(function(){
		$("#selected-tooth").attr('src', '/img/dental-chart/' + $(this).data('tooth-no') + '.gif');
		$("#selected-tooth").removeClass('hidden');
	});
});
</script>