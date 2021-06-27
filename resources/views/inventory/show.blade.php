@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>Inventory In <small class="text-muted">Add more to this inventory</small></h2>
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
                <div class="panel-heading">Inventory In</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Sku</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Expiration Date</th>
                                        <th>Location</th>
                                        <th>Added On</th>
                                        <th>Added By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($inventories as $inventory_key => $inventory_item): ?>
                                    <tr>
                                        <td>{{ $inventory_item->name }}</td>
                                        <td>{{ $inventory_item->sku }}</td>
                                        <td>{{ $inventory_item->qty }}</td>
                                        <td>{{ $inventory_item->price }}</td>
                                        <td>
                                            @if($inventory_item->expire_at != null)
                                            {{ $inventory_item->expire_at->format('m-d-Y') }}
                                            @endif
                                        </td>
                                        <td>{{ $inventory_item->location_id }}</td>
                                        <td>{{ $inventory_item->created_at->format('M-d-Y') }}</td>
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
