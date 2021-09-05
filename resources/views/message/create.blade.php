@extends('layouts.app')

@section('page_level_css')
<style type="text/css">
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
                        <h2>New Message <small class="text-muted">Add new message</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item active"><strong style="color:#fff;">New Message</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">New Message</div>

                <div class="panel-body">
                  <div class="row col-md-5">
                    @if (count($errors) > 0)
                        <span class="text-red">
                            {{ Html::ul($errors->all()) }}
                        </span>
                    @endif

                    {{ Form::open(array('url' => 'message')) }}
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-5">
                                {{ Form::label('recipient', 'Recipient') }}
                                <select name="recipient" class="form-control">
                                    <option value="">Select Recipient</option>
                                    
                                    <optgroup label="Help Center">
                                        <option value="helpcenter" style="font-weight:bold;">Customer Support</option>
                                    </optgroup>

                                    <optgroup label="Patients">
                                        @foreach($patients as $patient)
                                            @if($patient->user_id != null)
                                            <option value="{{ $patient->user->id }}">{{ $patient->first_name }} {{ $patient->last_name }}</option>
                                            @endif
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                      </div>

                      <div class="form-group">
                        {{ Form::label('subject', 'Subject') }}
                        {{ Form::text('subject', null, array('class' => 'form-control', 'required')) }}
                      </div>

                      <div class="form-group">
                        {{ Form::label('message', 'Message') }}
                        {{ Form::textarea('message', null, array('class' => 'form-control', 'required', 'style' => 'resize: none;')) }}
                      </div>

                      <div align="left">
                        {{ Form::submit('Send', array('class' => 'btn btn-primary btn-round')) }}
                      </div>
                    {{ Form::close() }}
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
