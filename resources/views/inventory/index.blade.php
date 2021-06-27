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

  .inventory-qty {
    font-size: 12pt;
  }

  .increase-inventory {
    color: #01d8da;
    font-size: 14pt;
    cursor: pointer;
  }

  .decrease-inventory {
    color: #666;
    font-size: 14pt;
    cursor: pointer;
  }

  .hide-inventory {
    color: #ccc;
    font-size: 14pt;
    cursor: pointer;
  }

  .hide-inventory:hover {
    color: red;
    cursor: pointer;
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
                        <h2>Inventory <small class="text-muted">List of all inventories</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <a class="btn btn-white btn-icon btn-round float-right m-l-10 {{ App\Model\FeatureUser::is_feature_allowed('add_inventory', Auth::user()->id) }}" href="{{ url('inventory/create') }}" type="button">
                            <i class="fa fa-plus"></i>
                        </a>

                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item active"><strong style="color:#fff;">Inventory</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Inventory</div>

                <div class="panel-body">
                  <div>
                     @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                     @endif      
                  </div>

                  <div class="row col-md-12 table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <th>Name</th>
                        <th width="300">Quantity</th>
                        <th width="300" class="text-right">Action</th>
                      </thead>
                      <?php foreach ($inventories as $inventory_key => $inventory_item): ?>
                      <tr>
                        <td><a class="inventory-name" href="{{ url('inventory/show/'.$inventory_item->name) }}">{{ $inventory_item->name }}</a></td>
                        <td>
                            <span class="inventory-qty" style="font-family: sans-serif;">{{ $inventory_item->qty }}</span>

                            @if($inventory_item->qty == 0)
                                <br><span style="font-size:8pt;font-family: sans-serif;color: red;">Out of stock</span>
                            @endif
                        </td>
                        <td>
                            <div class="pull-right">
                              <a class="increase-inventory {{ App\Model\FeatureUser::is_feature_allowed('increase_inventory', Auth::user()->id) }}" data-name="{{ $inventory_item->name }}"><i class="fa fa-plus" aria-hidden="true"></i></a>

                              |

                              @if($inventory_item->qty > 0)
                              <a class="decrease-inventory {{ App\Model\FeatureUser::is_feature_allowed('decrease_inventory', Auth::user()->id) }}" data-name="{{ $inventory_item->name }}"><i class="fa fa-minus" aria-hidden="true"></i></a>
                              @else
                               <a class="hide-inventory {{ App\Model\FeatureUser::is_feature_allowed('hide_inventory', Auth::user()->id) }}" data-name="{{ $inventory_item->name }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                              @endif
                            </div>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                    </table>
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
    $(".increase-inventory").unbind().click(function(){
        var name = $(this).data('name');

        window.location.href = "/inventory/increase/"+name;
    });

    $(".decrease-inventory").unbind().click(function(){
        var name = $(this).data('name');

        alert("decreased! " + name);
    });

    $(".hide-inventory").unbind().click(function(){
        var name = $(this).data('name');

        alert("hide! " + name);
    });
});
</script>
@endsection
