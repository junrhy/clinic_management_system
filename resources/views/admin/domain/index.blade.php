@extends('layouts.admin')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>
@endsection

@section('page_level_css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>

<style type="text/css">
  .delete_domain {
    color: gray;
  }

  .delete_domain:hover {
    text-decoration: none;
    cursor: pointer;
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
                        <h2>Domains <small class="text-muted">Manage web app domains</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <a class="btn btn-white btn-icon btn-round float-right m-l-10" href="/admin/domain/create" type="button">
                            <i class="fa fa-plus"></i>
                        </a>

                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-home"></i> Admin Panel</a></li>
                            <li class="breadcrumb-item active">Domains</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Domains</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Domain Name</th>
                                    <th>Client Name</th>
                                    <th>Parameters</th>
                                    <th>Distributor Code</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($domains as $domain)
                                <tr>
                                    <td>{{ $domain->domain_name }}</td>
                                    <td>{{ $domain->client_id != 0 ? $domain->client->name : 'default' }}</td>
                                    <td>{{ $domain->params }}</td>
                                    <td>{{ $domain->distributor_code }}</td>
                                    <td>
                                       <a class="delete_domain" data-id="{{ $domain->id }}"><i class="fa fa-trash-o"></i> Delete</a>
                                   </td>
                                </tr>
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

    $(".delete_domain").unbind().click(function(){
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
                method: "DELETE",
                url: "/admin/domain/delete/" + id,
                data: { 
                  _token: "{{ csrf_token() }}" 
                }
              })
              .done(function( msg ) {
                Swal.fire(
                  'Deleted!',
                  'Domain has been deleted.',
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