@extends('layouts.app')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>
@endsection

@section('page_level_css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>

<style type="text/css">
  .category {
    font-weight: bold;
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
                        <h2>Privileges <small class="text-muted">You can set the privileges of the user</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item">User</li>
                            <li class="breadcrumb-item active">Privileges</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Privileges</div>

                <div class="panel-body">
                    @foreach($features as $key => $feature)
                        <input type="checkbox" id="{{ $feature->name }}" data-id="{{ $feature->id }}" name="user_features" {{ App\Model\FeatureUser::is_feature_checked($feature->name, Auth::user()->id) }}> <span id="txt_{{ $feature->name }}">{{ ucwords(str_replace('_', ' ', $feature->name)) }}</span>
                        <br/>
                    @endforeach

                    <br>
                    <button id="btn-save" data-user-id="{{ Auth::user()->id }}" class="btn btn-primary btn-round">Save Changes</button>
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
    $("#btn-save").click(function(){
        var user_id = $(this).data('user-id');
        var features = [];

        $("input[name='user_features']").each(function(index){
            features.push({ 'feature_id': $(this).data('id'), 'is_checked': $(this).prop('checked') });        
        });

        $.ajax({
            method: "POST",
            url: "/user/update_privilege/" + user_id,
            data: { 
              user_features: features,
              _token: "{{ csrf_token() }}" 
            }
        })
        .done(function( msg ) {
            Swal.fire(
              'User privilege updated!',
              'Privileges successfully updated.',
              'success'
            ).then((result) => {
              location.reload();
            });
        });
    });

    $("#calendar").click(function(){
        $("#add_appointment").prop('checked', $(this).is(":checked"));
        $("#edit_appointment").prop('checked', $(this).is(":checked"));
    });

    $("#patients").click(function(){
        $("#add_patient").prop('checked', $(this).is(":checked"));
        $("#edit_patient").prop('checked', $(this).is(":checked"));
        $("#delete_patient").prop('checked', $(this).is(":checked"));
        $("#view_patient_record").prop('checked', $(this).is(":checked"));
        $("#add_patient_detail").prop('checked', $(this).is(":checked"));
        $("#delete_patient_detail").prop('checked', $(this).is(":checked"));
        $("#archive_patient_detail").prop('checked', $(this).is(":checked"));
        $("#unarchive_patient_detail").prop('checked', $(this).is(":checked"));
        $("#add_patient_charge").prop('checked', $(this).is(":checked"));
        $("#delete_patient_charge").prop('checked', $(this).is(":checked"));
        $("#add_patient_payment").prop('checked', $(this).is(":checked"));
        $("#delete_patient_payment").prop('checked', $(this).is(":checked"));
        $("#dental_chart").prop('checked', $(this).is(":checked"));
    });

    $("#clinics").click(function(){
        $("#add_clinic").prop('checked', $(this).is(":checked"));
        $("#edit_clinic").prop('checked', $(this).is(":checked"));
        $("#delete_clinic").prop('checked', $(this).is(":checked"));
    });

    $("#doctors").click(function(){
        $("#add_doctor").prop('checked', $(this).is(":checked"));
        $("#edit_doctor").prop('checked', $(this).is(":checked"));
        $("#delete_doctor").prop('checked', $(this).is(":checked"));
    });

    $("#services").click(function(){
        $("#add_service").prop('checked', $(this).is(":checked"));
        $("#edit_service").prop('checked', $(this).is(":checked"));
        $("#delete_service").prop('checked', $(this).is(":checked"));
    });

    $("#users").click(function(){
        $("#add_user").prop('checked', $(this).is(":checked"));
        $("#edit_user").prop('checked', $(this).is(":checked"));
        $("#delete_user").prop('checked', $(this).is(":checked"));
        $("#set_privileges").prop('checked', $(this).is(":checked"));
    });

    $(function(){
        $("#txt_dashboard").addClass('category');
        $("#txt_calendar").addClass('category');
        $("#txt_patients").addClass('category');
        $("#txt_clinics").addClass('category');
        $("#txt_doctors").addClass('category');
        $("#txt_services").addClass('category');
        $("#txt_users").addClass('category');
        $("#txt_settings").addClass('category');
    });
});
</script>
@endsection