<link rel="stylesheet" href="{{ asset('admin/css/style_admin.css') }}">
@extends('backEnd.layouts.master')

@section('content')
<div class="col-lg-12">
  @include('backEnd.layouts.notification')
</div>
<div class="page-title">
    <div class="page-title">
        <div class="title_left">
            <h3><span> <a href="{{ route('showOrders') }}" data-toggle="tooltip" title="Back" class="btn btn-info" data-placement="bottom"> <i class="fa fa-chevron-left"></i></a></span>Order #{{ $orderDetails->order_number }}</h3>
        </div>
  
        <div class="title_right">
            <div class="col-md-5 col-sm-5   form-group pull-right top_search">    
              <a href="{{ route('showInvoice', $orderDetails->id) }}" class="btn btn-round btn-info float-right"> Invoice</a>
            </div>
        </div>
    </div>
   

   
    <div class="container">
        <div class="row">
            <div class="col-6 card">
                <h5 class="heading">Customer Infomation</h5>
                <div class="card-body">
                    <table class="table" id="table_id" width="100%">
                        <tbody>
                          <tr>
                            <td> <b>Name</b></td>
                            <td>{{ $orderDetails->first_name }} {{ $orderDetails->last_name }}</td>
                          </tr>
                          <tr>
                            <td><b>Email</b></td>
                            <td>{{ $orderDetails->email }} </td>
                          </tr>
                          <tr>
                            <td><b>Phone</b></td>
                            <td>{{ $orderDetails->phone }} </td>
                          </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-6 card">
                <h5 class="heading">Customer Address</h5>
                <div class="card-body">
                    <table class="table" id="table_id" width="100%">
                        <tbody>
                          <tr>
                            <td> <b>Address</b></td>
                            <td>{{ $orderDetails->address}}, {{ $orderDetails->city}} {{ $orderDetails->state}} {{ $orderDetails->country}} {{ $orderDetails->postcode}} </td>
                          </tr>
                          <tr>
                            <td> <b>Note</b></td>
                            @if ($orderDetails->note)
                                <td> {{ $orderDetails->note }} </td>
                            @else
                                <td> - </td>
                            @endif
                          </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-6 card mt-3">
                <h5 class="heading">Payment Infomation</h5>
                @if ($orderDetails->order_status == 'delivered')
                  <a href="" class="btn btn-success" data-toggle="modal" title="Settle Order" data-target=".settleOrder{{$orderDetails->id}}" data-placement="bottom"><i class="fa fa-cog"></i> Settle Order</a>
                @endif
                <div class="card-body">
                    <table class="table" id="table_id" width="100%">
                        <tbody>
                          <tr>
                            <td> <b>Payment Method</b></td>
                            <td>
                                @switch($orderDetails->payment_method)
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
                          </tr>
                          <tr>
                            <td><b>Payment Status</b></td>
                            <td>
                                @if ($orderDetails->payment_status == 'paid')
                                    <span class="badge text-success">{{$orderDetails->payment_status}}</span>
                                @else
                                    <span class="badge text-danger">{{$orderDetails->payment_status}}</span>
                                @endif
                            </td>
                          </tr>
                         
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-6 card mt-3">
                <h5 class="heading">Order Infomation</h5>
                @if ($orderDetails->order_status == 'cancelled' || $orderDetails->order_status == 'completed')
                
                @else
                  <a href="" class="btn btn-success" data-toggle="modal" title="Update Status" data-target=".updateStatus{{$orderDetails->id}}" data-placement="bottom"><i class="fa fa-cog"></i> Update Status</a>
                @endif                  
                <div class="card-body">
                    <table class="table" id="table_id" width="100%">
                        <tbody>
                          <tr>
                            <td> <b>Order Date</b></td>
                            <td>
                                {{$orderDetails->order_date}}
                            </td>
                          </tr>
                          @if ($orderDetails->order_status == 'cancelled')
                            <tr>
                              <td><b>Cancelled Date</b></td>
                              <td>
                               {{$orderDetails->cancelled_date}}
                              </td>
                            </tr>                        
                          @endif

                          <tr>
                            <td><b>Order Status</b></td>
                            <td>
                                @if($orderDetails->order_status == 'pending')
                                    <span class="badge span-pending">{{$orderDetails->order_status}}</span>
                                @elseif($orderDetails->order_status == 'processing')
                                    <span class="badge span-processing">{{$orderDetails->order_status}}</span>
                                @elseif($orderDetails->order_status == 'delivered')
                                    <span class="badge span-delivered">{{$orderDetails->order_status}}</span>
                                @elseif($orderDetails->order_status == 'cancelled')
                                    <span class="badge span-cancelled">{{$orderDetails->order_status}}</span>
                                @else
                                    <span class="badge span-completed">{{$orderDetails->order_status}}</span>
                                @endif
                            
                            </td>
                          </tr>
                         
                          <tr>
                            <td><b>Total Amount</b></td>
                            <td>฿{{ number_format($orderDetails->total_amount, 2) }} 
                                <span>   <a href="" class="btn btn-secondary" data-toggle="modal" title="View" data-target=".viewDetails" data-placement="bottom"><i class="fa fa-eye"></i></a></span>
                             
                                <div class="modal fade viewDetails" tabindex="-1" role="dialog" aria-hidden="true">
                                  <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel2">Details</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <strong>Subtotal: <span class="text-muted">฿{{ number_format($orderDetails->sub_total, 2) }}</span></strong> <br>
                                        <strong>Coupon: 
                                          @if ($orderDetails->coupon > 0)
                                            <span class="text-muted">฿{{ number_format($orderDetails->coupon, 2) }}</span>
                                          @else
                                            <span class="text-muted">฿0.00</span>
                                          @endif
                                        </strong> <br>
                                        <strong>Delivery charge: 
                                          @if ($orderDetails->delivery_charge > 0)
                                            <span class="text-muted">฿{{ number_format($orderDetails->delivery_charge, 2) }}</span>
                                          @else
                                            <span class="text-muted">฿0.00</span>
                                          @endif
                                        </strong> <br>
                                        <strong class="text-custom float-right mr-5">Total Amount: ฿{{ number_format($orderDetails->total_amount, 2) }} </strong> <br>
                                
                                
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </td>
                          </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-12 card mt-3">
                <h5 class="heading">Shipping Infomation</h5>
                @if ($orderDetails->order_status != 'cancelled')
                  <a href="" class="btn btn-success " data-toggle="modal" title="Update Tracking" data-target=".updateTracking{{$orderDetails->id}}" data-placement="bottom"><i class="fa fa-truck"></i> Update Tracking</a>       
                @endif
                <div class="card-body">
                    <table class="table" id="table_id" width="100%">
                        <tbody>
                          {{-- <tr>
                            <td> <b>Delivery time</b></td>
                            <td> {{ $orderDetails->delivery_time  }} </td>
                          </tr> --}}

                          <tr>
                            <td> <b>Logistics </b></td>
                            @if ( $orderDetails->logistics_type )
                                <td> {{ $orderDetails->logistics_type  }} </td>
                            @else
                                <td>- </td>
                            @endif
                          </tr>
                          <tr>
                            <td> <b>Tracking Code</b></td>
                            @if ( $orderDetails->tracking_code )
                            <td> {{ $orderDetails->tracking_code  }} </td>
                            @else
                                <td>- </td>
                            @endif
                          </tr>

                          @if ($orderDetails->order_status == 'delivered' || $orderDetails->order_status == 'completed' )
                            <tr>
                                <td><b>Shipped Date</b></td>
                                <td> {{ $orderDetails->delivered_date }}</td>
                            <tr>
                          @else
                              
                          @endif
                        </tbody>
                    </table>
                </div>
            </div>


            {{-- Update Order status --}}
            <div class="modal fade updateStatus{{$orderDetails->id}}" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2">#{{ $orderDetails->order_number  }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <strong>Change status to</strong>
                    <form action="{{ route('updateOrderStatus', $orderDetails->id)  }}" method="post">
                      @csrf
                
                      <div class="modal-body">
                          <div class="form-group mb-3">
                              <select class="form-control" name="order_status" id="order_status">
                                  <option value="pending" {{ $orderDetails->order_status == 'pending'? 'selected' : '' }}>Pending</option>
                                  <option value="processing" {{ $orderDetails->order_status == 'processing'? 'selected' : '' }}>Processing</option>
                                  <option value="delivered" {{ $orderDetails->order_status == 'delivered'? 'selected' : '' }}>Delivered</option>
                                  <option value="cancelled" {{ $orderDetails->order_status == 'cancelled'? 'selected' : '' }}>Cancel</option>
                              </select>
                          </div>
                      </div>

                  </div>

                  <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button> --}}
                    <button type="submit" name="submit" class="btn btn-outline-info">Update</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>


            {{-- Update Tracking --}}
            <div class="modal fade updateTracking{{$orderDetails->id}}" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2">#{{ $orderDetails->order_number  }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <strong>Update Tracking</strong>
                    <form action="{{ route('updateOrderTracking', $orderDetails->id)  }}" method="post">
                      @csrf
                      <div class="modal-body">
                        <div class="form-group mb-3">
                          <label for="status" class="form-label text-success">Track order</label>
                          <div class="input-group mb-3">
                              <span class="input-group-text" id="basic-addon1"><i class="fa fa-truck btn-outline-success"></i></span>
                              <input type="text" class="form-control" name="tracking_code" id="tracking_code" placeholder="Tracking code" value="{{ $orderDetails->tracking_code }}" aria-label="Tracking code" aria-describedby="basic-addon1">
                          </div>
                          @error('tracking_code')
                              <small class="text-danger float-end alert-danger"> {{ $message }}</small>
                          @enderror
                          <div class="input-group mb-3">
                              <label for="status" class="form-label text-success">Select Logistics</label>
                              <div class="input-group mb-3">
                                  <select class="form-control" name="logistics_type" id="logistics_type">
                                       <option value="">-- Select Logistic --</option>
                                      @foreach ($logistics as $logistic)
                                        <option value="{{ $logistic->title }}">{{ $logistic->title }}</option>
                                      @endforeach
                                     
                                  </select>
                              </div>
                          </div>
                        </div>
                      </div>

                  </div>

                  <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button> --}}
                    <button type="submit" name="submit" class="btn btn-outline-info">Update</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>

            {{-- Settle Order --}}
            <div class="modal fade settleOrder{{$orderDetails->id}}" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2">#{{ $orderDetails->order_number  }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <strong>Are you sure you will settle this order?</strong>
                    <form action="{{ route('settleOrder', $orderDetails->id)  }}" method="post">
                      @csrf
                      <div class="modal-body">
                        <div class="form-group mb-3">
                          <label for="status" class="form-label">Change status to</label>
                          <input type="text" class="form-control" name="order_status" id="order_status" value="completed" readonly>
                        </div>
                        
                        @if ($orderDetails->payment_status == 'unpaid')
                          <div class="form-group mb-3">
                            <label for="status" class="form-label">Change payment status to</label>
                            <input type="text" class="form-control" name="payment_status" id="payment_status" value="paid" readonly>
                          </div>
                        @else
                          <input type="hidden" class="form-control" name="payment_status" id="payment_status" value="{{ $orderDetails->payment_status }}">
                        @endif
                       
                      </div>

                  </div>

                  <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-outline-info">Confirm</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>


            <div class="col-12 card mt-3">
                <h5 class="heading">Item Infomation</h5>
                <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Product Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Total Price</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($orderDetails->products as $item)
                        <tr>
                          <th scope="row">{{ $loop->iteration }}</th>
                          <td><img src="{{ $item->photo }}" alt="product_image" height="60px" width="60px"></td>
                          <td>{{ $item->title }}</td>
                          <td>{{ $item->pivot->quantity }}</td>
                          @if ($item->pivot->quantity != 0)
                            <td>{{ number_format($item->offer_price, 2)}}</td>
                          @else
                            <td>0</td>
                          @endif
                          
                          @if ($item->pivot->quantity != 0)
                            <td>{{ number_format($item->offer_price * $item->pivot->quantity, 2)}}</td>
                          @else
                            <td>0</td>
                          @endif
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>

    
</div>



       
@endsection


