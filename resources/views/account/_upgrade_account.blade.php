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
<div class="modal fade" id="upgrade_account_modal" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title">Upgrade to Business Account</h5>
      </div>
      <div class="modal-body">
        <span id="upgrade-message">You have reach the limitation of your account.</span> <span class="text-upgrade">Upgrade to Business Account</span> to enjoy unlimited features.
        <br><br>
        <table width="100%">
          <tr>
            <td width="30%">&nbsp;</td>
            <td class="text-center" width="25%">&nbsp;</td>
            <td rowspan=2 class="business-plan-head text-center" width="25%">Business</td>
          </tr>
          <tr>
            <td></td>
            <td class="basic-plan-head text-center" width="25%">Basic</td>
          <tr>
            <td>Number of Appointments</td>
            <td class="basic-plan text-center">Unlimited</td>
            <td class="business-plan text-center">Unlimited</td>
          </tr>
          <tr>
            <td>Number of Patients</td>
            <td class="basic-plan text-center">100</td>
            <td class="business-plan text-center">Unlimited</td>
          </tr>
          <tr>
            <td>Number of Clinics</td>
            <td class="basic-plan text-center">2</td>
            <td class="business-plan text-center">Unlimited</td>
          </tr>
          <tr>
            <td>Secretary User Access</td>
            <td class="basic-plan text-center">1</td>
            <td class="business-plan text-center">Unlimited</td>
          </tr>
          <tr>
            <td>Number of Services</td>
            <td class="basic-plan text-center">Unlimited</td>
            <td class="business-plan text-center">Unlimited</td>
          </tr>
          <tr>
            <td>Number of Doctors</td>
            <td class="basic-plan text-center">Unlimited</td>
            <td class="business-plan text-center">Unlimited</td>
          </tr>
          <tr>
            <td>Subscription Rate</td>
            <td class="basic-plan text-center">Free</td>
            <td rowspan=2 class="business-plan-foot text-center">&#8369;1,000 / month</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="basic-plan-foot text-center"></td>
          </tr>
        </table>
        <br>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-default btn-round" data-dismiss="modal">Close</button>
       <a href="https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7B7DXYEA9FKLA&notify_url={{ url('/paypal_subscription_activated') }}&custom=clientid_{{  Auth::user()->client->id }}" type="button" id="btn-upgrade-account" data-id="" class="btn btn-upgrade btn-round">Upgrade to Business Account</a>
    </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
<script type="text/javascript">
$(document).ready(function () {
  $("#form-add-clinic").submit(function() {
    if ($("#check-account-type").data('account-type') == "basic") {
      if ($("#check-clinic-count").data('clinic-count') >= 2) {
        $('#upgrade-message').html('You have reach the limitation of your account.');
        $('#upgrade_account_modal').modal('show');
        return false;
      } else {
        return true;
      }
    }
  });

  $("#form-add-patient").submit(function() {
    if ($("#check-account-type").data('account-type') == "basic") {
      if ($("#check-patient-count").data('patient-count') >= 100) {
        $('#upgrade-message').html('You have reach the limitation of your account.');
        $('#upgrade_account_modal').modal('show');
        return false;
      } else {
        return true;
      }
    }
  });

  $("#form-add-user").submit(function() {
    if ($("#check-account-type").data('account-type') == "basic") {
      if ($("#check-user-count").data('user-count') >= 2) {
        $('#upgrade-message').html('You have reach the limitation of your account.');
        $('#upgrade_account_modal').modal('show');
        return false;
      } else {
        return true;
      }
    }
  });

  $("#sidebar-menu-upgrade-account").click(function(){
    $('#upgrade-message').html('Is your business growing fast? We got you covered.');
    $('#upgrade_account_modal').modal('show');
  });
});
</script>