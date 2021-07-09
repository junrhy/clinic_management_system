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

  .add_qty {
    color: #666;
    cursor: pointer;
  }

  .add_by_sku {
    color: #666;
    cursor: pointer;
  }

  .inventory-history {
    color: #666;
    cursor: pointer;
  }

  .inventory-out {
    color: #666;
    cursor: pointer;
  }

  .hide-inventory {
    color: #ccc;
    cursor: pointer;
  }

  .hide-inventory:hover {
    color: red;
    cursor: pointer;
  }

  .namelist {
    cursor:pointer;
  }

  .font-weight-bold {
    font-weight:bold;
    font-size:14pt;
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
                      <div>
                        <input type="text" name="search" class="col-md-2" id="txt-search" placeholder="Search Name">
                        <input type="submit" class="btn btn-primary" id="btn-search" value="Go!">
                      </div>
                      <br>
                      <table width="100%">
                        <tr>
                          <td width="3.7%" class="namelist text-center" data-list="all">All</td>

                          <td width="3.7%" class="namelist text-center" data-list="A">A</td>
                          <td width="3.7%" class="namelist text-center" data-list="B">B</td>
                          <td width="3.7%" class="namelist text-center" data-list="C">C</td>
                          <td width="3.7%" class="namelist text-center" data-list="D">D</td>
                          <td width="3.7%" class="namelist text-center" data-list="E">E</td>
                          <td width="3.7%" class="namelist text-center" data-list="F">F</td>
                          <td width="3.7%" class="namelist text-center" data-list="G">G</td>
                          <td width="3.7%" class="namelist text-center" data-list="H">H</td>
                          <td width="3.7%" class="namelist text-center" data-list="I">I</td>
                          <td width="3.7%" class="namelist text-center" data-list="J">J</td>
                          <td width="3.7%" class="namelist text-center" data-list="K">K</td>
                          <td width="3.7%" class="namelist text-center" data-list="L">L</td>
                          <td width="3.7%" class="namelist text-center" data-list="M">M</td>
                          <td width="3.7%" class="namelist text-center" data-list="N">N</td>
                          <td width="3.7%" class="namelist text-center" data-list="O">O</td>
                          <td width="3.7%" class="namelist text-center" data-list="P">P</td>
                          <td width="3.7%" class="namelist text-center" data-list="Q">Q</td>
                          <td width="3.7%" class="namelist text-center" data-list="R">R</td>
                          <td width="3.7%" class="namelist text-center" data-list="S">S</td>
                          <td width="3.7%" class="namelist text-center" data-list="T">T</td>
                          <td width="3.7%" class="namelist text-center" data-list="U">U</td>
                          <td width="3.7%" class="namelist text-center" data-list="B">V</td>
                          <td width="3.7%" class="namelist text-center" data-list="W">W</td>
                          <td width="3.7%" class="namelist text-center" data-list="X">X</td>
                          <td width="3.7%" class="namelist text-center" data-list="Y">Y</td>
                          <td width="3.7%" class="namelist text-center" data-list="Z">Z</td>
                        </tr>
                      </table>
                    <br>
                    <div class="table-responsive" id="tableData">
                        @include('inventory._table_data')
                    </div>
                    <div align="center">{{ $inventories->appends(['namelist' => $namelist])->links() }}</div>
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
    $(".add_qty").unbind().click(function(){
        var name = $(this).data('name');

        window.location.href = "inventory/create/?name="+name;
    });

    $(".add_by_sku").unbind().click(function(){
        var name = $(this).data('name');

        window.location.href = "/inventory/add_by_sku/"+name;
    });

    $(".inventory-out").unbind().click(function(){
        var name = $(this).data('name');

        window.location.href = "/inventory/inventory_out/"+name;
    });

    $(".inventory-history").unbind().click(function(){
        var name = $(this).data('name');

        window.location.href = "/inventory/show/"+name;
    });

    $(".hide-inventory").unbind().click(function(){
        var name = $(this).data('name');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: "POST",
                    url: "/hide-inventory",
                    data: { 
                        name: name,
                        _token: "{{ csrf_token() }}" 
                    }
                })
                .done(function( data ) {
                    Swal.fire(
                        'Removed!',
                        'Inventory has been removed.',
                        'success'
                    ).then((result) => {
                        location.reload();
                    });
                });
            }
        });

        
    });

    $("#btn-search").click(function(){
        keyword = $("#txt-search").val();

        $.ajax({
          method: "POST",
          url: "/inventory/search",
          data: { 
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

    $(".namelist").unbind().click(function(){
        if ($(this).data('list') != 'all') {
          location.href = '{{ Request::url() }}?namelist=' + $(this).data('list');
        } else {
          location.href = '{{ Request::url() }}';
        }
    });

    $(function(){
        $('.namelist').each(function(i, obj) {
            if ($(this).data('list') == "{{ app('request')->namelist }}") {
              $('.namelist').removeClass('font-weight-bold');
              $(this).addClass('font-weight-bold');
              return false;
            } else {
              $('.namelist').first().addClass('font-weight-bold');
            }
        });
    });
});
</script>
@endsection
