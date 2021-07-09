<table class="table table-striped">
    <thead>
        <tr>
            <th width="160">Transaction Date <i class="fa fa-sort-down" aria-hidden="true"></i></th>
            <th width="200">Name</th>
            <th width="100">Status</th>
            <th width="200">Sku</th>
            <th width="100">Quantity</th>
            <th width="100">Cost Per Unit</th>
            <th width="200">Expiration Date</th>
            <th width="200">Location</th>
            <th width="200">Created By</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($inventories as $inventory_key => $inventory_item): ?>
        <tr>
            <td><span style="font-family:sans-serif;">{{ $inventory_item->created_at->format('M d, Y') }} - {{ $inventory_item->created_at->format('h:ia') }}</span></td>
            <td>{{ $inventory_item->name }}</td>
            <td>{{ $inventory_item->status }}</td>
            <td>
                {{ $inventory_item->sku }}

                @if($inventory_item->sku == "")
                    <small>( No sku specified )</small>
                @endif
            </td>
            <td>{{ $inventory_item->qty }}</td>
            <td>&#8369; {{ number_format($inventory_item->price, 2) }}</td>
            <td>
                @if($inventory_item->expire_at != null)
                {{ $inventory_item->expire_at->format('M d, Y') }}
                @endif
            </td>
            <td>{{ $inventory_item->location }}</td>
            <td>{{ $inventory_item->created_by }}</td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>