@extends('layouts.admin')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>
@endsection

@section('page_level_css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>

<style type="text/css">
  .publish_billing_statement, .view_billing_statement, .edit_billing_statement, .delete_billing_statement {
    color: gray;
  }

  .publish_billing_statement:hover, .view_billing_statement:hover, .edit_billing_statement:hover, .delete_billing_statement:hover {
    text-decoration: none;
    cursor: pointer;
  }

  .delete_billing_statement:hover {
    color: red;
  }

  .latest {
    border: 2px solid #01a2da;
    font-weight: bold;
    color: #01a2da;
    text-align: center;
    width: 110px;
    padding: 5px 0;
    display: inline-block;
  }

  .published {
    border: 2px solid green;
    background-color: transparent;
    font-weight: bold;
    color: green;
    text-align: center;
    width: 110px;
    padding: 5px 0;
    display: inline-block;
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
                        <h2>Billing Statements <small class="text-muted">Manage web app client billing statements</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <a class="btn btn-white btn-icon btn-round float-right m-l-10" href="/admin/billing/create/{{ $client->id }}" type="button">
                            <i class="fa fa-plus"></i>
                        </a>

                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-home"></i> Admin Panel</a></li>
                            <li class="breadcrumb-item"><a href="/admin/billings"><i class="fa fa-file-alt"></i> Billings</a></li>
                            <li class="breadcrumb-item active">Statements</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">{{ $client->name }}</div>

                <div class="panel-body">
                    <div class="row col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Billing Period</th>
                                        <th>Bill Date</th>
                                        <th>Amount Due</th>
                                        <th>Additional</th>
                                        <th>Deductions</th>
                                        <th>Total Amount Due</th>
                                        <th>Payment ref #</th>
                                        <th>Due Date</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="font-family: sans-serif;">
                                    @foreach($billing_statements as $billing_statement)
                                    <tr>
                                        <td>{{ $billing_statement->billed_at->format('M Y') }}</td>
                                        <td>{{ $billing_statement->billed_at->format('M d, Y') }}</td>
                                        <td>{{ number_format($billing_statement->amount_due, 2) }}</td>
                                        <td>
                                            <small>Amount Past Due: <span style="color: blue;">{{ number_format($billing_statement->amount_past_due, 2) }}</span></small><br>
                                            <small>Penalties: <span style="color: blue;">{{ number_format($billing_statement->penalties, 2) }}</span></small>
                                        </td>
                                        <td>
                                            <small>Discount: <span style="color: red;">{{ number_format($billing_statement->discount, 2) }}</span></small><br>
                                            <small>Advance: <span style="color: red;">{{ number_format($billing_statement->advance_payment, 2) }}</span></small>
                                        </td>
                                        <td>
                                        <?php 
                                          $prev_bill_balance = $billing_statement->amount_past_due;
                                          $current_bill_charges = $billing_statement->amount_due;
                                          $adjustments = ($billing_statement->penalties) + -$billing_statement->advance_payment + -$billing_statement->discount;
                                          $total_amount_due = $prev_bill_balance + $current_bill_charges + $adjustments;
                                        ?>
                                        {{ number_format($total_amount_due, 2) }}
                                        </td>
                                        <td>{{ $billing_statement->payment_reference_no }}</td>
                                        <td>{{ $billing_statement->due_at->format('M d, Y') }}</td>
                                        <td align="right">
                                            @if($billing_statement->is_latest == true)
                                              <div class="latest"><i class="fa fa-arrow-left"></i> Latest Bill</div>
                                            @endif

                                            @if($billing_statement->is_publish == false)
                                                <a class="publish_billing_statement" data-id="{{ $billing_statement->id }}"><i class="fa fa-globe"></i> Publish</a>
                                                | <a class="view_billing_statement" href="/admin/billing/view/{{ $billing_statement->id }}"><i class="fa fa-file-alt"></i> View</a>
                                                | <a class="edit_billing_statement" href="/admin/billing/edit/{{ $billing_statement->id }}"><i class="fa fa-pencil"></i> Edit</a>
                                                | <a class="delete_billing_statement" data-id="{{ $billing_statement->id }}"><i class="fa fa-trash-o"></i> Delete</a>

                                            @else
                                                <div class="published"><i class="fa fa-check"></i> Published</div>
                                                &nbsp;
                                                <a class="view_billing_statement" href="/admin/billing/view/{{ $billing_statement->id }}" target="_BLANK"><i class="fa fa-file-alt"></i> View</a>

                                                @if($billing_statement->billed_at->diffInYears(\Carbon\Carbon::now()) >= 1)
                                                  | <a class="delete_billing_statement" data-id="{{ $billing_statement->id }}"><i class="fa fa-trash-o"></i> Delete</a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div style="display: none" id="html_holder">
                              
                            </div>
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

    $(".delete_billing_statement").unbind().click(function(){
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
                url: "/admin/billing/delete/" + id,
                data: { 
                  _token: "{{ csrf_token() }}" 
                }
              })
              .done(function( msg ) {
                Swal.fire(
                  'Deleted!',
                  'Billing statement has been deleted.',
                  'success'
                ).then((result) => {
                  location.reload();
                });
              });
            }
          })
    });

    $(".publish_billing_statement").unbind().click(function(){
          id = $(this).data('id');

          Swal.fire({
            title: 'Are you sure?',
            text: "This action will published the billing statement to the client page. You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, publish it!'
          }).then((result) => {
            if (result.value) {
              $.ajax({
                method: "PUT",
                url: "/admin/billing/publish/" + id,
                data: { 
                  _token: "{{ csrf_token() }}" 
                }
              })
              .done(function( msg ) {
                Swal.fire(
                  'Published!',
                  'Billing statement has been published.',
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