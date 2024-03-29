<table class="table table-striped">
    <thead>
        <tr>
            <th width="200">Name</th>
            <th width="200">Sku</th>
            <th width="100">Quantity</th>
            <th width="100">Cost Per Unit</th>
            <th width="100">Expiration Date</th>
            <th width="200">Location</th>
            <th width="200" style="text-align: right;">Action</th>
        </tr>
    </thead>
    <tbody>
    @if($inventories->count() >  0)
        <?php foreach ($inventories as $inventory_key => $inventory_item): ?>

        <tr>
            <td>{{ $inventory_item->name }}</td>
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
            <td align="right">
                Enter Quantity: 
                <input type="number" name="inv_out_qty" value=0 step="0.5" min="0" class="qty" style="width: 50px;text-align: center;">
                <button data-name="{{ $name }}" 
                        data-sku="{{ $inventory_item->sku }}" 
                        data-old_qty="{{ $inventory_item->qty }}"
                        data-price="{{ $inventory_item->price }}"
                        data-expire_at="{{ $inventory_item->expire_at != null ? $inventory_item->expire_at->format('Y-m-d') : '' }}" 
                        data-location="{{ $inventory_item->location }}"
                class="btn-out">Out</button>
            </td>
        </tr>

        <?php endforeach; ?>
    @else
        <tr>
            <td colspan="7" align="center">No record found.</td>
        </tr>
    @endif
    </tbody>
</table>