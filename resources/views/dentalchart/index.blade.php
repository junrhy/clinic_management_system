@extends('layouts.app')

@section('page_level_css')
<style type="text/css">
	img.root {
		height: 62px;
		width: 45px;
	}

	img.crown {
		height: 40px;
		width: 45px;
	}

	img.filling-none {
		height: 56px;
		width: 56px;
		position: relative;
		top:-15px;
		left:-13px;
	}

	.upper-jaw-crown {
		position: relative;
		top: -1px;
	}


	.chart {
		background:#fff;
		width: 57em;
		padding:10px;
		margin-top: 30px;
	}

	.tooth-number {
		width: 30px;
		height:30px;
		background:#fff;
		display: inline-block;
		text-align: center;
		font-size: 12pt;
		margin:5px 7px 5px 8px;
		padding-top: 2px;
		border-radius: 50%;
		cursor: pointer;
	}

	.tooth-no-selected {
		background-color: #01d8da;
		color:#fff;
	}

	.vl {
	  	border-left: 1px solid #01d8da;
	}

	.hl {
		border-bottom: 1px solid #01d8da;
		margin-top: 5px;
		margin-bottom: 5px;
	}

	.tooth-details {
		border: 1px solid #eee;
	}

	.filling {
	  border-top: 6px solid #ffebcc;
	  border-right: 6px solid #ffebcc;
	  border-bottom: 6px solid #ffebcc;
	  border-left: 6px solid #fff;
	  background-color: #ffebcc;
	  border-radius:50%;
	  height:40px;
	  width:40px;
	  margin-left: 2px;
	  margin-right: 3px;
	  display: inline-block;
	}

	.upper-jaw-root, .lower-jaw-root {
		background-color:#ffe6e6; 
	}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>Dental Chart <small class="text-muted">Patient's Dental Chart</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item">Patient</li>
                            <li class="breadcrumb-item active">Dental Chart</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Dental Chart</div>

                <div class="panel-body">
                    <div class="table-responsive">
                    	<div class="col-md-6 text-center">
                    		<button class="btn btn-primary btn-round">Missing</button>
                    		<button class="btn btn-primary btn-round">For Extraction</button>
                    		<button class="btn btn-primary btn-round">Fill Left</button>
                    		<button class="btn btn-primary btn-round">Fill Right</button>
                    		<button class="btn btn-primary btn-round">Fill Top</button>
                    		<button class="btn btn-primary btn-round">Fill Bottom</button>
                    		<button class="btn btn-primary btn-round">Fill Center</button>
                    	</div>
						<div class="chart">
							<h3 class="text-center">Upper Jaw</h3>
							<div class="upper-jaw-root">
								<img class="root" src="/img/dental-chart/18_root_missing.gif">
								<img class="root" src="/img/dental-chart/17_root.gif">
								<img class="root" src="/img/dental-chart/16_root.gif">
								<img class="root" src="/img/dental-chart/15_root.gif">
								<img class="root" src="/img/dental-chart/14_root.gif">
								<img class="root" src="/img/dental-chart/13_root.gif">
								<img class="root" src="/img/dental-chart/12_root.gif">
								<img class="root" src="/img/dental-chart/11_root.gif">
								
								<img class="root vl" src="/img/dental-chart/21_root.gif">
								<img class="root" src="/img/dental-chart/22_root.gif">
								<img class="root" src="/img/dental-chart/23_root.gif">
								<img class="root" src="/img/dental-chart/24_root.gif">
								<img class="root" src="/img/dental-chart/25_root.gif">
								<img class="root" src="/img/dental-chart/26_root.gif">
								<img class="root" src="/img/dental-chart/27_root.gif">
								<img class="root" src="/img/dental-chart/28_root.gif">
							</div>
							<div class="upper-jaw-crown">
								<img class="crown" src="/img/dental-chart/18_crown_missing.gif">
								<img class="crown" src="/img/dental-chart/17_crown.gif">
								<img class="crown" src="/img/dental-chart/16_crown.gif">
								<img class="crown" src="/img/dental-chart/15_crown.gif">
								<img class="crown" src="/img/dental-chart/14_crown.gif">
								<img class="crown" src="/img/dental-chart/13_crown.gif">
								<img class="crown" src="/img/dental-chart/12_crown.gif">
								<img class="crown" src="/img/dental-chart/11_crown.gif">
								
								<img class="crown vl" src="/img/dental-chart/21_crown.gif">
								<img class="crown" src="/img/dental-chart/22_crown.gif">
								<img class="crown" src="/img/dental-chart/23_crown.gif">
								<img class="crown" src="/img/dental-chart/24_crown.gif">
								<img class="crown" src="/img/dental-chart/25_crown.gif">
								<img class="crown" src="/img/dental-chart/26_crown.gif">
								<img class="crown" src="/img/dental-chart/27_crown.gif">
								<img class="crown" src="/img/dental-chart/28_crown.gif">
							</div>

							<div class="upper-jaw-filling">
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
								
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
							</div>
							<div class="upper-jaw-tooth-no">
								<div class="tooth-number" data-tooth-no="18">18</div>
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
							<div class="lower-jaw-tooth-no">
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
							<div class="lower-jaw-filling">
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
								
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
								<div class="filling">
									<img class="filling-none" src="/img/dental-chart/filling_none.gif">
								</div>
							</div>
							<div class="lower-jaw-crown">
								<img class="crown" src="/img/dental-chart/48_crown.gif">
								<img class="crown" src="/img/dental-chart/47_crown.gif">
								<img class="crown" src="/img/dental-chart/46_crown.gif">
								<img class="crown" src="/img/dental-chart/45_crown.gif">
								<img class="crown" src="/img/dental-chart/44_crown.gif">
								<img class="crown" src="/img/dental-chart/43_crown.gif">
								<img class="crown" src="/img/dental-chart/42_crown.gif">
								<img class="crown" src="/img/dental-chart/41_crown.gif">
								
								<img class="crown vl" src="/img/dental-chart/31_crown.gif">
								<img class="crown" src="/img/dental-chart/32_crown.gif">
								<img class="crown" src="/img/dental-chart/33_crown.gif">
								<img class="crown" src="/img/dental-chart/34_crown.gif">
								<img class="crown" src="/img/dental-chart/35_crown.gif">
								<img class="crown" src="/img/dental-chart/36_crown.gif">
								<img class="crown" src="/img/dental-chart/37_crown.gif">
								<img class="crown" src="/img/dental-chart/38_crown.gif">
							</div>
							<div class="lower-jaw-root">
								<img class="root" src="/img/dental-chart/48_root.gif">
								<img class="root" src="/img/dental-chart/47_root.gif">
								<img class="root" src="/img/dental-chart/46_root.gif">
								<img class="root" src="/img/dental-chart/45_root.gif">
								<img class="root" src="/img/dental-chart/44_root.gif">
								<img class="root" src="/img/dental-chart/43_root.gif">
								<img class="root" src="/img/dental-chart/42_root.gif">
								<img class="root" src="/img/dental-chart/41_root.gif">
								
								<img class="root vl" src="/img/dental-chart/31_root.gif">
								<img class="root" src="/img/dental-chart/32_root.gif">
								<img class="root" src="/img/dental-chart/33_root.gif">
								<img class="root" src="/img/dental-chart/34_root.gif">
								<img class="root" src="/img/dental-chart/35_root.gif">
								<img class="root" src="/img/dental-chart/36_root.gif">
								<img class="root" src="/img/dental-chart/37_root.gif">
								<img class="root" src="/img/dental-chart/38_root.gif">
							</div>
							<h3 class="text-center">Lower Jaw</h3>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
	
</div>
@endsection

@section('page_level_footer_script')
<script type="text/javascript">
$(document).ready(function() {
	$(".tooth-number").unbind().click(function(){
		$("#selected-tooth").attr('src', '/img/dental-chart/' + $(this).data('tooth-no') + '.gif');
		$("#selected-tooth").removeClass('hidden');
	});
});
</script>
@endsection