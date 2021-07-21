@extends('layouts.admin')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>
@endsection

@section('page_level_css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>

<style type="text/css">
  .remove-client {
    color: #ccc;
    text-decoration: none;
    cursor: pointer;
  }

  .remove-client:hover {
    color: red;
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
                        <h2>Inactive Clients <small class="text-muted">Manage web app inactive clients</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-home"></i> Admin Panel</a></li>
                            <li class="breadcrumb-item active">Inactive Clients</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Clients</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>No. of Patients</th>
                                    <th>No. of Inventory</th>
                                    <th>Last active</th>
                                    <th>Inactive for</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $counter = 1; ?>

                                @foreach($clients as $key => $client)
                                    @if($client->users->max('last_active_at') && 
                                        $client->users->max('last_active_at')->diffInDays(\Carbon\Carbon::now()) > 30)
                                    <tr>
                                        <td>{{ $counter++ }}</td>
                                        <td>{{ $client->name }}</td>
                                        <td>{{ count($client->patients) }}</td>
                                        <td>{{ $client->inventories->sum('qty') }}</td>
                                        <td style="font-family:sans-serif;">
                                            @if($client->users->max('last_active_at'))
                                                {{ $client->users->max('last_active_at')->format('M d, Y') }}&nbsp;&nbsp;
                                                {{ $client->users->max('last_active_at')->format('h:i a') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($client->users->max('last_active_at'))
                                                {{ $client->users->max('last_active_at')->diffInDays(\Carbon\Carbon::now()) }} Days
                                            @endif
                                        </td>
                                        <td>
                                            <a class="remove-client" data-id="{{ $client->id }}"><i class="fa fa-trash-o"></i> Delete</a>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
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
    $(".remove-client").unbind().click(function(){
        id = $(this).data('id');

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
              url: "/admin/delete_client",
              data: { 
                id: id,
                _token: "{{ csrf_token() }}" 
              }
            })
            .done(function( msg ) {
              Swal.fire(
                'Deleted!',
                'Client has been deleted.',
                'success'
              ).then((result) => {
                location.reload();
              });
            });
          }
        })
    });
});
</script>
@endsection