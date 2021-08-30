<style type="text/css">
  .calculator-key {
    font-size: 16pt;
    padding-top: 15px;
    padding-bottom: 15px;
    font-family: sans-serif;
    cursor: pointer;
  }

  .calculator-key-pressed {
    background-color: #F8F8F8;
  }

  input[name='calculator_text']:disabled {
    margin-bottom: 5px;
    background-color: #FFFFFF;
    cursor: default;
    text-align: right;
    font-size: 22pt;
    height: 50px;
    font-family: sans-serif;
  }
</style>

<!-- Modal -->
<div class="modal fade" id="calculator_modal" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h5 class="modal-title"><i class="fa fa-calculator" aria-hidden="true"></i> Input Number</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <input type="text" name="calculator_text" value="0" class="form-control" disabled>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 text-center calculator-key">1</div>
          <div class="col-md-4 text-center calculator-key">2</div>
          <div class="col-md-4 text-center calculator-key">3</div>
        </div>

        <div class="row">
          <div class="col-md-4 text-center calculator-key">4</div>
          <div class="col-md-4 text-center calculator-key">5</div>
          <div class="col-md-4 text-center calculator-key">6</div>
        </div>

        <div class="row">
          <div class="col-md-4 text-center calculator-key">7</div>
          <div class="col-md-4 text-center calculator-key">8</div>
          <div class="col-md-4 text-center calculator-key">9</div>
        </div>

        <div class="row">
          <div class="col-md-4 text-center calculator-key"><span style="position:relative;top:-5px;">.</span></div>
          <div class="col-md-4 text-center calculator-key">0</div>
          <div class="col-md-4 text-center calculator-key" style="font-size: 10pt;padding-top: 20px;padding-bottom: 23px;">Clear</div>
        </div>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-default btn-round" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary btn-round" id="input-number-apply">Apply</a>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function () {
  $("#editable-amount").click(function(){
    $("input[name='calculator_text']").val(0);

    $('#calculator_modal').modal('show');
  });

  $(".calculator-key").unbind().click(function(){
    var currentElement = $(this);

    currentElement.addClass('calculator-key-pressed');

    setTimeout(function(){ currentElement.removeClass('calculator-key-pressed'); }, 100);

    if (currentElement.text() != "Clear") {
      var calculator_text = $("input[name='calculator_text']").val();

      if (calculator_text == "0") {
        if (currentElement.text() == ".") {
          $("input[name='calculator_text']").val( calculator_text + currentElement.text() );
        } else {
          $("input[name='calculator_text']").val( currentElement.text() );
        }

      } else {
        if(calculator_text.indexOf('.') !== -1 && currentElement.text() == ".") {
          // existing dot. do nothing
        } else {
          $("input[name='calculator_text']").val( calculator_text + currentElement.text() );
        }

      }
      
    } else {
      $("input[name='calculator_text']").val(0);
    }
  });

  $("#input-number-apply").click(function(){
    var calculator_text = $("input[name='calculator_text']").val();

    $("#editable-amount").text(numberWithCommas(parseFloat(calculator_text).toFixed(2)));

    $('#calculator_modal').modal('toggle');
  });
});
</script>