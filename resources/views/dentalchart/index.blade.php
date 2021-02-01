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

	.crown-container {
		position: relative;
		height: 40px; 
		width: 45px;
		display: inline-block;
	}

	.root-container {
		position: relative;
		height: 62px; 
		width: 45px;
		display: inline-block;
	}

	.sign-overlay {
		position: absolute;
		left: 0px;
		top: 0px;
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
									@for ($i = 18; $i >= 11; $i--)
										<div class="root-container">
									   		<img class="root" id="tooth-root-{{ $i }}" src="/img/dental-chart/{{ $i }}_root.gif">
									   		<img class="root sign-overlay" id="tooth-root-{{ $i }}-sign" src="/img/dental-chart/default_root.gif">
										</div>
									@endfor

									@for ($i = 21; $i <= 28; $i++)
										<div class="root-container">
									    	<img class="root {{ $i == '21' ? 'vl' : '' }}" id="tooth-root-{{ $i }}" src="/img/dental-chart/{{ $i }}_root.gif">
									    	<img class="root sign-overlay" id="tooth-root-{{ $i }}-sign" src="/img/dental-chart/default_root.gif">
								    	</div>
									@endfor
								</div>
								<div class="upper-jaw-crown">
									@for ($i = 18; $i >= 11; $i--)
										<div class="crown-container">
									   		<img class="crown" id="tooth-crown-{{ $i }}" src="/img/dental-chart/{{ $i }}_crown.gif">
									   		<img class="crown sign-overlay" id="tooth-crown-{{ $i }}-sign" src="/img/dental-chart/default_crown.gif">
										</div>
									@endfor

									@for ($i = 21; $i <= 28; $i++)
										<div class="crown-container">
									    	<img class="crown {{ $i == '21' ? 'vl' : '' }}" id="tooth-crown-{{ $i }}" src="/img/dental-chart/{{ $i }}_crown.gif">
									    	<img class="crown sign-overlay" id="tooth-crown-{{ $i }}-sign" src="/img/dental-chart/default_crown.gif">
								    	</div>
									@endfor
								</div>

								<div class="upper-jaw-filling">
									@for ($i = 18; $i >= 11; $i--)
										<div class="filling" id="filling-tooth-{{ $i }}">
											<img class="filling-none" src="/img/dental-chart/filling_none.gif">
										</div>
									@endfor

									@for ($i = 21; $i <= 28; $i++)
										<div class="filling" id="filling-tooth-{{ $i }}">
											<img class="filling-none" src="/img/dental-chart/filling_none.gif">
										</div>
									@endfor
								</div>
								<div class="upper-jaw-tooth-no">
									@for ($i = 18; $i >= 11; $i--)
										<div class="tooth-number" data-tooth-no="{{ $i }}">{{ $i }}</div>
									@endfor

									@for ($i = 21; $i <= 28; $i++)
										<div class="tooth-number" data-tooth-no="{{ $i }}">{{ $i }}</div>
									@endfor
								</div>
								<div class="hl"></div>
								<div class="lower-jaw-tooth-no">
									@for ($i = 48; $i >= 41; $i--)
										<div class="tooth-number" data-tooth-no="{{ $i }}">{{ $i }}</div>
									@endfor
									
									@for ($i = 31; $i <= 38; $i++)
										<div class="tooth-number" data-tooth-no="{{ $i }}">{{ $i }}</div>
									@endfor
								</div>
								<div class="lower-jaw-filling">
									@for ($i = 48; $i >= 41; $i--)
										<div class="filling" id="filling-tooth-{{ $i }}">
											<img class="filling-none" src="/img/dental-chart/filling_none.gif">
										</div>
									@endfor
									
									@for ($i = 31; $i <= 38; $i++)
										<div class="filling" id="filling-tooth-{{ $i }}">
											<img class="filling-none" src="/img/dental-chart/filling_none.gif">
										</div>
									@endfor
								</div>

								<div class="lower-jaw-crown">
									@for ($i = 48; $i >= 41; $i--)
										<div class="crown-container">
											<img class="crown" id="tooth-crown-{{ $i }}" src="/img/dental-chart/{{ $i }}_crown.gif">
											<img class="crown sign-overlay" id="tooth-crown-{{ $i }}-sign" src="/img/dental-chart/default_crown.gif">
										</div>
									@endfor

									@for ($i = 31; $i <= 38; $i++)
										<div class="crown-container">
										    <img class="crown {{ $i == '31' ? 'vl' : '' }}" id="tooth-crown-{{ $i }}" src="/img/dental-chart/{{ $i }}_crown.gif">
										    <img class="crown sign-overlay" id="tooth-crown-{{ $i }}-sign" src="/img/dental-chart/default_crown.gif">
									    </div>
									@endfor
								</div>
								<div class="lower-jaw-root">
									@for ($i = 48; $i >= 41; $i--)
										<div class="root-container">
									   		<img class="root" id="tooth-root-{{ $i }}" src="/img/dental-chart/{{ $i }}_root.gif">
									   		<img class="root sign-overlay" id="tooth-root-{{ $i }}-sign" src="/img/dental-chart/default_root.gif">
										</div>
									@endfor

									@for ($i = 31; $i <= 38; $i++)
										<div class="root-container">
									    	<img class="root {{ $i == '31' ? 'vl' : '' }}" id="tooth-root-{{ $i }}" src="/img/dental-chart/{{ $i }}_root.gif">
									    	<img class="root sign-overlay" id="tooth-root-{{ $i }}-sign" src="/img/dental-chart/default_root.gif">
								    	</div>
									@endfor
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
									  	<img class="sign" src="/img/dental-chart/slash.png">
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
@if( App\Model\FeatureUser::is_feature_allowed('dental', Auth::user()->id) == 'hidden' )
<div class="modalOverlay"></div>
@endif
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

		var element = $(this);
		var tooth_number = $('input[name=current-tooth-no-selected]').val();
		var attribute = $(this).data('attribute');
		var is_apply = "no";

		var option_x = $('.sign-option[data-attribute="add-x"]');
		var option_vline = $('.sign-option[data-attribute="add-vline"]');
		var option_circle = $('.sign-option[data-attribute="add-circle"]');


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
		if (attribute.indexOf("add-x") >= 0) {
			option_vline.removeClass('sign-selected');
			option_circle.removeClass('sign-selected');

			is_apply = apply_tooth_attribute(element, tooth_number, "x");
		}

		// vline
		if (attribute.indexOf("add-vline") >= 0) {
			option_x.removeClass('sign-selected');
			option_circle.removeClass('sign-selected');

			is_apply = apply_tooth_attribute(element, tooth_number, "vline");
		}

		// circle
		if (attribute.indexOf("add-circle") >= 0) {
			option_x.removeClass('sign-selected');
			option_vline.removeClass('sign-selected');

			is_apply = apply_tooth_attribute(element, tooth_number, "circle");
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

	function apply_tooth_attribute(element, tooth_number, attr, root_filename = "root.png", crown_filename = "crown.png", img_folder = "/img/dental-chart/"){
		var is_apply = "no";
		var default_root_img = "/img/dental-chart/default_root.gif";
		var default_crown_img = "/img/dental-chart/default_crown.gif";
		var root_sign_element = $("#tooth-root-"+tooth_number+"-sign");
		var crown_sign_element = $("#tooth-crown-"+tooth_number+"-sign");
		var root_src = $("#tooth-root-"+tooth_number+"-sign").attr('src');
		var crown_src = $("#tooth-crown-"+tooth_number+"-sign").attr('src');
		var upper_teeth_no = new Array(18, 17, 16, 15, 14, 13, 12, 11, 21, 22, 23, 24, 25, 26, 27, 28);
		var lower_teeth_no = new Array(48, 47, 46, 45, 44, 43, 42, 41, 31, 32, 33, 34, 35, 36, 37, 38);
		var jaw = "";

		if (upper_teeth_no.indexOf(parseInt(tooth_number)) != -1) { jaw = "_upper_"; }
		if(lower_teeth_no.indexOf(parseInt(tooth_number)) != -1) { jaw = "_lower_"; }

		if (root_src.indexOf(attr) >= 0) {
			root_src = default_root_img;
			crown_src = default_crown_img;

			element.removeClass('sign-selected');
			is_apply = "no";
		} else {
			root_src = img_folder + attr + jaw + root_filename;
			crown_src = img_folder + attr + jaw + crown_filename;

			element.addClass('sign-selected');
			is_apply = "yes";
		}

		root_sign_element.attr('src', root_src);
		crown_sign_element.attr('src', crown_src);

		return is_apply;
	}

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
        		var tooth_number = data[i].tooth_number;
        		var upper_teeth_no = new Array(18, 17, 16, 15, 14, 13, 12, 11, 21, 22, 23, 24, 25, 26, 27, 28);
				var lower_teeth_no = new Array(48, 47, 46, 45, 44, 43, 42, 41, 31, 32, 33, 34, 35, 36, 37, 38);
				var root_sign_element = $("#tooth-root-"+tooth_number+"-sign");
				var crown_sign_element = $("#tooth-crown-"+tooth_number+"-sign");
				var root_filename = "root.png";
				var crown_filename = "crown.png";
				var img_folder = "/img/dental-chart/";
				var jaw = "";

				if (upper_teeth_no.indexOf(parseInt(tooth_number)) != -1) { jaw = "_upper_"; }
				if(lower_teeth_no.indexOf(parseInt(tooth_number)) != -1) { jaw = "_lower_"; }

				// conditions
				if (data[i].attribute.indexOf("filling") != -1) {
					$('#filling-tooth-'+tooth_number).addClass(data[i].attribute);
				}

				if (data[i].attribute.indexOf("add-x") != -1) {
					var root_src = img_folder + "x" + jaw + root_filename;
					var crown_src = img_folder + "x" + jaw + crown_filename;

					root_sign_element.attr('src', root_src);
					crown_sign_element.attr('src', crown_src);
				}

				if (data[i].attribute.indexOf("add-vline") != -1) {
					var root_src = img_folder + "vline" + jaw + root_filename;
					var crown_src = img_folder + "vline" + jaw + crown_filename;

					root_sign_element.attr('src', root_src);
					crown_sign_element.attr('src', crown_src);
				}

				if (data[i].attribute.indexOf("add-circle") != -1) {
					var root_src = img_folder + "circle" + jaw + root_filename;
					var crown_src = img_folder + "circle" + jaw + crown_filename;

					root_sign_element.attr('src', root_src);
					crown_sign_element.attr('src', crown_src);
				}
			});
        });
	}
});
</script>
@endsection