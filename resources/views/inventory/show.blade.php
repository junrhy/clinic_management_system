@extends('layouts.app')

@section('page_level_css')
<style type="text/css">
  .inventory-name {
    color: #018d8e;
    font-size: 12pt;
    font-family: sans-serif;
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
                        <h2>Transaction History <small class="text-muted">The transaction history of this stock.</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item"><a href="/inventory">Inventory List</a></li>
                            <li class="breadcrumb-item active"><strong style="color:#fff;">Transaction History</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Inventory name: <span class="inventory-name">{{ $name }}</span></div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <input type="text" name="search" value="{{ isset($_GET['sku']) ? $_GET['sku'] : '' }}" class="col-md-2" id="txt-search" placeholder="Search Sku">
                            <input type="submit" class="btn btn-primary" id="btn-search" value="Go!">
                        </div>
                        <br><br>
                        <div class="col-md-12 table-responsive" id="tableData">
                            @include('inventory._show_table_data')
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
    $("#btn-search").click(function(){
        sku = $("#txt-search").val();

        location.href = "{{ url('inventory/show/'.$name) }}?sku="+sku;
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
