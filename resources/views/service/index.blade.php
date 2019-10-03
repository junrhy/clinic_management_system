@extends('layouts.app')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>
@endsection

@section('page_level_css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>

<style type="text/css">
  .link:hover {
    text-decoration: none;
  }

  .delete-service, .update-service {
    color: gray;
  }

  .delete-service:hover {
    color: red;
    text-decoration: none;
  }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-user-md"></i> Services</div>

                <div class="panel-body">
                    <a class="btn btn-primary btn-round" href="{{ url('service/create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
                    <br><br>
                    <table class="table">
                      <tr>
                        <th>Name</th>
                        <th class="text-right">Action</th>
                      </tr>
                      <?php foreach ($services as $service_key => $service_item): ?>
                      <tr>
                        <td>{{ $service_item->name }}</td>
                        <td>
                            <div class="pull-right">
                              <a class='update-service' href="{{ route('service.edit',$service_item->id) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a> | 
                              <a class="delete-service" data-id="{{ $service_item->id }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </div>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                    </table>

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
  $(".delete-service").unbind().click(function(){
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
            url: "/service/" + id,
            data: { 
              _token: "{{ csrf_token() }}" 
            }
          })
          .done(function( msg ) {
            Swal.fire(
              'Deleted!',
              'Service has been deleted.',
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
