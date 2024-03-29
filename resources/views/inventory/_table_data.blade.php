<table class="table table-striped">
  <thead>
    <th width="300">Name</th>
    <th width="300">Quantity</th>
    <th width="300" class="text-right">More Options</th>
  </thead>
  <?php foreach ($inventories as $inventory_key => $inventory_item): ?>
  <tr>
    <td>{{ $inventory_item->name }}</td>
    <td>
        <span class="inventory-qty" style="font-family: sans-serif;">{{ $inventory_item->qty }}</span>

        @if($inventory_item->qty == 0)
            <br><span style="font-size:8pt;font-family: sans-serif;color: red;">Out of stock</span>
        @endif
    </td>
    <td>
        <div class="pull-right">
          <a class="add_qty {{ App\Model\FeatureUser::is_feature_allowed('add_qty', Auth::user()->id) }}" data-name="{{ $inventory_item->name }}"><i class="fa fa-box" aria-hidden="true"></i> Add</a>

          |

          <a class="add_by_sku {{ App\Model\FeatureUser::is_feature_allowed('add_by_sku', Auth::user()->id) }}" data-name="{{ $inventory_item->name }}"><i class="fa fa-boxes" aria-hidden="true"></i> Add Multiple Sku</a>

          |

          @if($inventory_item->qty > 0)
          <a class="inventory-out {{ App\Model\FeatureUser::is_feature_allowed('inventory_out', Auth::user()->id) }}" data-name="{{ $inventory_item->name }}"><i class="fa fa-clipboard-list" aria-hidden="true"></i> View</a>
          @else
           <a class="hide-inventory {{ App\Model\FeatureUser::is_feature_allowed('hide_inventory', Auth::user()->id) }}" data-name="{{ $inventory_item->name }}"><i class="fa fa-trash-o" aria-hidden="true"></i> Remove</a>
          @endif

          |

          <a class="inventory-history {{ App\Model\FeatureUser::is_feature_allowed('inventory_history', Auth::user()->id) }}" data-name="{{ $inventory_item->name }}"><i class="fa fa-history" aria-hidden="true"></i> Transaction History</a>
        </div>
    </td>
  </tr>
  <?php endforeach; ?>

  @if($inventories->count() == 0)
  <tr>
    <td align="center" colspan="3">No record found.</td>
  </tr>
  @endif
</table>