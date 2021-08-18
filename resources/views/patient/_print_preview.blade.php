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
          <h5 class="modal-title">Preview</h5>
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
     html2canvas(document.getElementById("print_preview_content"), {
          letterRendering: 1, 
          allowTaint: false,
          useCORS: true,
          onrendered: function(canvas) {

              var imgData = canvas.toDataURL('image/png');
              console.log('Report Image URL: '+imgData);
              var doc = new jsPDF('l', 'in', [8.3, 11.7]); // A4 wide and high
              
              // var width = doc.internal.pageSize.width;
              // var height = doc.internal.pageSize.height;

              doc.addImage(imgData, 'PNG', 0.3, 0.1, 5, 8);
              // doc.save('prescription.pdf'); -- do not download

              var string = doc.output('datauristring');
              var embed = "<embed width='100%' height='100%' src='" + string + "'/>"
              var x = window.open();
              x.document.open();
              x.document.write(embed);
              x.document.close();
          }
      });
  });

});
</script>