@extends('layouts.app')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>
@endsection

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
		/*cursor: pointer;*/
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
	  background-color: #fff; /*  #ffebcc */
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
                	<h4 class="section">Patient Information</h4>
	            	<div class="row">
	            		<div class="col-md-12">
		            		<div class="col-md-3">
				        		<select name="patient_id" class='form-control'>
				        			<option value='' disabled>Select Patient</option>
				        			@foreach($patients as $patient)
				        			<option value="{{ $patient->id }}">{{ $patient->fullname }}</option>
				        			@endforeach
				        		</select>
		            		</div>
		            		<div class="col-md-2">
		            			<button id="select-patient" class="btn btn-primary"><i class="fa fa-search"></i> View</button>
		            		</div>
	            		</div>
		        	</div>
		        	<h4 class="section">Dental Chart</h4>
                    <div class="table-responsive">
						<div class="chart">
							@if($patient_name)
							Patient Name: {{ $patient_name->first_name }} {{ $patient_name->last_name }}
							@endif
							<div class="upper-jaw-root">
								<img class="root" src="/img/dental-chart/18_root.gif">
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
								<img class="crown" src="/img/dental-chart/18_crown.gif">
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

							<!-- <div class="upper-jaw-filling">
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
							</div> -->
							<div class="upper-jaw-tooth-no">
								<div class="tooth-number {{ in_array(18, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="18">18</div>
								<div class="tooth-number {{ in_array(17, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="17">17</div>
								<div class="tooth-number {{ in_array(16, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="16">16</div>
								<div class="tooth-number {{ in_array(15, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="15">15</div>
								<div class="tooth-number {{ in_array(14, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="14">14</div>
								<div class="tooth-number {{ in_array(13, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="13">13</div>
								<div class="tooth-number {{ in_array(12, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="12">12</div>
								<div class="tooth-number {{ in_array(11, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="11">11</div>

								<div class="tooth-number {{ in_array(21, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="21">21</div>
								<div class="tooth-number {{ in_array(22, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="22">22</div>
								<div class="tooth-number {{ in_array(23, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="23">23</div>
								<div class="tooth-number {{ in_array(24, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="24">24</div>
								<div class="tooth-number {{ in_array(25, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="25">25</div>
								<div class="tooth-number {{ in_array(26, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="26">26</div>
								<div class="tooth-number {{ in_array(27, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="27">27</div>
								<div class="tooth-number {{ in_array(28, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="28">28</div>
							</div>
							<div class="hl"></div>
							<div class="lower-jaw-tooth-no">
								<div class="tooth-number {{ in_array(48, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="48">48</div>
								<div class="tooth-number {{ in_array(47, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="47">47</div>
								<div class="tooth-number {{ in_array(46, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="46">46</div>
								<div class="tooth-number {{ in_array(45, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="45">45</div>
								<div class="tooth-number {{ in_array(44, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="44">44</div>
								<div class="tooth-number {{ in_array(43, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="43">43</div>
								<div class="tooth-number {{ in_array(42, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="42">42</div>
								<div class="tooth-number {{ in_array(41, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="41">41</div>

								<div class="tooth-number {{ in_array(31, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="31">31</div>
								<div class="tooth-number {{ in_array(32, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="32">32</div>
								<div class="tooth-number {{ in_array(33, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="33">33</div>
								<div class="tooth-number {{ in_array(34, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="34">34</div>
								<div class="tooth-number {{ in_array(35, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="35">35</div>
								<div class="tooth-number {{ in_array(36, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="36">36</div>
								<div class="tooth-number {{ in_array(37, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="37">37</div>
								<div class="tooth-number {{ in_array(38, $tooth_numbers) ? 'tooth-no-selected' : '' }}" data-tooth-no="38">38</div>
							</div>
							<!-- <div class="lower-jaw-filling">
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
							</div> -->
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
						</div>
					</div>
					<h4 class="section">Diagnosis and Treatment</h4>
					<div class="col-md-12">
						<button id="create-record" class="btn btn-primary"><i class="fa fa-plus"></i> Add Record</button>
						<br>
						@if($patient_name)
						<br>
						Patient Name: {{ $patient_name->first_name }} {{ $patient_name->last_name }}
						@endif
						<br>
						<div class="table-responsive">
							<table id="record-list" class="table table-striped">
								<tr>
									<th>Tooth</th>
									<th>Diagnosis</th>
									<th>Treatment</th>
									<th>Price</th>
									<th class="text-right">Action</th>
								</tr>

								@if(count($dental_records) > 0)
									@foreach($dental_records as $dental_record)
									<tr>
										<td>{{ $dental_record->tooth_number }}</td>
										<td>{{ $dental_record->diagnosis }}</td>
										<td>{{ $dental_record->treatment }}</td>
										<td>{{ $dental_record->price }}</td>
										<td class="text-right">
											<a class="delete-record {{ App\Model\FeatureUser::is_feature_allowed('delete_patient_charge', Auth::user()->id) }}" data-dental-id="{{ $dental_record->id }}">
												<i class="fa fa-trash-o" aria-hidden="true"></i>
											</a>
										</td>
									</tr>
									@endforeach
								@else
									<tr>
										<td class="text-center" colspan=5>No Record found.</td>
									</tr>
								@endif
							</table>
						</div>
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

	$("#select-patient").click(function(){
		location.href = '/dental_chart?patient_id=' + $("select[name='patient_id']").val();
	});

	$("#create-record").click(function(){
		$("#record-list").append("<tr id='new-record'> \
			<td> \
			<select name='tooth-number' class='form-control'> \
				<option value='18'>18</option> \
				<option value='17'>17</option> \
				<option value='16'>16</option> \
				<option value='15'>15</option> \
				<option value='14'>14</option> \
				<option value='13'>13</option> \
				<option value='12'>12</option> \
				<option value='11'>11</option> \
				<option value='21'>21</option> \
				<option value='22'>22</option> \
				<option value='23'>23</option> \
				<option value='24'>24</option> \
				<option value='25'>25</option> \
				<option value='26'>26</option> \
				<option value='27'>27</option> \
				<option value='28'>28</option> \
				<option value='48'>48</option> \
				<option value='47'>47</option> \
				<option value='46'>46</option> \
				<option value='45'>45</option> \
				<option value='44'>44</option> \
				<option value='43'>43</option> \
				<option value='42'>42</option> \
				<option value='41'>41</option> \
				<option value='31'>31</option> \
				<option value='32'>32</option> \
				<option value='33'>33</option> \
				<option value='34'>34</option> \
				<option value='35'>35</option> \
				<option value='36'>36</option> \
				<option value='37'>37</option> \
				<option value='38'>38</option> \
			</select> \
			</td> \
			<td><textarea name='diagnosis' rows='4' class='form-control'></textarea></td> \
			<td><textarea name='treatment' rows='4' class='form-control'></textarea></td> \
			<td><input name='price' type='text' class='form-control'></input></td> \
			<td class='text-right'> \
				<a class='save-record'>Save</a> | <a class='cancel-record'>Cancel</a> \
			</td> \
		</tr>");
	});

	$(document).on('click', '.save-record', function(){ 
		var patient_id = $("select[name='patient_id']").val();
	    var tooth_number = $("select[name='tooth-number']").val();
	    var diagnosis = $("textarea[name='diagnosis']").val();
	    var treatment = $("textarea[name='treatment']").val();
	    var price = $("input[name='price']").val();

	    if (tooth_number != '' && diagnosis != '' && treatment != '' && price != '') {
	    	$.ajax({
	          method: "POST",
	          url: "/dental_chart",
	          data: { 
	          	patient_id: patient_id,
	          	tooth_number: tooth_number,
	          	diagnosis: diagnosis,
	          	treatment: treatment,
	          	price: price,
	            _token: "{{ csrf_token() }}" 
	          }
	        })
	        .done(function( msg ) {
	          Swal.fire(
	            'Saved!',
	            'Record has been saved.',
	            'success'
	          ).then((result) => {
	            location.reload();
	          });
	        });
	    }
	});

	$(document).on('click', '.cancel-record', function(){ 
	    $("#new-record").remove();
	});

	$('.delete-record').unbind().click(function(){
		var id = $(this).data('dental-id');

	    Swal.fire({
	      title: 'Are you sure?',
	      text: "You won't be able to revert this!",
	      type: 'warning',
	      showCancelButton: true,
	      confirmButtonColor: '#3085d6',
	      cancelButtonColor: '#d33',
	      confirmButtonText: 'Yes, delete it!'
	    }).then((result) => {
	      if (result.value) {
	        $.ajax({
	          method: "DELETE",
	          url: "/dental_chart/" + id,
	          data: { 
	            _token: "{{ csrf_token() }}" 
	          }
	        })
	        .done(function( msg ) {
	          Swal.fire(
	            'Deleted!',
	            'Record has been deleted.',
	            'success'
	          ).then((result) => {
	            location.reload();
	          });
	        });
	      }
	    })
	});
});
</script>
@endsection