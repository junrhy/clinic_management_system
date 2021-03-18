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

  .no-image {
    background-color: #ccc;
    padding-top:36px;
    margin-bottom: 5px;
  }

  .profile-picture {
    height: 170px;
    width: 170px;
    margin-left: 30px;
  }

  .image-size {
    margin-top: 35px;
    margin-left:auto;
    margin-right: auto;
    width:70px;
    color: #666;
    font-family: sans-serif;
  }
</style>
@endsection

@section('content')

<div class="container">
    <div class="row">
        
        <div class="col-md-12">
        	<br><br>
        	<div class="panel panel-primary">
        
                <div class="panel-heading">Hello {{ $patient->first_name }} {{ $patient->last_name }}!</div>

                <div class="panel-body">
                	@if ($patient->is_registration_request == true)
                        <div class="alert alert-warning alert-block">
                           <strong>Pending Review:</strong> For security purposes, your account is pending review by our staff before being activated. This usually takes around <u>1 business day</u> to complete. Please note, we may require additional documentation if we are unable to verify your identity.
                        </div>
                  	@endif

                	<div class="row" style="font-size:10pt;">
                	    <h4 class="header-section">
	                    	<i class="fa fa-address-card"></i> Your Personal Information
	                    </h4>

	                    <div class="row">
	                    	<table class="col-md-12">
		                      <tr>
		                        <td class="col-md-2 text-right">First Name:</td>
		                        <td><span style="font-family: sans-serif;">{{ $patient->first_name }}</span></td>
		                        <td class="col-md-3" rowspan="7">
		                        	@if($patient->profile_picture == '')
			                          <div class="profile-picture no-image">
			                              <div class="image-size">170 x 170</div>
			                          </div>
		                            @else
			                          <div class="profile-picture">
			                              @if(env('FILESYSTEM_DRIVER') == 'spaces')
			                              <img class="profile-picture" src="{{ asset('https://file-server1.sfo2.digitaloceanspaces.com/' . $patient->profile_picture) }}" />
			                              @endif

			                              @if(env('FILESYSTEM_DRIVER') == 'public')
			                              <img class="profile-picture" src="{{ asset('storage/' . $patient->profile_picture) }}" />
			                              @endif
			                          </div>
		                            @endif
		                        </td>
		                      </tr>
		                      <tr>
		                        <td class="col-md-2 text-right">Last Name:</td>
		                        <td><span style="font-family: sans-serif;">{{ $patient->last_name }}</span></td>
		                      </tr>
		                      <tr>
		                        <td class="col-md-2 text-right">Birthdate:</td>
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
                 	</div>

                 	<div class="row" style="font-size:10pt;">
	                    <h4 class="header-section">
	                    	<i class="fa fa-key"></i> Account Information
	                    </h4>

	                    <table class="col-md-11">
	                      <tr>
	                        <td class="col-md-2 text-right">Username:</td>
	                        <td><span style="font-family: sans-serif;">{{ $patient->user->username }}</span></td>
	                      </tr>
	                      <tr>
	                        <td class="col-md-2 text-right">Password:</td>
	                        <td><a href="/patient_view/change_password">Change Password</a></td>
	                      </tr>
	                    </table>
                 	</div>

                 	<div class="row" style="font-size:10pt;">
	                    <h4 class="header-section">
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
											<td class="appointment" width="15%">
												@if($appointment->is_schedule_request == true)
												Waiting for Approval 
												@else
												{{ $appointment->date_scheduled->diffForHumans() }}
												@endif
											</td>
										</tr>
										@endforeach
									@else
										<tr>
											<td colspan="5" class="text-center">No appointments.</td>
										</tr>
									@endif
									@if ($patient->is_registration_request == false)
									<tr>
										<td colspan="5" class="text-center">
											<a href="/patient_view/request_appointment">Request appointment</a>
										</td>
									</tr>
									@endif
								</tbody>
							</table>
						</div>
                 	</div>


                 	<div class="row" style="font-size:10pt;">
	                    <h4 class="header-section">
	                    	<i class="fa fa-file-alt"></i> Prescriptions
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