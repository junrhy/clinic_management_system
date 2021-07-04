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
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>Inventory Out <small class="text-muted">Decrease inventory quantity from the system</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item"><a href="/inventory">Inventory List</a></li>
                            <li class="breadcrumb-item active"><strong style="color:#fff;">Inventory Out</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Inventory name: <strong class="inventory-name">{{ $name }}</strong></div>

                <div class="panel-body">
                  <div class="row" style="color: red;">
                       {{ Html::ul($errors->all()) }}
                  </div>

                  <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="200">Sku</th>
                                        <th width="100">Quantity</th>
                                        <th width="200" style="text-align: right;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($inventories->sum('qty') >  0)
                                    <?php foreach ($inventories as $inventory_key => $inventory_item): ?>
                                    @if($inventory_item->qty > 0)
                                    <tr>
                                        <td>
                                            {{ $inventory_item->sku }}

                                            @if($inventory_item->sku == "")
                                                {{ $name }}
                                            @endif
                                        </td>
                                        <td>{{ $inventory_item->qty }}</td>
                                        <td align="right">
                                            Enter Quantity: 
                                            <input type="number" name="inv_out_qty" value=0 step="0.5" min="0" class="qty" style="width: 50px;text-align: center;">
                                            <button data-name="{{ $name }}" data-sku="{{ $inventory_item->sku }}" data-old_qty="{{ $inventory_item->qty }}" class="btn-out">Out</button>
                                        </td>
                                    </tr>
                                    @endif
                                    <?php endforeach; ?>
                                @else
                                    <tr>
                                        <td colspan="3" align="center" style="color: red;">Out of Stock</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
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
    $(".btn-out").unbind().click(function(){
        var name = $(this).data('name');
        var sku = $(this).data('sku');
        var old_qty = $(this).data('old_qty');
        var qty = $(this).prev(".qty").val();

        if (qty == '' || qty == 0 || qty > old_qty) {
            $(this).prev(".qty").val(0);
            return false;
        }

        $.ajax({
            method: "POST",
            url: "/inventory_out/update",
            data: { 
                name: name,
                sku: sku,
                qty: qty,
                _token: "{{ csrf_token() }}" 
            }
        })
        .done(function( data ) {
            Swal.fire(
                'Updated!',
                'Record has been updated.',
                'success'
            ).then((result) => {
                location.reload();
            });
        });
    });
});

</script>
@endsection

