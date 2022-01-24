
<title>Order History</title>
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">



@extends('frontEnd.layouts.master')

@section('content')
  <div class="col-lg-12">
    @include('frontEnd.layouts.notification')
  </div>
  <section class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-11">
            <div class="row">
                <div class="col-lg-3">
                  <div class="list-group list-profile sticky-top">
                    <a href="{{ route('showProfile') }}"  class="list-group-item list-group-item-action {{ request()->routeIs('showProfile') ? 'active' : '' }}">
                        <i class="far fa-user"></i> Profile
                    </a>
                    <a href="{{ route('showAddress') }}" class="list-group-item list-group-item-action {{ request()->routeIs('showAddress') ? 'active' : '' }}">
                        <i class="fa fa-home"></i> Address
                    </a>
                    <a href="{{  route('showOrderHistory')  }}" class="list-group-item list-group-item-action {{ request()->routeIs('showOrderHistory') || request()->routeIs('searchOrderByDate')  ? 'active' : '' }}">
                        <i class="fa fa-history"></i> Order History
                    </a>
                    <a href="{{  route('showHelp')  }}" class="list-group-item list-group-item-action {{ request()->routeIs('showHelp') ? 'active' : '' }}">
                        <i class="fas fa-question-circle"></i> Help
                    </a>
                    <a href="{{  route('showHomepage')  }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-shopping-cart"></i> Home
                    </a>
                  </div>
                </div>
                <div class="col-lg-9">
                    <div class="container">
                        <div class="card border-0">
                            <div class="card-body">
                                <form action="{{ route('searchOrderByDate') }}" method="post">
                                  @csrf
                                  <div class="row">
                                    <div class="col-5">
                                      <p>From: <input type="date" id="startDate" name="startDate" required></p>
                                    </div>
                                    <div class="col-5">
                                      <p>To: <input type="date" id="endDate" name="endDate" required></p>
                                    </div>
                                    <div class="col-2 mr-0">
                                      <button type="submit" class="btn btn-primary" name="search" title="search"><i class="fa fa-search"></i></button>
                                      <a href="{{ route('showOrderHistory') }}" class="btn btn-primary" title="refresh"><i class="fas fa-sync-alt"></i></a>
                                    </div> 
                                  </div>
                                </form>
                                <div class="row gy-4">
                                    <table class="table">
                                        <thead>
                                          <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Order No.</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Payment Status</th>
                                            <th scope="col">Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @if (count($orders) > 0)
                                            @foreach ($orders as $order)
                                            <tr>
                                              <th scope="row">{{ $loop->iteration }}</th>
                                              <td> {{date('d F Y ', strtotime($order->order_date))}}</td>
                                              <td>{{ $order->order_number }}</td>
                                              <td>{{ number_format($order->total_amount, 2) }}</td>
                                              <td>
                                              
                                                <p class="status"> {{ $order->order_status }}</p>
                                                 
                                              </td>
                                              <td>
                                                @if ($order->payment_status == 'paid')
                                                  <span class="badge span-paid">{{ $order->payment_status }}</span>
                                                @else
                                                <span class="badge span-unpaid">{{ $order->payment_status }}</span>
                                                @endif                                           
                                              </td>
                                              <td>
                                                <div class="btn-group">
                                                  <a href="" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#orderModal{{ $order->order_number }}" data-toggle="tooltip" title="View details"> <i class="fa fa-eye"></i></a>
                                                
                                                 
                                                  <div class="modal fade" id="orderModal{{ $order->order_number }}" tabindex="-1" aria-labelledby="orderModalLabel{{ $order->order_number }}" aria-hidden="true" data-placement="bottom">
                                                    <div class="modal-dialog modal-lg">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <h5 class="modal-title text-modal" id="orderModalLabel{{ $order->order_number }}">{{ $order->order_number }}</h5>
                                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                          <div class="row">
                                                            <div class="col-6">
                                                              <strong>Date</strong>
                                                              <p>{{date('d F Y ', strtotime($order->order_date))}}</p>
                                                            </div>
                                                            <div class="col-6">
                                                              <strong>Status</strong>
                                                              <p>{{ $order->order_status }}</p>
                                                            </div>
                                                            <div class="col-6">
                                                              <strong>Payment method</strong>
                                                              @switch($order->payment_method)
                                                              @case('pod')
                                                                <p>Pay on delivery</p>
                                                                @break
                                                              @case('pol')
                                                                <p>Pay online</p>
                                                                @break
                                                              @default
                                                                <p>Paypal</p>
                                                              @endswitch
                                                            </div>
                                                            <div class="col-6">
                                                              <strong>Payment status</strong>
                                                              @if ($order->payment_status == 'paid')
                                                                <span class="badge span-paid">{{ $order->payment_status }}</span>
                                                              @else
                                                                <span class="badge span-unpaid">{{ $order->payment_status }}</span>
                                                              @endif  
                                                            </div>
                                                            <div class="col-3">
                                                              <strong>Sub total</strong>
                                                              <p>{{ number_format($order->sub_total, 2) }}</p>
                                                            </div>                                                     
                                                            <div class="col-3">
                                                              <strong>Coupon</strong>
                                                              <p>{{ number_format($order->coupon, 2) }}</p>
                                                            </div>
                                                            <div class="col-3">
                                                              <strong>Delivery charge</strong>
                                                              <p>{{ number_format($order->delivery_charge, 2) }}</p>
                                                            </div>
                                                            <div class="col-3">
                                                              <strong>Total Amount</strong>
                                                              <p>{{ number_format($order->total_amount, 2) }}</p>
                                                            </div>

                                                            
                                                          </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                              
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  @if ($order->order_status == 'delivered')
                                                    <a href="" class="btn btn-outline-primary"> <i class="fa fa-truck" data-toggle="tooltip" title="view Tracking"></i></a>
                                                  @endif
                                                  @if ($order->order_status == 'pending' && $order->payment_status == 'unpaid')
                                                    <a href="" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#cancelOrder{{ $order->order_number }}" data-toggle="tooltip" title="Cancel order"> <i class="fa fa-times"></i></a>     
                                                  @endif
                                                
                                                  <!-- Modal -->
                                                  <div class="modal fade" id="cancelOrder{{ $order->order_number }}" tabindex="-1" aria-labelledby="cancelOrderLabel{{ $order->order_number }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <h5 class="modal-title text-modal" id="cancelOrderLabel{{ $order->order_number }}">{{ $order->order_number }}</h5>
                                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                          <strong>Are you sure you will cancel this order?</strong>
                                                          <form action="{{ route('cancelOrder', $order->id)  }}" method="post">
                                                            @csrf
                                                            <div class="modal-body">
                                                              <div class="form-group mb-3">
                                                                <label for="status" class="form-label">Change status to</label>
                                                                <input type="text" class="form-control" name="order_status" id="order_status" value="cancelled" readonly>
                                                              </div>
                                                            </div>
                                      
                                                        </div>
                                      
                                                        <div class="modal-footer">
                                                          <button type="submit" name="submit" class="btn btn-outline-primary">Confirm</button>
                                                        </div>
                                                        </form>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                              </td>
                                            </tr>
                                            @endforeach
                                          @else
                                            <tr>
                                              <td colspan="6">
                                                  <div class="alert alert-danger" role="alert">
                                                    Order not found
                                                  </div>
                                              </td>
                                            </tr>
                                          @endif
                               
                                        </tbody>
                                      </table>
                                      {{ $orders->appends($_GET)->links('vendor.pagination.custom') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>

@endsection
