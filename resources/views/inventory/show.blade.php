@extends('layouts.app')

@section('page_level_css')
<style type="text/css">
  .inventory-name {
    color: #018d8e;
    font-size: 12pt;
    font-family: sans-serif;
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
                        <h2>Inventory Transaction History <small class="text-muted">The inventory transactions of this stock.</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item"><a href="/inventory">Inventory List</a></li>
                            <li class="breadcrumb-item active"><strong style="color:#fff;">Inventory Transaction History</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Inventory name: <span class="inventory-name">{{ $name }}</span></div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="200">Transaction Date</th>
                                        <th width="100">Status</th>
                                        <th width="200">Sku</th>
                                        <th width="100">Quantity</th>
                                        <th width="200">Price Per Piece (PPP)</th>
                                        <th width="200">Expiration Date</th>
                                        <th width="200">Location</th>
                                        <th width="200">Created By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($inventories as $inventory_key => $inventory_item): ?>
                                    <tr>
                                        <td><span style="font-family:sans-serif;">{{ $inventory_item->created_at->format('M d, Y') }} - {{ $inventory_item->created_at->format('h:ia') }}</span></td>
                                        <td>{{ $inventory_item->status }}</td>
                                        <td>
                                            {{ $inventory_item->sku }}

                                            @if($inventory_item->sku == "")
                                                {{ $name }}
                                            @endif
                                        </td>
                                        <td>{{ $inventory_item->qty }}</td>
                                        <td>{{ $inventory_item->price }}</td>
                                        <td>
                                            @if($inventory_item->expire_at != null)
                                            {{ $inventory_item->expire_at->format('M d, Y') }}
                                            @endif
                                        </td>
                                        <td>{{ $inventory_item->location_id }}</td>
                                        <td>{{ $inventory_item->created_by }}</td>
                                    </tr>
                                    <?php endforeach; ?>
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
