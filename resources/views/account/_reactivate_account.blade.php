<style type="text/css">
  .text-red {
    color:#FF6065;
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
        <span class="text-red">This account has been suspended due to some concerns from our office.</span> Our customer service will contact you at your provided contact details to discuss about your account status. We are looking forward to continue serving you soon. <br>
        <br>
        <strong>YOUR CONTACT DETAILS</strong><br>
        <br>
        <table>
          <tr>
            <td width="40%">Company Name:</td>
            <td>{{ Auth::user()->client->name }}</td>
          </tr>
          <tr>
            <td>Primary Email:</td>
            <td>{{ Auth::user()->client->email }}</td>
          </tr>
          <tr>
            <td>Secondary Email:</td>
            <td>{{ Auth::user()->client->secondary_email != '' ? Auth::user()->client->secondary_email : 'not provided' }}</td>
          </tr>
          <tr>
            <td>Contact No.:</td>
            <td>{{ Auth::user()->client->contact != '' ? Auth::user()->client->contact : 'not provided' }}</td>
          </tr>
        </table>
        <br>
        <br>
        For immediate action please contact our customer service. 
        <br>
        <br>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-default btn-round" data-dismiss="modal">Close</button>
       <a href="" type="button" id="btn-upgrade-account" data-id="" class="btn btn-upgrade btn-round">Contact Customer Service</a>
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