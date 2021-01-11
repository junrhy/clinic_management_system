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

  .delete-clinic, .update-clinic {
    color: gray;
  }

  .delete-clinic:hover {
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
                        <h2>All Clinics <small class="text-muted">List of your clinic's</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <a class="btn btn-white btn-icon btn-round float-right m-l-10 {{ App\Model\FeatureUser::is_feature_allowed('add_clinic', Auth::user()->id) }}" href="{{ url('clinic/create') }}" type="button">
                            <i class="fa fa-plus"></i>
                        </a>

                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item">Clinics</li>
                            <li class="breadcrumb-item active">All Clinics</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">All Clinics</div>

                <div class="panel-body">
                    Listing: {{ $clinics->count() }}
                    <div class="responsive">
                      <table class="table">
                        <tr>
                          <th>Name</th>
                          <th>Address</th>
                          <th class="text-right">Action</th>
                        </tr>
                        <?php foreach ($clinics as $clinic_key => $clinic_item): ?>
                        <tr>
                          <td>{{ $clinic_item->name }}</td>
                          <td>{{ $clinic_item->address }}</td>
                          <td>
                              <div class="pull-right">
                                <a class="update-clinic {{ App\Model\FeatureUser::is_feature_allowed('edit_clinic', Auth::user()->id) }}" href="{{ route('clinic.edit',$clinic_item->id) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a> | 

                                <a class="delete-clinic {{ App\Model\FeatureUser::is_feature_allowed('delete_clinic', Auth::user()->id) }}" data-id="{{ $clinic_item->id }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
@endsection

@section('page_level_footer_script')

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

<script type="text/javascript">
$(document).ready(function() {
  $(".delete-clinic").unbind().click(function(){
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
            url: "/clinic/" + id,
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

