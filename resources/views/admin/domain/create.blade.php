@extends('layouts.admin')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>
@endsection

@section('page_level_css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>

<style type="text/css">
  .required_select {
    border: 1px solid red;
  }

  .text-red {
    color:red;
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
                        <h2>Add Domain <small class="text-muted">Admin Portal</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-home"></i> Admin Portal</a></li>
                            <li class="breadcrumb-item"><a href="/admin/domains"><i class="fa fa-user"></i> Domains</a></li>
                            <li class="breadcrumb-item active">Add Domain</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Add Domain</div>

                <div class="panel-body">
                  <div class="row col-md-3">
                      @if (count($errors) > 0)
                        <span class="text-red">
                          {{ Html::ul($errors->all()) }}
                        </span>
                      @endif

                      {{ Form::open(array('url' => '/admin/domain/store', 'method' => 'POST')) }}
                        <div class="form-group">
                          {{ Form::label('client_id', 'Client') }}
                          <select name="client_id" class="form-control">
                               <option value disabled="disabled" selected="selected">Select</option>
                                <option value="0">Default</option>
                               @foreach($clients as $client)
                               <option value="{{ $client->id }}">{{ $client->name }}</option>
                               @endforeach
                          </select>
                        </div>

                        <div class="form-group">
                          {{ Form::label('domain_name', 'Domain Name') }}
                          {{ Form::text('domain_name', null, array('class' => 'form-control', 'required')) }}
                        </div>

                        <div class="form-group">
                          {{ Form::label('params', 'Parameters') }}
                          {{ Form::text('params', null, array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                          {{ Form::label('distributor_code', 'Distributor Code') }}
                          {{ Form::number('distributor_code', null, array('class' => 'form-control', 'required')) }}
                        </div>

                        {{ Form::submit('Submit', array('class' => 'btn btn-primary btn-round')) }}
                      {{ Form::close() }}
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_level_footer_script')

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>

<script type="text/javascript">
$(document).ready(function() {
  $("form").submit(function(e){
        if ($('select[name="client_id"]').val() == null) {
          $('select[name="client_id"]').addClass('required_select');
          e.preventDefault();
        } else {
          $('select[name="client_id"]').removeClass('required_select');
        }
    });
});
</script>
@endsection
