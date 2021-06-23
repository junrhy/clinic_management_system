@extends('layouts.app')

@section('page_level_script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
@endsection

@section('page_level_css')
<style type="text/css">
  .pricing {
    font-family: arial;
  }

  .btn-subscribe {
    background:#FF6065;
    color:#FFFFFF;
    font-weight: bold;
  }

  .btn-subscribe:hover {
    color:#FFFFFF;
    box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.15);
  }

  .subscribed {
    color: #FF6065;
    font-weight: bold;
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
                        <h2>View Billing Statements <small class="text-muted">View billing statements.</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item active"><strong style="color:#fff;">View Billing Statements</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">View Billing Statements</div>

                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-3">
                      <h4 style="border-bottom:2px dotted #00cfd1;padding:10px;color:#00cfd1;font-weight: bold;"><i class="fa fa-file"></i> View Billing Statements</h4>
                    </div>
                  </div>

                  <div class="row">
                    <div class="table-responsive col-md-3">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Billing Period</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($billing_statements as $billing_statement)
                          <tr>
                            <td>{{ $billing_statement->billed_at->format('F Y') }}</td>
                            <td align="center">
                              <a href="/view_billing_statement/{{ $billing_statement->id }}" target="_BLANK">View</a>
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
</div>
@endsection
@section('page_level_footer_script')

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

<script type="text/javascript">
$(document).ready(function() {
  
});
</script>
@endsection
