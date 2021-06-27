@extends('layouts.app')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>
@endsection

@section('page_level_css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>

<style type="text/css">
  .inventory-name {
    color: #018d8e;
    font-size: 12pt;
  }

  .cancel-row {
    color: #ccc;
  }

  .cancel-row:hover {
    color: red;
  }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>Inventory In <small class="text-muted">Add more on this inventory name</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item active"><strong style="color:#fff;">Inventory In</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Inventory name: <strong class="inventory-name">{{ $name }}</strong></div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            {{ Form::open(array('url' => 'inventory_in/store')) }}
                            <table id="inventory_in" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th width="300">Sku</th>
                                        <th width="100">Quantity</th>
                                        <th width="200">Price</th>
                                        <th width="200">Expiration Date</th>
                                        <th width="300">Location</th>
                                        <th width="20"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="inventory-name">{{ $name }}</td>
                                        <td>{{ Form::text('sku', null, array('class' => 'form-control')) }}</td>
                                        <td>{{ Form::number('qty', null, array('class' => 'form-control', 'step' => '0.1')) }}</td>
                                        <td>{{ Form::number('price', null, array('class' => 'form-control', 'step' => '0.1')) }}</td>
                                        <td>{{ Form::text('expire_at', null, array('class' => 'form-control')) }}</td>
                                        <td>{{ Form::text('location', null, array('class' => 'form-control')) }}</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            <button id="add-more" class="btn btn-default float-right" style="margin-left: 10px;outline:0;">
                                <i class='fa fa-plus' aria-hidden='true'></i></span> Add More
                            </button>

                            <input type="submit" name="Submit" class="btn btn-primary">
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page_level_footer_script')

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

<script type="text/javascript">
$(document).ready(function() {
    $(function(){
        apply_calendar();
    });

    function apply_calendar() {
        $("input[name='expire_at']").datepicker({  
            minDate: '0',
            format: 'mm/dd/yyyy',
            changeMonth: true,
            changeYear: true,
            // isRTL: true
        });
    }

    $("#add-more").click(function(){
        $("form").submit(function(e){
            e.preventDefault();
        });

        var new_row = "<tr><td class='inventory-name'>{{ $name }}</td><td><input type='text' name='sku' value='' class='form-control' /></td><td><input type='number' name='qty' value='' class='form-control' step='0.1' /></td><td><input type='number' name='price' value='' class='form-control' step='0.1' /></td><td><input type='text' name='expire_at' value='' class='form-control' /></td><td><input type='text' name='location' value='' class='form-control' /></td><td  style='text-align: center;padding-top: 10px;padding-right: 15px;font-size: 14pt;cursor:pointer;'><span class='cancel-row' onclick='cancelThisRow(this)'><i class='fa fa-minus' aria-hidden='true'></i></span></td></tr>";

        $("#inventory_in tbody").append(new_row);

        apply_calendar();
    });
});

// event listener pure javascript code
function cancelThisRow(element){
    //console.log(element.parentNode.parentNode.remove());
    element.parentNode.parentNode.remove();
};
</script>
@endsection
