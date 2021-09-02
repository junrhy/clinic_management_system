@extends('layouts.app')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>
@endsection

@section('page_level_css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>

<style type="text/css">
    .panel-body {
        padding-top: 0;
        padding-bottom: 0;
    }   

    #message_sidebar, #message_body, #message_recipient_profile {
        min-height: 75vh;
    }

    #message_sidebar {
        border-right: 1px solid #eee;
    }

    #message_recipient_profile {
        border-left: 1px solid #eee;
    }

    .ui_header {
        background-color: #eff7ff;
        padding: 5px;
        font-weight: bold;
        text-align: center;
    }

    #message_content {
        height: 550px;
        border-bottom: 1px solid #eee;
    }

    .ui_footer {
        padding-top: 15px;
    }

    .contact-row {
        padding-top: 6px;
        padding-bottom: 6px;
        border-bottom: 1px solid #eee;
        cursor: pointer;
    }

    .unread {
        font-weight: bold;
        background-color: #f5ffeb;
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
                        <h2>Messages <small class="text-muted">Message your patients</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <a class="btn btn-white btn-icon btn-round float-right m-l-10 {{ App\Model\FeatureUser::is_feature_allowed('add_message', Auth::user()->id) }}" href="{{ url('message/create') }}" type="button">
                            <i class="fa fa-plus"></i>
                        </a>

                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item active"><strong style="color:#fff;">Messages</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Messages</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-2" id="message_sidebar">
                            <div class="row ui_header">
                                Contacts
                            </div>

                            @foreach($rooms as $room)
                                <?php
                                $unread = "";
                                ?>

                                <div class="row contact-row {{ $unread }}">
                                    <div class="col-md-12">
                                        <?php if ($room->is_for_admin) {
                                            $recipient = "Customer Support";
                                        } else {
                                            $recipient = $room->member_user_ids;
                                        } ?>
                                        <div class="sender">
                                        @if($recipient == "Customer Support")
                                            Customer Support
                                        @endif

                                        <?php $members = explode(",", $recipient) ?>
                                        @foreach($members as $id)
                                            <?php $user = \App\User::find($id); ?>

                                            @if($user)
                                            {{ $user->first_name }}
                                            @endif
                                        @endforeach
                                        </div>
                                        <div class="message_header">
                                            <small>{{ str_limit($room->messages->first()->message, 10) }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-md-8" id="message_body">
                            <div class="row ui_header">
                                Message
                            </div>

                            <div class="row" id="message_content">
                                
                            </div>

                            <div class="row ui_footer">
                                <div class="col-md-10"><textarea class="form-control" style="height: 70px; resize: none;" disabled></textarea></div>
                                <div class="col-md-2"><button class="btn btn-primary btn-block" disabled>Send</button></div>
                            </div>
                        </div>

                        <div class="col-md-2" id="message_recipient_profile">
                            <div class="row ui_header">
                                Profile
                            </div>
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
  
});
</script>
@endsection
