<style type="text/css">
  .basic-plan, .business-plan {
    padding:10px;
    border:1px solid #ccc;
    font-size:10pt;
  }

  .basic-plan-head {
    background:#63B5FF;
    color:#FFFFFF;
    border:1px solid #ccc;
  } 

  .business-plan-head {
    background:#FF6065;
    color:#FFFFFF;
    border-left:1px solid #ccc;
    border-right:1px solid #ccc;
  }

  .basic-plan-foot {
    padding:3px;
  } 

  .business-plan-foot {
    padding:3px;
    border:1px solid #ccc;
    font-size:13pt;
    color:#FF6065;
  }

  .text-upgrade {
    color:#FF6065;
  }

  .btn-upgrade {
    background:#FF6065;
    color:#FFFFFF;
  }

  .btn-upgrade:hover {
    color:#FFFFFF;
    box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.15);
  }
</style>

<!-- Modal -->
<div class="modal fade" id="activate_account_modal" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title">Activate your Business Account</h5>
      </div>
      <div class="modal-body">
        <h3 class="text-center" id="upgrade-message">Aloha! We are so happy to see you here!</h3><br> As you notice that your account has been inactive, You need to <span class="text-upgrade">Activate your account</span> for us to continue serving you and your business. We are so committed to be your best medical software partner in the world as you run and grow your business. We will never disappoints you. So let's do it!
        
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-default btn-round" data-dismiss="modal">Close</button>
       <!-- <a href="https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7B7DXYEA9FKLA&notify_url={{ url('/paypal_subscription_activated') }}&custom=clientid_{{  Auth::user()->client->id }}" type="button" id="btn-upgrade-account" data-id="" class="btn btn-upgrade btn-round">Activate my Account</a> -->
       <a href="" type="button" id="btn-upgrade-account" data-id="" class="btn btn-upgrade btn-round">Contact Sales</a>
    </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
<script type="text/javascript">
$(document).ready(function () {
  $("#sidebar-menu-activate-account").click(function(){
    $('#activate_account_modal').modal('show');
  });
});
</script>