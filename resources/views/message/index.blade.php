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

    #contact-list {
        height: 75vh;
        overflow-y: auto;
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

    #message_content {
        overflow-y: auto;
    }

    .required {
        border: 1px solid red;
    }

    .hide {
        display: none;
    }

    .setting-link:hover {
        text-decoration: underline;
        cursor: pointer;
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

                            <div class="row" id="contact-list">
                            @foreach($rooms as $room)
                                <?php
                                $unread = "";

                                $read_by_user_ids = explode(",", $room->read_by_user_ids);

                                if (!in_array(auth()->user()->id, $read_by_user_ids)) {
                                    $unread = "unread";
                                }

                                $show_members = [];
                                $members = explode(",", $room->member_user_ids)
                                ?>

                                @if( in_array(auth()->user()->id, $members) )
                                <div class="col-md-12 contact-row {{ $unread }}" data-room_id="{{ $room->id }}">
                                    <div class="subject">
                                        {{ $room->name }}
                                    </div>
                                    <div class="sender">
                                        @foreach($members as $id)
                                            <?php 
                                                $user = \App\User::find($id);

                                                if ($user) {
                                                    $fullname = $user->first_name . ' ' . $user->last_name;

                                                    array_push($show_members, $fullname);
                                                }
                                            ?>
                                        @endforeach

                                        {{ str_limit( implode(",", $show_members), 30) }}
                                    </div>
                                    <div class="message_header">
                                        <small>{{ str_limit($room->messages->last()->message, 30) }}</small>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                            </div>
                        </div>

                        <div class="col-md-8" id="message_body">
                            <div class="row ui_header">
                                Message
                            </div>

                            <div class="row" id="message_content">
                                
                            </div>

                            <div class="row ui_footer">
                                <div class="col-md-10"><textarea id="new-message" class="form-control" style="height: 70px; resize: none;" disabled></textarea></div>
                                <div class="col-md-2"><button id="send-message" data-room_id="0" class="btn btn-primary btn-block" disabled>Send</button></div>
                            </div>
                        </div>

                        <div class="col-md-2" id="message_recipient_profile">
                            <div class="row ui_header">
                                Settings
                            </div>
                            <br>
                            <div class="row" id="">
                                <div class="col-md-12" align="center">
                                    <span class="setting-link hide" id="delete-conversation" data-room_id="">Delete Conversation</span>
                                </div>
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
  $(".contact-row").unbind().click(function(){
    var thisElement = $(this);

    $("#message_content").animate({ scrollTop: $(document).height() }, 1000);

    var room_id = $(this).data('room_id');

    $("#send-message").attr('data-room_id', room_id);

    $.ajax({
      method: "POST",
      url: "/message/show_room_conversation",
      data: { 
        room_id: room_id,
        _token: "{{ csrf_token() }}" 
      }
    })
    .done(function( src ) {
      $("#message_content").html(src);

      $("#send-message").removeAttr('disabled');
      $("#new-message").removeAttr('disabled');

      thisElement.removeClass('unread');
      $(".setting-link").removeClass('hide');
      $("#delete-conversation").data('room_id', room_id);
    });
  });

  $("#send-message").click(function(){
    var room_id = $(this).data('room_id');

    if ($("#new-message").val() == "") {
        $("#new-message").addClass('required');
        return false;
    }
    
    $("#new-message").removeClass('required');

    var message = $("#new-message").val();
    
    $.ajax({
      method: "POST",
      url: "/message/add_reply",
      data: { 
        room_id: room_id,
        message: message,
        _token: "{{ csrf_token() }}" 
      }
    })
    .done(function( src ) {
      $("#message_content").html(src);

      $("#message_content").animate({ scrollTop: $(document).height() }, 1000);

      $("#new-message").val("");
      $("#new-message").focus();
    });
  });

  $("#delete-conversation").click(function(){
    var room_id = $(this).data('room_id');

    Swal.fire({
      title: 'Are you sure?',
      text: "You are about to delete this conversation. You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          method: "DELETE",
          url: "/message/delete_conversation/" + room_id,
          data: { 
            _token: "{{ csrf_token() }}" 
          }
        })
        .done(function( msg ) {
          Swal.fire(
            'Deleted!',
            'Conversation has been deleted.',
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
