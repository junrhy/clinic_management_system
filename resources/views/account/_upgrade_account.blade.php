<style type="text/css">
  .free-plan, .basic-plan {
    padding:10px;
    border:1px solid #ccc;
    font-size:10pt;
  }

  .free-plan-head {
    background:#63B5FF;
    color:#FFFFFF;
    border:1px solid #ccc;
  } 

  .basic-plan-head {
    background:#FF6065;
    color:#FFFFFF;
    border-left:1px solid #ccc;
    border-right:1px solid #ccc;
  }

  .free {
    color: #63B5FF;
    font-weight: bold;
    font-family: 'arial';
  }

  .free-plan-foot {
    padding:3px;
  } 

  .basic-plan-foot {
    padding:3px;
    border:1px solid #ccc;
    font-size:13pt;
    color:#FF6065;
    font-family: 'arial';
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
        <h5 class="modal-title">Upgrade to Basic Plan</h5>
      </div>
      <div class="modal-body">
        <span id="upgrade-message">You have reach the limitation of your account.</span> <span class="text-upgrade">Upgrade to Basic Plan</span> to enjoy unlimited features.
        <br><br>
        <div class="table-responsive">
              <table width="100%">
                <tr>
                  <td width="30%">&nbsp;</td>
                  <td class="text-center" width="25%">&nbsp;</td>
                  <td rowspan=2 class="basic-plan-head text-center" width="25%">Basic</td>
                </tr>
                <tr>
                  <td></td>
                  <td class="free-plan-head text-center" width="25%">Free</td>
                <tr>
                  <td>Number of Appointments</td>
                  <td class="free-plan text-center">Unlimited</td>
                  <td class="basic-plan text-center">Unlimited</td>
                </tr>
                <tr>
                  <td>Number of Patients</td>
                  <td class="free-plan text-center">100</td>
                  <td class="basic-plan text-center">Unlimited</td>
                </tr>
                <tr>
                  <td>Number of Clinics</td>
                  <td class="free-plan text-center">Unlimited</td>
                  <td class="basic-plan text-center">Unlimited</td>
                </tr>
                <tr>
                  <td>Number of Staffs</td>
                  <td class="free-plan text-center">Unlimited</td>
                  <td class="basic-plan text-center">Unlimited</td>
                </tr>
                <tr>
                  <td>Number of Services</td>
                  <td class="free-plan text-center">Unlimited</td>
                  <td class="basic-plan text-center">Unlimited</td>
                </tr>
                <tr>
                  <td>Number of Doctors</td>
                  <td class="free-plan text-center">Unlimited</td>
                  <td class="basic-plan text-center">Unlimited</td>
                </tr>
                <tr>
                  <td>Dental Chart Feature</td>
                  <td class="free-plan text-center">Yes</td>
                  <td class="basic-plan text-center">Yes</td>
                </tr>
                <tr>
                  <td>Subscription Rate</td>
                  <td class="free-plan text-center free">FREE</td>
                  <td rowspan=2 class="basic-plan-foot text-center">&#8369;1,800 / month</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td class="free-plan-foot text-center"></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td class=" text-center" style="border: 1px solid #FF6065;background-color: #FF6065;">
                    <a href="{{ url('/subscription') }}" type="button" id="btn-upgrade-account" data-id="" class="btn btn-upgrade btn-block">Upgrade</a>
                  </td>
                </tr>
              </table>
        </div>
        <br>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-default btn-round" data-dismiss="modal">Close</button>
    </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>

<script type="text/javascript">
$(document).ready(function () {
  $("#form-add-patient").submit(function() {
    if ($("#check-account-type").data('account-type') == "free") {
      if ($("#check-patient-count").data('patient-count') >= 100) {
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