<link rel="stylesheet" href="{{ asset('admin/css/style_admin.css') }}">
@extends('backEnd.layouts.master')

@section('content')


<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Omise  
          <div class="btn-group">
          </div>
        </h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5   form-group pull-right top_search">
          <div>
            <p class="float-right mr-5">Total Transactions: {{ $omise->count() }}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-lg-12">
      @include('backEnd.layouts.notification')
    </div>

</div>
<div class="col-md-12 col-sm-12 "> 
    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Order No.</th>
                <th>Payment status</th>
                <th>Amount</th>
                <th>Transaction</th>
                <th>Customer Name</th>
                <th>Card brand</th>
                <th>Last Digits</th>
                <th>Transaction Datetime</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($omise as $oms)
          <tr style="font-size: 12px">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $oms->order_number }}</td>
            <td>
                @if ($oms->payment_status == 'paid')
                    <span class="badge text-success">{{$oms->payment_status}}</span>
                @else
                    <span class="badge text-danger">{{$oms->payment_status}}</span>
                @endif
            </td>
            <td>฿{{ number_format($oms->amount, 2) }}</td>
            <td>{{ $oms->transaction_ref }}</td>
            <td>{{ $oms->customer_name }}</td>
            <td>{{ $oms->card_brand }}</td>
            <td>{{ $oms->last_digits }}</td>
            <td>{{ $oms->transaction_date }}</td>
          </tr>
        @endforeach
        </tbody>
    </table>

</div>

    
@endsection



