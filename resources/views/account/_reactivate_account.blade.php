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
<div class="modal fade" id="reactivate_account_modal" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title">Request to Reactivate Account</h5>
      </div>
      <div class="modal-body">
        <span class="text-center" id="upgrade-message">This account has been suspended due to some concerns from our office.</span> Our customer service will contact you at your provided contact details to discuss about your account status. We are looking forward to continue serving you soon. <br>
        <br>
        Your Contact Details:<br>
        <br>
        Business Name: {{ Auth::user()->client->name }}<br>
        Primary Email: {{ Auth::user()->client->email }}<br>
        Secondary Email: {{ Auth::user()->client->secondary_email != '' ? Auth::user()->client->secondary_email : 'not provided' }}<br>
        Contact No.: {{ Auth::user()->client->contact != '' ? Auth::user()->client->contact : 'not provided' }}<br>
        <br>
        <br>
        For immediate action please call our office. <br>
        <br>
        Office: +63 (32) 411-1111 
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
  $("#sidebar-menu-reactivate-account").click(function(){
    $('#reactivate_account_modal').modal('show');
  });
});
</script>