@extends('layouts.app')

@section('page_level_css')
<style type="text/css">
  .text-red {
    color:red;
  }

  .text-green {
    color:green;
  }

  .logo {
    height:98px;
    width:371px;
  }

  .no-mage {
    background-color: #ccc;
    padding-top:36px;
    margin-bottom: 5px;
  }

  .image-size {
    margin-left:auto;
    margin-right: auto;
    width:70px;
    color: #666;
    font-family: sans-serif;
  }

  .remove-logo {
    margin-bottom: 5px;
    text-align: right;
  }

  #delete_company_logo {
    color: #ccc;
  }

  #delete_company_logo:hover {
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
                        <h2>Company Profile <small class="text-muted">Your company profile information</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item active"><strong style="color: #fff;">Company Profile</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Company Profile</div>

                <div class="panel-body">
 	               <div class="row col-md-3">
                    @if (count($errors) > 0)
                       <span class="text-red">
                            {{ Html::ul($errors->all()) }}
                         </span>
                    @endif

                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button> 
                          <strong>{{ $message }}</strong>
                    </div>
                    @endif

                    {{ Form::open(array('url' => 'update_business_information', 'enctype' => 'multipart/form-data')) }}
                        <div class="form-group">
                          {{ Form::label('name', 'Company Name') }}
                          {{ Form::text('name', $client->name, array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                          {{ Form::label('name', 'Email') }}

                          @if($client->is_email_verified)
                          <small class="text-green"><i class="fa fa-check"></i> Verified</small>
                          @else
                          <small class="text-red">Not verified</small>
                          @endif

                          {{ Form::email('email', $client->email, array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                          {{ Form::label('contact', 'Contact Number') }}
                          
                          @if($client->is_contact_verified)
                          <small class="text-green"><i class="fa fa-check"></i> Verified</small>
                          @else
                          <small class="text-red">Not verified</small>
                          @endif

                          {{ Form::text('contact', $client->contact, array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                          {{ Form::label('logo', 'Company Logo') }}

                          @if($client->logo && env('FILESYSTEM_DRIVER') == 'spaces')
                          <img class="logo" src="{{ asset('https://file-server1.sfo2.digitaloceanspaces.com/' . $client->logo) }}" />

                          <div class="remove-logo">
                            <a id="delete_company_logo" href="/delete_company_logo/{{ $client->id }}"><small>Remove</small></a>
                          </div>
                          @elseif($client->logo && env('FILESYSTEM_DRIVER') == 'public')
                          <img class="logo" src="{{ asset('storage/' . $client->logo) }}" />

                          <div class="remove-logo">
                            <a id="delete_company_logo" href="/delete_company_logo/{{ $client->id }}"><small>Remove</small></a>
                          </div>
                          @else
                          <div class="logo no-mage">
                            <div class="image-size">371 x 98</div>
                          </div>
                          @endif

                          <input type="hidden" name="attachment_number" value="{{ \Illuminate\Support\Str::random(6) }}">
                          <input type="hidden" name="client_id" value="{{ $client->id }}">
                          <input type="file" name="attachment">
                        </div>

                        {{ Form::hidden('id', $client->id) }}

                        {{ Form::submit('Save Changes', array('class' => 'btn btn-primary btn-round pull-right')) }}
                     {{ Form::close() }}
                 </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection