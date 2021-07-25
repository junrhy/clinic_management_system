<style type="text/css">
  .text-center {
    text-align: center;
  }

  .bg-light {
    background-color: #f8f9fa!important;
    border: 2px solid #fff;
    cursor: pointer;
    padding-top: 10px;
    padding-bottom: 10px;
    height: 35%;
    border-bottom: 2px solid #eee;
  }

  .bg-selected {
    background-color: #01d8da!important;
    color: #fff;
  }

  .services-holder {
    height: 200px;
    overflow-y: auto;
    border: 1px solid #eee;
    padding: 3px 2px;
  }

  #invoice-holder {
    height: 400px;
    overflow-y: auto;
    border: 1px solid #eee;
    padding: 3px 2px;
  }

  .total-fees-group {
    font-family: sans-serif;
  }

  #invoice-rows {
    font-size: 10pt;
    font-family: sans-serif;
  }

  .remove-invoice-row {
    color: #eee;
    cursor: pointer;
  }

  .remove-invoice-row:hover {
    color: red;
  }

  .invoice-qty {
    width: 40px;
    font-size: 9pt;
    border: 1px solid #eee;
  }

  .invoice-price {
    width: 60px;
    font-size: 9pt;
    border: 1px solid #eee;
  }

  .disabledContent {
    pointer-events: none;
    opacity: 0.4;
  }
</style>
<!-- Modal -->
<div class="modal fade" id="edit_appointment_modal" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title"><span style="padding-left: 15px;font-weight: bold;color: #008385;font-size: 14pt;" id="appointment_patient_name"></span></h5>
      </div>
      <div class="modal-body">
          <div class="row {{ App\Model\FeatureUser::is_feature_allowed('add_patient_detail', Auth::user()->id) }}">
              
              <div class="col-md-7" style="border-right:1px dashed #666;">
                  <div class="form-group col-md-12">
                    {{ Form::label('appointment_status', "What is the status of this appointment?") }}
                    {{ Form::select('appointment_status', array('Open' => 'Waiting', 'In Progress' => 'Service In Progress', 'Done' => 'Service Completed'), null, array('class' => 'form-control')) }}  
                  </div>

                  <div class="form-group col-md-6">
                    {{ Form::label('clinic', 'Clinic') }}
                    <select name="appointment_clinic" class='form-control'>
                      <option value='' disabled>Select Clinic</option>
                      @foreach($clinics as $clinic)
                      <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group col-md-6">
                    {{ Form::label('doctor', 'Doctor') }}
                    <select name="appointment_doctor" class='form-control'>
                      <option value='' disabled>Select Doctor</option>
                      @foreach($doctors as $doctor)
                      <option value="{{ $doctor->id }}">{{ $doctor->fullname }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group col-md-12">
                    <span id='labelServices'>{{ Form::label('service', 'Services') }}</span>
                    <div class="services-holder">
                      @foreach ($services as $key => $service)
                        <div class="col-md-3 text-center bg-light services" id="service{{ $key }}">{{ $service->name }}</div>
                      @endforeach
                    </div>
                  </div>

                  <div class="form-group col-md-12">
                    {{ Form::label('notes', 'Remarks') }}
                    {{ Form::textarea('notes', null, ['id' => 'notes','class' => 'form-control', 'rows' => 4, 'cols' => 54, 'placeholder' => 'Type your remarks', 'style' => 'resize:none']) }}
                  </div>

                  <div class="form-group col-md-12 {{ App\Model\FeatureUser::is_feature_allowed('add_appointment', Auth::user()->id) }} next-visit">
                    {{ Form::checkbox('checkbox_visit', 'Yes') }}
                    {{ Form::label('checkbox_visit', 'Next Visit') }}
                    <div class="row">
                      <div class="col-md-4">
                        {{ Form::text('appointment_schedule_date', null, array('id' => 'date_scheduled', 'class' => 'form-control', 'placeholder' => 'mm/dd/yyyy', 'disabled')) }}
                      </div>
                      <div class="col-md-4">
                        {{ Form::text('appointment_schedule_time', null, array('id' => 'time_scheduled', 'class' => 'form-control', 'placeholder' => '8:00 am', 'disabled')) }}
                      </div>
                    </div>
                  </div>

              </div>

              <div class="col-md-5">
                  <div class="row">
                    <div class="col-md-12">
                      <span id='labelInvoice'>{{ Form::label('invoice', 'Invoice') }}</span>
                      <div id="invoice-holder">
                        <table class="table table-striped" id="invoice-content">
                          <thead>
                            <th width="60%">Service</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th style="text-align:right">Amount</th>
                            <th>&nbsp;</th>
                          </thead>
                          <tbody id="invoice-rows">
                            
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group row total-fees-group">
                    <h2 class="col-md-4" style="color:#ccc;position: relative;top: -3px;">Total</h2>
                    <h2 class="col-md-8" id="total-fees" align="right">0.00</h2>
                  </div>

                  <div class="form-group amount-paid">
                    <br>
                    {{ Form::label('payment', 'Amount Paid') }}
                    {{ Form::number('payment', null, array('class' => 'form-control', 'placeholder' => 'Enter the amount paid')) }}
                  </div>
              </div>
             
          </div>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-default btn-round" data-dismiss="modal">Close</button>
            <a class="btn btn-primary btn-round" id="btn-save-changes"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save Changes</a>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function () {
  $("#date_scheduled").datepicker({
    minDate: 0
  });

  $("input[name='checkbox_visit']").click(function(){
      $("#date_scheduled").prop("disabled", !$(this).is(":checked"));
      $("#date_scheduled").val('');
      $("#time_scheduled").prop("disabled", !$(this).is(":checked"));
      $("#time_scheduled").val('');
  });
  
  $("select[name='appointment_status']").on('change', function() {
    if ($(this).val() == 'Done') {
        $("#labelServices").removeClass('disabledContent');
        $(".services-holder").removeClass('disabledContent');
        $(".next-visit").removeClass('disabledContent');
        $("#labelInvoice").removeClass('disabledContent');
        $("#invoice-holder").removeClass('disabledContent');
        $(".total-fees-group").removeClass('disabledContent');
        $(".amount-paid").removeClass('disabledContent');
    } else {
        $("#labelServices").addClass('disabledContent');
        $(".services-holder").addClass('disabledContent');
        $(".next-visit").addClass('disabledContent');
        $("#labelInvoice").addClass('disabledContent');
        $("#invoice-holder").addClass('disabledContent');
        $(".total-fees-group").addClass('disabledContent');
        $(".amount-paid").addClass('disabledContent');
    }
  });

  $("#add_patient_record").click(function(){
    $('select[name=clinic]').val(null);
    $('select[name=doctor]').val(null);

    $('#add_patient_record_modal').modal('show');
  });

  $(".services").unbind().click(function(){
    var service = $(this).text();
    var id = $(this).attr('id');
    var invoiceRowCount = $('#invoice-rows tr').length;

    $(this).addClass('bg-selected');
    $(this).addClass('service-selected');

    $("#invoice-rows").append("<tr id='invoice-row"+invoiceRowCount+"' data-invoice_service='"+service+"' data-service_id='"+id+"' data-row_count='"+invoiceRowCount+"' class='invoice-item'>\
      <td>"+service+"</td>\
      <td style='text-align:right'>\
        <input type='number' value=1 class='invoice-qty' id='invoice-qty"+invoiceRowCount+"' min='1' onchange='calculate("+invoiceRowCount+")' />\
      </td>\
      <td style='text-align:right'>\
        <input type='number' value=0 class='invoice-price' id='invoice-price"+invoiceRowCount+"' min='0.0' onchange='calculate("+invoiceRowCount+")' />\
      </td>\
      <td style='text-align:right'><span id='invoice-amount"+invoiceRowCount+"' class='amount' data-amount='0'>0</span></td>\
      <td style='text-align:right'><i class='fa fa-trash remove-invoice-row' onclick='deleteRow("+invoiceRowCount+")' aria-hidden='true'></i></td>\
      </tr>");
  });
});

function deleteRow(id) {
  var service = document.getElementById("invoice-row"+id).dataset.service;
  var service_id = document.getElementById("invoice-row"+id).dataset.service_id;
  var services_count = document.querySelectorAll("[data-invoice_service='"+service+"']").length;

  if (services_count == 0) {
    document.getElementById(service_id).classList.remove("bg-selected");
    document.getElementById(service_id).classList.remove("service-selected");
  }

  document.getElementById("invoice-row"+id).remove();

  calculateTotal();
}

function calculate(id) {
  var qty = document.getElementById("invoice-qty"+id).value;
  var price = document.getElementById("invoice-price"+id).value;

  var amount = qty * price;

  document.getElementById("invoice-amount"+id).dataset.amount = amount;
  document.getElementById("invoice-amount"+id).innerHTML = numberWithCommas(amount);

  calculateTotal();
}

function calculateTotal() {
  var total = 0;

  var amounts = document.getElementsByClassName("amount");

  for (var i = 0; i < amounts.length; i++) {
     total += parseFloat(amounts.item(i).dataset.amount);
  }

  total = parseFloat(total).toFixed(2);

  document.getElementById("total-fees").innerHTML = numberWithCommas(total);
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
</script>