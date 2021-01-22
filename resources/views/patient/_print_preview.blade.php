<style type="text/css">

</style>
<!-- Modal -->
<div class="modal fade" id="print_preview_modal" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title">Print Preview</h5>
      </div>
      <div class="modal-body">
          <div id="print_preview_content">

          </div>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-default btn-round" data-dismiss="modal">Close</button>
            <a class="btn btn-primary btn-round" id="print_now"><i class="fa fa-plus" aria-hidden="true"></i> Print</a>
      </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
  $('#print_now').click(function() {
    var newWin=window.open('','Print-Window');

    newWin.document.open();

    newWin.document.write('<html><body onload="window.print()">'+$("#print_preview_content").html()+'</body></html>');

    newWin.document.close();

    setTimeout(function(){newWin.close();},10);
  });
});
</script>