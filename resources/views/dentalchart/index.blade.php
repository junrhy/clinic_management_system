@extends('layouts.app')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>
@endsection

@section('page_level_css')
<style type="text/css">
	.required-textfield {
		border: 1px solid red;
	}

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
		padding:2px;
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
	  border-top: 6px solid #fff;
	  border-right: 6px solid #fff;
	  border-bottom: 6px solid #fff;
	  border-left: 6px solid #fff;
	  background-color: #fff;
	  border-radius:50%;
	  height:40px;
	  width:40px;
	  margin-left: 2px;
	  margin-right: 3px;
	  display: inline-block;
	}

	.filling-top {
		border-top: 6px solid #ffebcc;
	}

	.filling-right {
		border-right: 6px solid #ffebcc;
	}

	.filling-bottom {
		border-bottom: 6px solid #ffebcc;
	}

	.filling-left {
		border-left: 6px solid #ffebcc;
	}

	.filling-center {
		background-color: #ffebcc;
	}

	.upper-jaw-root, .lower-jaw-root {
		background-color:#ffe6e6; 
	}

	.section {
		border-bottom: 1px dashed #01d8da;
		color: #01d8da;
		padding: 5px;
	}

	.link:hover {
		text-decoration: none;
	}

	.delete-record, .delete-record:hover {
		cursor: pointer;
		text-decoration: none;
		color: red;
	}

	.save-record, .save-record:hover {
		cursor: pointer;
		text-decoration: none;
		color: #01d8da;
	}

	.cancel-record, .cancel-record:hover {
		cursor: pointer;
		text-decoration: none;
		color: red;
	}

	#tooth-option {
		margin-top: 2px;
		padding: 2px;
		width: 120px;
		border:1px solid #ffe6e6;
		border-radius: 5px;
	}

	.sign-option {
		width: 50px;
		height: 44px;
		margin: 2px;
		display: inline-block;
		cursor: pointer;
		border:1px solid #ffffff;
	}

	.sign-selected {
		background-color: #efffff;
		border-color: #01d8da;
	}

	.sign-holder {
		height:40px;
		width:40px;
		margin-left: 2px;
		margin-right: 3px;
		text-align: center;
	}

	img.sign {
		height: 30px;
		width: 30px;
		position: relative;
		top: 6px;
		left: 3px;
	}

	.no-display {
		display: none;
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
                        <h2>Dental Record <small class="text-muted">Patient Dental Record</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item">Patient</li>
                            <li class="breadcrumb-item active">Dental Record</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Dental Record</div>

                <div class="panel-body">
                	<h4 class="col-md-12 section">Patient Name</h4>
	            	<div class="row col-md-12">
	            		<div class="col-md-2">
			        		<select name="patient_id" class='form-control'>
			        			<option value='' disabled>Select Patient</option>
			        			@foreach($patients as $patient)
			        			<option value="{{ $patient->id }}">{{ $patient->fullname }}</option>
			        			@endforeach
			        		</select>
	            		</div>
		        	</div>
		        	<h4 class="col-md-12 section">Dental Chart</h4>
                    <div class="col-md-12 table-responsive">
                    	<table>
                    	<tr>
                    	<td>
							<div class="chart">
								<div class="upper-jaw-root">
									<img class="root" id="tooth-root-18" src="/img/dental-chart/18_root.gif">
									<img class="root" id="tooth-root-17" src="/img/dental-chart/17_root.gif">
									<img class="root" id="tooth-root-16" src="/img/dental-chart/16_root.gif">
									<img class="root" id="tooth-root-15" src="/img/dental-chart/15_root.gif">
									<img class="root" id="tooth-root-14" src="/img/dental-chart/14_root.gif">
									<img class="root" id="tooth-root-13" src="/img/dental-chart/13_root.gif">
									<img class="root" id="tooth-root-12" src="/img/dental-chart/12_root.gif">
									<img class="root" id="tooth-root-11" src="/img/dental-chart/11_root.gif">
									
									<img class="root vl" id="tooth-root-21" src="/img/dental-chart/21_root.gif">
									<img class="root" id="tooth-root-22" src="/img/dental-chart/22_root.gif">
									<img class="root" id="tooth-root-23" src="/img/dental-chart/23_root.gif">
									<img class="root" id="tooth-root-24" src="/img/dental-chart/24_root.gif">
									<img class="root" id="tooth-root-25" src="/img/dental-chart/25_root.gif">
									<img class="root" id="tooth-root-26" src="/img/dental-chart/26_root.gif">
									<img class="root" id="tooth-root-27" src="/img/dental-chart/27_root.gif">
									<img class="root" id="tooth-root-28" src="/img/dental-chart/28_root.gif">
								</div>
								<div class="upper-jaw-crown">
									<img class="crown" id="tooth-crown-18" src="/img/dental-chart/18_crown.gif">
									<img class="crown" id="tooth-crown-17" src="/img/dental-chart/17_crown.gif">
									<img class="crown" id="tooth-crown-16" src="/img/dental-chart/16_crown.gif">
									<img class="crown" id="tooth-crown-15" src="/img/dental-chart/15_crown.gif">
									<img class="crown" id="tooth-crown-14" src="/img/dental-chart/14_crown.gif">
									<img class="crown" id="tooth-crown-13" src="/img/dental-chart/13_crown.gif">
									<img class="crown" id="tooth-crown-12" src="/img/dental-chart/12_crown.gif">
									<img class="crown" id="tooth-crown-11" src="/img/dental-chart/11_crown.gif">
									
									<img class="crown vl" id="tooth-crown-21" src="/img/dental-chart/21_crown.gif">
									<img class="crown" id="tooth-crown-22" src="/img/dental-chart/22_crown.gif">
									<img class="crown" id="tooth-crown-23" src="/img/dental-chart/23_crown.gif">
									<img class="crown" id="tooth-crown-24" src="/img/dental-chart/24_crown.gif">
									<img class="crown" id="tooth-crown-25" src="/img/dental-chart/25_crown.gif">
									<img class="crown" id="tooth-crown-26" src="/img/dental-chart/26_crown.gif">
									<img class="crown" id="tooth-crown-27" src="/img/dental-chart/27_crown.gif">
									<img class="crown" id="tooth-crown-28" src="/img/dental-chart/28_crown.gif">
								</div>

								<div class="upper-jaw-filling">
									<div class="filling" id="filling-tooth-18">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
									<div class="filling" id="filling-tooth-17">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
									<div class="filling" id="filling-tooth-16">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
									<div class="filling" id="filling-tooth-15">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
									<div class="filling" id="filling-tooth-14">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
									<div class="filling" id="filling-tooth-13">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
									<div class="filling" id="filling-tooth-12">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
									<div class="filling" id="filling-tooth-11">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
									
									<div class="filling" id="filling-tooth-21">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
									<div class="filling" id="filling-tooth-22">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
									<div class="filling" id="filling-tooth-23">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
									<div class="filling" id="filling-tooth-24">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
									<div class="filling" id="filling-tooth-25">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
									<div class="filling" id="filling-tooth-26">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
									<div class="filling" id="filling-tooth-27">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
									<div class="filling" id="filling-tooth-28">
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
									<div class="filling" id="filling-tooth-48">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
									<div class="filling" id="filling-tooth-47">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
									<div class="filling" id="filling-tooth-46">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
									<div class="filling" id="filling-tooth-45">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
									<div class="filling" id="filling-tooth-44">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
									<div class="filling" id="filling-tooth-43">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
									<div class="filling" id="filling-tooth-42">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
									<div class="filling" id="filling-tooth-41">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
									
									<div class="filling" id="filling-tooth-31">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
									<div class="filling" id="filling-tooth-32">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
									<div class="filling" id="filling-tooth-33">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
									<div class="filling" id="filling-tooth-34">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
									<div class="filling" id="filling-tooth-35">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
									<div class="filling" id="filling-tooth-36">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
									<div class="filling" id="filling-tooth-37">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
									<div class="filling" id="filling-tooth-38">
										<img class="filling-none" src="/img/dental-chart/filling_none.gif">
									</div>
								</div>
								<div class="lower-jaw-crown">
									<img class="crown"  id="tooth-crown-48" src="/img/dental-chart/48_crown.gif">
									<img class="crown"  id="tooth-crown-47" src="/img/dental-chart/47_crown.gif">
									<img class="crown"  id="tooth-crown-46" src="/img/dental-chart/46_crown.gif">
									<img class="crown"  id="tooth-crown-45" src="/img/dental-chart/45_crown.gif">
									<img class="crown"  id="tooth-crown-44" src="/img/dental-chart/44_crown.gif">
									<img class="crown"  id="tooth-crown-43" src="/img/dental-chart/43_crown.gif">
									<img class="crown"  id="tooth-crown-42" src="/img/dental-chart/42_crown.gif">
									<img class="crown"  id="tooth-crown-41" src="/img/dental-chart/41_crown.gif">
									
									<img class="crown vl" id="tooth-crown-31" src="/img/dental-chart/31_crown.gif">
									<img class="crown" id="tooth-crown-32" src="/img/dental-chart/32_crown.gif">
									<img class="crown" id="tooth-crown-33" src="/img/dental-chart/33_crown.gif">
									<img class="crown" id="tooth-crown-34" src="/img/dental-chart/34_crown.gif">
									<img class="crown" id="tooth-crown-35" src="/img/dental-chart/35_crown.gif">
									<img class="crown" id="tooth-crown-36" src="/img/dental-chart/36_crown.gif">
									<img class="crown" id="tooth-crown-37" src="/img/dental-chart/37_crown.gif">
									<img class="crown" id="tooth-crown-38" src="/img/dental-chart/38_crown.gif">
								</div>
								<div class="lower-jaw-root">
									<img class="root" id="tooth-root-48" src="/img/dental-chart/48_root.gif">
									<img class="root" id="tooth-root-47" src="/img/dental-chart/47_root.gif">
									<img class="root" id="tooth-root-46" src="/img/dental-chart/46_root.gif">
									<img class="root" id="tooth-root-45" src="/img/dental-chart/45_root.gif">
									<img class="root" id="tooth-root-44" src="/img/dental-chart/44_root.gif">
									<img class="root" id="tooth-root-43" src="/img/dental-chart/43_root.gif">
									<img class="root" id="tooth-root-42" src="/img/dental-chart/42_root.gif">
									<img class="root" id="tooth-root-41" src="/img/dental-chart/41_root.gif">
									
									<img class="root vl" id="tooth-root-31" src="/img/dental-chart/31_root.gif">
									<img class="root" id="tooth-root-32" src="/img/dental-chart/32_root.gif">
									<img class="root" id="tooth-root-33" src="/img/dental-chart/33_root.gif">
									<img class="root" id="tooth-root-34" src="/img/dental-chart/34_root.gif">
									<img class="root" id="tooth-root-35" src="/img/dental-chart/35_root.gif">
									<img class="root" id="tooth-root-36" src="/img/dental-chart/36_root.gif">
									<img class="root" id="tooth-root-37" src="/img/dental-chart/37_root.gif">
									<img class="root" id="tooth-root-38" src="/img/dental-chart/38_root.gif">
								</div>
							</div>
						</td>
						<td valign="top">
							<div id="tooth-option" class="no-display">
								<input type="hidden" name="current-tooth-no-selected">
								<div class="sign-option" data-attribute="filling-top">
									<div class="sign-holder" style="padding-top: 1px;position: relative;left: -1px;">
										<div class="filling filling-top">
											<img class="filling-none" src="/img/dental-chart/filling_none.gif">
										</div>
									</div>
								</div>

								<div class="sign-option" data-attribute="filling-left">
									<div class="sign-holder" style="padding-top: 1px;position: relative;left: -1px;">
										<div class="filling filling-left">
											<img class="filling-none" src="/img/dental-chart/filling_none.gif">
										</div>
									</div>
								</div>

								<div class="sign-option" data-attribute="filling-bottom" style="position: relative;top: 1px;">
									<div class="sign-holder" style="padding-top: 1px;position: relative;left: -1px;">
										<div class="filling filling-bottom">
											<img class="filling-none" src="/img/dental-chart/filling_none.gif">
										</div>
									</div>
								</div>

								<div class="sign-option" data-attribute="filling-right" style="position: relative;top: 1px;">
									<div class="sign-holder" style="padding-top: 1px;position: relative;left: -1px;">
										<div class="filling filling-right">
											<img class="filling-none" src="/img/dental-chart/filling_none.gif">
										</div>
									</div>
								</div>

								<div class="sign-option" data-attribute="filling-center" style="position: relative;top: 2px;">
									<div class="sign-holder" style="padding-top: 1px;position: relative;left: -1px;">
										<div class="filling filling-center">
											<img class="filling-none" src="/img/dental-chart/filling_none.gif">
										</div>
									</div>
								</div>

								<div class="sign-option" data-attribute="add-x" style="position: relative;top: -18px;">
									<div class="sign-holder">
										<img class="sign" src="/img/dental-chart/x.png">
									</div>
								</div>
								
								<div class="sign-option" data-attribute="add-circle" style="position: relative;top: -16px;">
									<div class="sign-holder">
									  	<img class="sign" src="/img/dental-chart/circle.png">
									</div>
								</div>
<!-- 
								<div class="sign-option sign-selected" style="position: relative;top: -16px;">
									<div class="sign-holder">
									  	<img class="sign" src="/img/dental-chart/hline.png">
									</div>
								</div> -->

								<div class="sign-option" data-attribute="add-vline" style="position: relative;top: -15px;">
									<div class="sign-holder">
									  	<img class="sign" src="/img/dental-chart/vline.png">
									</div>
								</div>

			<!-- 					<div class="sign-option sign-selected" style="position: relative;top: -15px;">
									<div class="sign-holder">
									  	<img class="sign" src="/img/dental-chart/backslash.png">
									</div>
								</div>

								<div class="sign-option sign-selected" style="position: relative;top: -14px;">
									<div class="sign-holder">
									  	<img class="sign" src="/img/dental-chart/slash.png">
									</div>
								</div> -->
							</div>
						</td>
						</tr>	
                    	</table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_level_footer_script')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

<script type="text/javascript">
$(document).ready(function() {
	$('select[name=patient_id]').val("{{ isset($_GET['patient_id']) ? $_GET['patient_id'] : '' }}");

	$("select[name=patient_id]").on('change', function(){
		location.href = '/dental_chart?patient_id=' + $(this).val();
	});

	$('.tooth-number').unbind().click(function(e){
		e.stopPropagation();

		if ($('select[name=patient_id]').val() == null) {
			$('select[name=patient_id]').addClass('required-textfield');
			return false;
		}

		$('select[name=patient_id]').removeClass('required-textfield');
		$('.tooth-number').removeClass('tooth-no-selected');
		$(".sign-option").removeClass('sign-selected');
		$(this).addClass('tooth-no-selected');

		if ($('#tooth-option').hasClass('no-display')) {
			$('#tooth-option').removeClass('no-display');
		}
		
		$('#tooth-option').hide();
		setTimeout(function(){jQuery('#tooth-option').fadeIn('show')}, 200);

		var tooth_number = $(this).data('tooth-no');

		$.ajax({
			method: "POST",
			url: "/dental_chart/get_attributes",
			data: { 
				tooth_number: tooth_number,
				patient_id: "{{ $patient_id }}",
				_token: "{{ csrf_token() }}" 
			}
        })
        .done(function( data ) {
        	$.each(data, function(i, item) {
				$('.sign-option[data-attribute="'+data[i].attribute+'"]').addClass('sign-selected');
			});
        });

        $('input[name=current-tooth-no-selected]').val(tooth_number);
	});

	$(document).click(function() {
		$('.tooth-number').removeClass('tooth-no-selected');
		$(".sign-option").removeClass('sign-selected');
	    $('#tooth-option').addClass('no-display');
	    setTimeout(function(){jQuery('#tooth-option').fadeOut('show')}, 200);
	    $('input[name=current-tooth-no-selected]').val("");
	});

	$(".sign-option").unbind().click(function(e){
		e.stopPropagation();

		var tooth_number = $('input[name=current-tooth-no-selected]').val();
		var attribute = $(this).data('attribute');
		var is_apply = "no";

		// filling
		if (attribute.substring(0, 7) == "filling") {
			if ($("#filling-tooth-"+tooth_number).hasClass(attribute)) {
				$("#filling-tooth-"+tooth_number).removeClass(attribute);
				$(this).removeClass('sign-selected');
				is_apply = "no";
			} else {
				$("#filling-tooth-"+tooth_number).addClass(attribute);
				$(this).addClass('sign-selected');
				is_apply = "yes";
			}
		}

		// x sign
		if (attribute.substring(0, 5) == "add-x") {
			$('.sign-option[data-attribute="add-vline"]').removeClass('sign-selected');

			if ($("#tooth-root-"+tooth_number).attr('src') == "/img/dental-chart/"+tooth_number+"_root_missing.gif") {
				$("#tooth-root-"+tooth_number).attr('src', "/img/dental-chart/"+tooth_number+"_root.gif");
				$("#tooth-crown-"+tooth_number).attr('src', "/img/dental-chart/"+tooth_number+"_crown.gif");
				$(this).removeClass('sign-selected');
				is_apply = "no";
			} else {
				$("#tooth-root-"+tooth_number).attr('src', "/img/dental-chart/"+tooth_number+"_root_missing.gif");
				$("#tooth-crown-"+tooth_number).attr('src', "/img/dental-chart/"+tooth_number+"_crown.gif");
				$(this).addClass('sign-selected');
				is_apply = "yes";
			}
		}

		// vline
		if (attribute.substring(0, 9) == "add-vline") {
			$('.sign-option[data-attribute="add-x"]').removeClass('sign-selected');

			if ($("#tooth-root-"+tooth_number).attr('src') == "/img/dental-chart/"+tooth_number+"_root_remove.png") {
				$("#tooth-root-"+tooth_number).attr('src', "/img/dental-chart/"+tooth_number+"_root.gif");
				$("#tooth-crown-"+tooth_number).attr('src', "/img/dental-chart/"+tooth_number+"_crown.gif");
				$(this).removeClass('sign-selected');
				is_apply = "no";
			} else {
				$("#tooth-root-"+tooth_number).attr('src', "/img/dental-chart/"+tooth_number+"_root_remove.png");
				$("#tooth-crown-"+tooth_number).attr('src', "/img/dental-chart/"+tooth_number+"_crown_remove.png");
				$(this).addClass('sign-selected');
				is_apply = "yes";
			}
		}
		
		$.ajax({
			method: "POST",
			url: "/dental_chart/update_attribute",
			data: { 
				tooth_number: tooth_number,
				attribute: attribute,
				is_apply: is_apply,
				patient_id: "{{ $patient_id }}",
				_token: "{{ csrf_token() }}" 
			}
        });
	});

	$(function(){
		get_patient_attributes();
	});

	function get_patient_attributes() {
		$.ajax({
			method: "POST",
			url: "/dental_chart/get_patient_attributes",
			data: { 
				patient_id: "{{ $patient_id }}",
				_token: "{{ csrf_token() }}" 
			}
        })
        .done(function( data ) {
        	$.each(data, function(i, item) {
				if (data[i].attribute.substring(0, 7) == "filling") {
					$('#filling-tooth-'+data[i].tooth_number).addClass(data[i].attribute);
				}

				if (data[i].attribute.substring(0, 5) == "add-x") {
					$("#tooth-root-"+data[i].tooth_number).attr('src', "/img/dental-chart/"+data[i].tooth_number+"_root_missing.gif");
				}

				if (data[i].attribute.substring(0, 9) == "add-vline") {
					$("#tooth-root-"+data[i].tooth_number).attr('src', "/img/dental-chart/"+data[i].tooth_number+"_root_remove.png");
					$("#tooth-crown-"+data[i].tooth_number).attr('src', "/img/dental-chart/"+data[i].tooth_number+"_crown_remove.png");
				}
			});
        });
	}
});
</script>
@endsection