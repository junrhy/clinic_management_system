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
        <div class="col-md-12">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>Service <small class="text-muted">List of your clinic services</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <a class="btn btn-white btn-icon btn-round float-right m-l-10 {{ App\Model\FeatureUser::is_feature_allowed('add_service', Auth::user()->id) }}" href="{{ url('service/create') }}" type="button">
                            <i class="fa fa-plus"></i>
                        </a>

                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item active"><strong style="color:#fff;">Services</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-user-md"></i> Services</div>

                <div class="panel-body">
                  <div class="row col-md-3 table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <th>Name</th>
                        <th class="text-right">Action</th>
                      </thead>
                      <?php foreach ($services as $service_key => $service_item): ?>
                      <tr>
                        <td>{{ $service_item->name }}</td>
                        <td>
                            <div class="pull-right">
                              <a class="update-service {{ App\Model\FeatureUser::is_feature_allowed('edit_service', Auth::user()->id) }}" href="{{ route('service.edit',$service_item->id) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a> | 

                              <a class="delete-service {{ App\Model\FeatureUser::is_feature_allowed('delete_service', Auth::user()->id) }}" data-id="{{ $service_item->id }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
</div>
@if( App\Model\FeatureUser::is_feature_allowed('services', Auth::user()->id) == 'hidden' )
<div class="modalOverlay"></div>
@endif
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
