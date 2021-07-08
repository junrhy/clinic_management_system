@extends('layouts.app')

@section('page_level_css')
<style type="text/css">
    .transaction-history, .inventory-out {
        color: #666;
        cursor: pointer;
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
                        <h2>More Filters <small class="text-muted">More ways to search your inventories.</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item"><a href="/inventory">Inventory List</a></li>
                            <li class="breadcrumb-item active"><strong style="color:#fff;">More Filters</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">More Filters</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <th width="200">Name</th>
                                    <th width="100">Sku</th>
                                    <th width="20" class="text-center">Quantity</th>
                                    <th width="100">Inventory Value</th>
                                    <th width="100" class="text-right">Action</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" class="search form-control" data-colname="name" placeholder="Search Name"></td>
                                        <td><input type="text" class="search form-control" data-colname="sku" placeholder="Search Sku"></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <?php foreach ($inventories as $inventory_key => $inventory_item): ?>
                                    
                                    <tr>
                                        <td>{{ $inventory_item->name }}</td>
                                        <td>
                                            {{ $inventory_item->sku }}

                                            @if($inventory_item->sku == "")
                                                <small>( No sku specified )</small>
                                            @endif
                                        </td>
                                        <td align="center">{{ $inventory_item->qty }}</td>
                                        <td>&#8369; {{ number_format($inventory_item->price, 2) }}</td>
                                        <td align="right">
                                            <?php 
                                                $sku = $inventory_item->sku != "" ? $inventory_item->sku : "n/a";
                                             ?>
                                            <a href="{{ url('inventory/show/'.$inventory_item->name) }}?sku={{ $sku }}" class="transaction-history"><i class="fa fa-history" aria-hidden="true"></i> Transaction History</a>
                                            |
                                            <a href="{{ url('/inventory/inventory_out') }}/{{ $inventory_item->name }}?sku={{ $sku }}" class="inventory-out"><i class="fa fa-box-open" aria-hidden="true"></i> Inventory Out</a>
                                        </td>
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
