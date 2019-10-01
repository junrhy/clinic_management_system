@extends('layouts.app')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>
@endsection

@section('page_level_css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>

<style type="text/css">
  .namelist {
    cursor:pointer;
  }

  .font-weight-bold {
    font-weight:bold;
    font-size:14pt;
  }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-notes-medical" aria-hidden="true"></i> Patients</div>

                <div class="panel-body">
                    <div><a class="btn btn-primary" href="{{ url('patient/create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Add</a></div>
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
                    <table class="table">
                      <tr>
                        <th width="20%">First Name</th>
                        <th>Last Name</th>
                        <th class="text-center" width="26%">Action</th>
                      </tr>
                    @if($patients->count() > 0)
                      <?php foreach ($patients as $patient_key => $patient_item): ?>
                      <tr>
                        <td>{{ $patient_item->first_name }}</td>
                        <td>{{ $patient_item->last_name }}</td>
                        <td class="text-right">
                            <a class="btn btn-xs btn-danger delete-patient" data-id="{{ $patient_item->id }}"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
                            <a class='btn btn-xs btn-warning' href="{{ route('patient.edit',$patient_item->id) }}"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                            <a class='btn btn-xs btn-success' href="{{ route('patient.show',$patient_item->id) }}"><i class="fa fa-notes-medical" aria-hidden="true"></i> View Records</a>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                    @else
                      <tr>
                        <td colspan="3" class="text-center">No records yet.</td>
                      </tr>
                    @endif
                    </table>
                    <div align="center">{{ $patients->appends(['namelist' => $namelist])->links() }}</div>
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
  $(".delete-patient").unbind().click(function(){
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
          url: "/patient/" + id,
          data: { 
            _token: "{{ csrf_token() }}" 
          }
        })
        .done(function( msg ) {
          Swal.fire(
            'Deleted!',
            'Record has been deleted.',
            'success'
          ).then((result) => {
            location.reload();
          });
        });
      }
    })
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
