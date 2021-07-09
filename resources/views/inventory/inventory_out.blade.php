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

    .location-link {
        color: #00cfd1;
    }

    #txt-search {
        border: 1px solid #00cfd1;
    }

    #btn-search {
        padding: 5px 10px;
        border-radius: 0;
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
                        <h2>View Inventory <small class="text-muted">View the details of the inventories</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item"><a href="/inventory">Inventory List</a></li>
                            <li class="breadcrumb-item active"><strong style="color:#fff;">View Inventory</strong></li>
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
                            <div>
                                <input type="text" name="search" class="col-md-2" id="txt-search" placeholder="Search Sku">
                                <input type="submit" class="btn btn-primary" id="btn-search" value="Go!">
                                <br><br>
                            </div>
                            <div class="table-responsive" id="tableData">
                                @include('inventory._inv_out_table_data')
                            </div>
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
        var price = $(this).data('price');
        var expire_at = $(this).data('expire_at');
        var location = $(this).data('location');

        var old_qty = $(this).data('old_qty');
        var qty = $(this).prev(".qty").val();

        if (qty == '' || qty == 0 || qty > old_qty) {
            $(this).prev(".qty").val(0);
            return false;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to remove " + qty + " " + name + " from " + location + ". Do you want to proceed?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, proceed.'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: "POST",
                    url: "/inventory_out/update",
                    data: { 
                        name: name,
                        sku: sku,
                        qty: qty,
                        price: price,
                        expire_at: expire_at,
                        location: location,
                        _token: "{{ csrf_token() }}" 
                    }
                })
                .done(function( data ) {
                    Swal.fire(
                        'Updated!',
                        'Record has been updated.',
                        'success'
                    ).then((result) => {
                        window.location.reload();
                    });
                });
            }
        });

    });


    $("#btn-search").click(function(){
        keyword = $("#txt-search").val();

        $.ajax({
          method: "POST",
          url: "/inventory_out/search",
          data: { 
            name: "{{ $name }}",
            keyword: keyword,
            _token: "{{ csrf_token() }}" 
          }
        })
        .done(function( data ) {
          $("#tableData").html(data);
        });
    });

    $("#txt-search").on('keyup', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) { 
            $("#btn-search").click();
        }
    });
});

</script>
@endsection

