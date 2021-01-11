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

  .delete-user, .update-user {
    color: gray;
  }

  .delete-user:hover {
    color: red;
    text-decoration: none;
  }

  .show-privileges {
    color: #01d8da;
    
  }

  .show-privileges:hover, .show-privileges:visited, .show-privileges:active, .show-privileges:focus {
    color: #01d8da;
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
                        <h2>All Users <small class="text-muted">Users who can access this system</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <a class="btn btn-white btn-icon btn-round float-right m-l-10 {{ App\Model\FeatureUser::is_feature_allowed('add_user', Auth::user()->id) }}" href="{{ url('user/create') }}" type="button">
                            <i class="fa fa-plus"></i>
                        </a>

                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item">Users</li>
                            <li class="breadcrumb-item active">All Users</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">All Users</div>

                <div class="panel-body">
                  Listing: {{ $users->count() }}
                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Privileges</th>
                        <th class="text-right">Action</th>
                      </tr>
                      <?php foreach ($users as $user_key => $user_item): ?>
                      <tr>
                        <td>{{ $user_item->first_name }}</td>
                        <td>{{ $user_item->last_name }}</td>
                        <td>{{ $user_item->username }}</td>
                        <td>{{ $user_item->email }}</td>
                        <td>
                          <a class="show-privileges" href="{{ route('user.show',$user_item->id) }}">Show Privileges</a>
                        </td>
                        <td>
                            <div class="pull-right">
                              @if($user_item->username != auth()->user()->username)
                                <a class="update-user {{ App\Model\FeatureUser::is_feature_allowed('edit_user', Auth::user()->id) }}" href="{{ route('user.edit',$user_item->id) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a> | 
                                <a class="delete-user {{ App\Model\FeatureUser::is_feature_allowed('delete_user', Auth::user()->id) }}" data-id="{{ $user_item->id }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                              @else
                                <a class="update-user {{ App\Model\FeatureUser::is_feature_allowed('edit_user', Auth::user()->id) }}" href="{{ route('user.edit',$user_item->id) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                              @endif
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
  $(".delete-user").unbind().click(function(){
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
            url: "/user/" + id,
            data: { 
              _token: "{{ csrf_token() }}" 
            }
          })
          .done(function( msg ) {
            Swal.fire(
              'Deleted!',
              'User has been deleted.',
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
