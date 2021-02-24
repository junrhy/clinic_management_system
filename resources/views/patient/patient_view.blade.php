@extends('layouts.patient')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>
@endsection

@section('page_level_css')

<style type="text/css">
  .show_link, .print-link {
    font-size: 9pt;
    color: #008385;
    cursor: pointer;
  }

  .nodisplay {
    display: none;
  }
</style>
@endsection

@section('content')

<div class="container">
    <div class="row">
        
        <div class="col-md-12">
        	<br><br>
        	<div class="panel panel-default">
        
                <div class="panel-heading">Hello {{ $patient->first_name }} {{ $patient->last_name }}!</div>

                <div class="panel-body">
                	
                	<div class="row" style="font-size:10pt;">
	                    <h4 style="border-bottom:2px dotted #00cfd1;padding:10px;color:#00cfd1;font-weight: bold;">
	                    	<i class="fa fa-address-card"></i> Your Personal Information
	                    </h4>

	                    <table class="">
	                      <tr>
	                        <td class="col-md-2 text-right">First Name:</td>
	                        <td><span style="font-family: sans-serif;">{{ $patient->first_name }}</span></td>
	                      </tr>
	                      <tr>
	                        <td class="col-md-2 text-right">Last Name:</td>
	                        <td><span style="font-family: sans-serif;">{{ $patient->last_name }}</span></td>
	                      </tr>
	                      <tr>
	                        <td class="col-md-2 text-right">Date of Birth:</td>
	                        <td><span style="font-family: sans-serif;">{{ $patient->dob->format('M d, Y') }}</span></td>
	                      </tr>
	                      <tr>
	                        <td class="col-md-2 text-right">Age:</td>
	                        <td><span style="font-family: sans-serif;">{{ $patient->dob->age }}</span></td>
	                      </tr>
	                      <tr>
	                        <td class="col-md-2 text-right">Gender:</td>
	                        <td><span style="font-family: sans-serif;">{{ $patient->gender != 'Other' ? $patient->gender : 'Prefer not to say' }}</span></td>
	                      </tr>
	                      <tr>
	                        <td class="col-md-2 text-right">Email:</td>
	                        <td><span style="font-family: sans-serif;">{{ $patient->email }}</span></td>
	                      </tr>
	                      <tr>
	                        <td class="col-md-2 text-right">Contact No.:</td>
	                        <td><span style="font-family: sans-serif;">{{ $patient->contact_number }}</span></td>
	                      </tr>
	                    </table>
                 	</div>

                 	<div class="row" style="font-size:10pt;">
	                    <h4 style="border-bottom:2px dotted #00cfd1;padding:10px;color:#00cfd1;font-weight: bold;">
	                    	<i class="fa fa-key"></i> Login Details
	                    </h4>

	                    <table class="">
	                      <tr>
	                        <td class="col-md-2 text-right">Username:</td>
	                        <td><span style="font-family: sans-serif;">{{ $patient->user->username }}</span></td>
	                      </tr>
	                      <tr>
	                        <td class="col-md-2 text-right">Password:</td>
	                        <td><a href="">Change Password</a></td>
	                      </tr>
	                    </table>
                 	</div>

                 	<div class="row" style="font-size:10pt;">
	                    <h4 style="border-bottom:2px dotted #00cfd1;padding:10px;color:#00cfd1;font-weight: bold;">
	                    	<i class="fa fa-calendar"></i> Appointments
	                    </h4>

	                    <div class="table-responsive">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Date</th>
										<th>Clinic</th>
										<th>Doctor</th>
										<th>Purpose</th>
										<th>Reminder</th>
									</tr>
								</thead>
								<tbody>
									@if($appointments->count() > 0)
										@foreach($appointments as $key => $appointment)
										<tr>
											<td class="appointment" width="20%">
												{{ date('D', strtotime($appointment->date_scheduled)) }} - 
												<strong style="color:#008385;">{{ date('M d, Y', strtotime($appointment->date_scheduled)) }}</strong>
												 at {{ date('g:i a', strtotime($appointment->time_scheduled)) }}
											</td>
											<td class="appointment">{{ $appointment->clinic }}</td>
											<td class="appointment">{{ $appointment->doctor }}</td>
											<td class="appointment">{{ $appointment->service }}</td>
											<td class="appointment" width="15%">{{ $appointment->date_scheduled->diffForHumans() }}</td>
										</tr>
										@endforeach
									@else
										<tr>
											<td colspan="5" class="text-center">No appointments.</td>
										</tr>
									@endif
								</tbody>
							</table>
						</div>
                 	</div>


                 	<div class="row" style="font-size:10pt;">
	                    <h4 style="border-bottom:2px dotted #00cfd1;padding:10px;color:#00cfd1;font-weight: bold;">
	                    	<i class="fa fa-calendar"></i> Prescriptions
	                    </h4>

	                    <div class="table-responsive">
							<table class="table table-striped">
	                            <thead>
	                              <th style="width:7%">Date</th>
	                              <th style="width:13%">Clinic</th>
	                              <th style="width:13%">Doctor</th>
	                              <th style="width:5%">Prescription</th>
	                            </thead>

	                            <tbody>
	                            @if(count($prescriptions) > 0)
	                              @foreach ($prescriptions as $prescription)
	                              <tr>
	                                <td>{{ $prescription->created_at->format('M d, Y') }}</td>
	                                <td>{{ $prescription->clinic }}</td>
	                                <td>{{ $prescription->doctor }}</td>
	                                <td>
	                                  <a class="print-link print-prescription" data-id="{{ $prescription->id }}"><i class="fa fa-file-prescription" aria-hidden="true"></i> Preview</a>
	                                </td>
	                              </tr>
	                              @endforeach
	                            @else
	                              <tr>
	                                <td class="text-center" colspan="8">No prescriptions.</td>
	                              </tr>
	                            @endif
	                            </tbody>
                          </table>

                          @include('patient._print_preview')
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
	$(".print-prescription").unbind().click(function(){
	    id = $(this).data('id');

	    $.ajax({
	      method: "POST",
	      url: "/patient_view/print_prescription",
	      data: { 
	        id: id,
	        _token: "{{ csrf_token() }}" 
	      }
	    })
	    .done(function( html ) {
	        $("#print_preview_content").html(html);
	        $("#print_preview_modal").modal('show');
	    });
	});
});
</script>
@endsection