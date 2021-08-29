@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>Settings <small class="text-muted">Manage web app settings</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item active">Settings</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Settings</div>

                <div class="panel-body">
                    <div class="col-md-4" style="min-height: 40vh;">
                        <div class="row">
                            <?php $set_custom_total_amount = App\Model\ClientSettings::is_setting_checked('set_custom_total_amount', Auth::user()->client_id); ?>

                            {{ Form::checkbox('set_custom_total_amount', 'Yes', $set_custom_total_amount, array('class' => 'setting') ) }}
                            
                            {{ Form::label('set_custom_total_amount', 'Set custom total amount') }}
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
    $(".setting").unbind().click(function(){
        var name = $(this).prop('name');
        var value = $(this).prop('value');
        var is_check = $(this).is(":checked");

        $.ajax({
            method: "POST",
            url: "/client/settings/set_setting",
            data: { 
              name: name,
              value: value,
              is_check: is_check,
              _token: "{{ csrf_token() }}" 
            }
        })
        .done(function( msg ) {
            // do nothing
        });
    });

});
</script>
@endsection
