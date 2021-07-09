@extends('layouts.app')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>
@endsection

@section('page_level_css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>New Inventory <small class="text-muted">Add new inventory into the system</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item"><a href="/inventory">Inventory List</a></li>
                            <li class="breadcrumb-item active"><strong style="color:#fff;">New Inventory</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">New Inventory</div>

                <div class="panel-body">
                  <div class="row" style="color: red;">
                       {{ Html::ul($errors->all()) }}
                  </div>

                  <div class="row col-md-3">
                    {{ Form::open(array('url' => 'inventory')) }}
                      <div class="form-group">
                        {{ Form::label('name', 'Inventory Name') }}
                        {{ Form::text('name', null, array('class' => 'form-control', 'required')) }}
                      </div>

                      <div class="form-group">
                        {{ Form::label('sku', 'Sku ( Stock-keeping unit )') }}
                        {{ Form::text('sku', null, array('class' => 'form-control')) }}
                      </div>

                      <div class="form-group">
                        {{ Form::label('qty', 'Quantity') }}
                        {{ Form::number('qty', null, array('class' => 'form-control', 'step' => '0.5', 'min' => '0', 'required')) }}
                      </div>

                      <div class="form-group">
                        {{ Form::label('price', 'Cost Per Unit') }}
                        {{ Form::number('price', null, array('class' => 'form-control', 'step' => '0.5', 'min' => '0')) }}
                      </div>

                      <div class="form-group">
                        {{ Form::label('expire_at', 'Expiration Date') }}
                        {{ Form::text('expire_at', null, array('class' => 'form-control')) }}
                      </div>

                      <div class="form-group">
                        {{ Form::label('location', 'Inventory Location') }} <small>Where is this inventory located?</small>
                        {{ Form::text('location', null, array('class' => 'form-control', 'required', 'maxlength' => '25')) }}
                      </div>

                      <div>
                        {{ Form::submit('Submit', array('class' => 'btn btn-primary btn-round')) }}
                      </div>
                    {{ Form::close() }}
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

    $(function(){
        apply_calendar();
    });

    function apply_calendar() {
        $("input[name='expire_at']").datepicker({  
            minDate: '0',
            format: 'mm/dd/yyyy',
            changeMonth: true,
            changeYear: true,
        });
    }
});

</script>
@endsection

