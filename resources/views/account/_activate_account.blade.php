<style type="text/css">
  #btn-contact-support {
    background:#FF6065;
    color:#FFFFFF;
  }

  #btn-contact-support:hover {
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
        <h5 class="modal-title">Activate your Account</h5>
      </div>
      <div class="modal-body">
        You need to provide us all the requirements for us to activate your account. Please contact our customer service and request for activation.
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-default btn-round" data-dismiss="modal">Close</button>
       <a href="" type="button" id="btn-contact-support" data-id="" class="btn btn-round">Contact Customer Service</a>
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