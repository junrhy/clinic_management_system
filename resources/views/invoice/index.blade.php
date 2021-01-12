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

  .show-patient, .delete-patient, .update-patient {
    color: gray;
  }

  .delete-patient:hover {
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
                        <h2>All Invoices <small class="text-muted">View Invoices</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item">Invoices</li>
                            <li class="breadcrumb-item active">All Invoices</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-notes-medical" aria-hidden="true"></i> Patient List</div>

                <div class="panel-body">
                    <div class="table-responsive">
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
                    </div>  
                    <br>
                    <div class="table-responsive">
                        <table class="table">
                          <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Gender</th>
                            <th>Date of Birth</th>
                            <th>Age</th>
                            <th>Contact</th>
                            <th>Total Invoices Amount</th>
                            <th>Action</th>
                          </tr>
                        @if($patients->count() > 0)
                          <?php foreach ($patients as $patient_key => $patient_item): ?>
                          <tr>
                            <td>{{ $patient_item->first_name }}</td>
                            <td>{{ $patient_item->last_name }}</td>
                            <td>{{ $patient_item->gender }}</td>
                            <td>{{ $patient_item->dob->format('M d, Y') }}</td>
                            <td>{{ $patient_item->dob->age }}</td>
                            <td><span style="font-family: sans-serif;">{{ $patient_item->contact_number }}</span></td>
                            <td>&#8369; {{ number_format($patient_item->charges->sum('amount'), 2) }}</td>
                            <td>
                              <div>
                                <a class="show-invoice {{ App\Model\FeatureUser::is_feature_allowed('view_patient_invoice', Auth::user()->id) }}" href="{{ route('invoice.show',$patient_item->id) }}"><i class="fa fa-file-alt" aria-hidden="true"></i> View</a>
                              </div>
                           </td>
                          </tr>
                          <?php endforeach; ?>
                        @else
                          <tr>
                            <td colspan="8" class="text-center">No record on this list</td>
                          </tr>
                        @endif
                        </table>
                    </div>
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
