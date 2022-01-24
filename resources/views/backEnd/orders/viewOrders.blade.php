<link rel="stylesheet" href="{{ asset('admin/css/style_admin.css') }}">
@extends('backEnd.layouts.master')

@section('content')


<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Orders  
          <div class="btn-group">
            {{-- <a href="#" class="btn btn-round btn-sm btn-outline-success"><i class="fa fa-file-excel-o mr-1"></i>Import banner</a> --}}
          </div>
        </h3>


      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5   form-group pull-right top_search">
          <div>
            <p class="float-right mr-5">Total Orders: {{ $orders->count() }}</p>
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
                <th>Order No.</th>
                <th>Order Date</th>
                <th>Customer Name</th>
                <th>Payment Method</th>
                <th>Total</th>
                <th>Order Status</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($orders as $order)
          <tr>
            <td>{{ $order->order_number }}</td>
            <td>{{date('d F Y h:m:s', strtotime($order->order_date))}}</td>
            <td>{{ $order->first_name }} {{ $order->last_name }}</td>
            <td class="status">
                @switch($order->payment_method)
                @case('pod')
                    <span class="badge purple"></span> Pay on delivery
                    @break
                @case('pol')
                    <span class="badge badge-primary"></span> Pay online
                    @break
                @default
                    <span class="badge badge-warning"></span> Paypal
                @endswitch
            </td>
            <td>฿{{ number_format($order->total_amount, 2) }}</td>
            <td>
              @if($order->order_status == 'pending')
                  <span class="badge span-pending">{{$order->order_status}}</span>
              @elseif($order->order_status == 'processing')
                  <span class="badge span-processing">{{$order->order_status}}</span>
              @elseif($order->order_status == 'delivered')
                  <span class="badge span-delivered">{{$order->order_status}}</span>
              @elseif($order->order_status == 'cancelled')
                  <span class="badge span-cancelled">{{$order->order_status}}</span>
              @else
                  <span class="badge span-completed">{{$order->order_status}}</span>
              @endif
            </td>
            <td>  
              <div class="btn-group">
                <a href="{{ route('showOrderDetails', $order->id) }}" data-toggle="tooltip" title="View" class="btn btn-info mr-2" data-placement="bottom"> <i class="fa fa-eye"></i></a>
              </div>
                              
            </td>
          </tr>
        @endforeach
        </tbody>
    </table>

</div>

    
@endsection



