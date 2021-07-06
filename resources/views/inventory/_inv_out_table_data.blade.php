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
                    <small>( No sku specified )</small>
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
            <td colspan="3" align="center">No record found.</td>
        </tr>
    @endif
    </tbody>
</table>