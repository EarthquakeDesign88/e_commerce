<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <!-- Bootstrap -->
    <link href="{{ asset('admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('admin/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('admin/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('admin/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="{{ asset('admin/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('admin/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('admin/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ asset('admin/build/css/custom.min.css') }}" rel="stylesheet">


    <!-- Datatables -->
    <link href="{{ asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
   

    {{-- <link rel="stylesheet" href="{{ asset('admin/css/style_admin.css') }}"> --}}

</head>
<body class="nav-md">
 
<!-- page content -->
<div class="container" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left"></div>
            <div class="title_right"></div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
            {{-- <div class="x_title">
                <h2>Invoice Design <small>Sample user invoice design</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
               
                </li>
                </ul>
                <div class="clearfix"></div>
            </div> --}}
            <div class="x_content">

                <section class="content invoice">
                <!-- title row -->
                <div class="row">
                    <div class="  invoice-header">
                    <h1>
                        <i class="fa fa-globe"></i> Invoice.
                        <small class="pull-right">Date:  {{date('d F Y', strtotime($invoice->order_date))}}</small>
                    </h1>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <b>     Customer Info</b>
                    <address>
                        Name: {{ $invoice->first_name }} {{ $invoice->last_name }}
                        <br>Address: {{ $invoice->address }} {{ $invoice->state }}, {{ $invoice->city }}
                        <br>{{ $invoice->country }}, {{ $invoice->postcode }}
                        <br>Phone: {{ $invoice->phone }}
                        <br>Email: {{ $invoice->email }}
                        @if ($invoice->note != null)
                            <br>Note: {{ $invoice->note }}
                        @endif
                    </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                    {{-- To
                    <address>
                        <strong>{{ $invoice->sfirst_name }} {{ $invoice->slast_name }}</strong>
                        <br>{{ $invoice->saddress }} {{ $invoice->sstate }}, {{ $invoice->scity }}
                        <br>{{ $invoice->scountry }}, {{ $invoice->spostcode }}
                        <br>Phone: {{ $invoice->sphone }}
                        <br>Email: {{ $invoice->semail }}
                        @if ($invoice->snote != null)
                            <br>Note: {{ $invoice->snote }}
                        @endif
                    </address> --}}
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>Invoice #{{ $invoice->invoice_no }}</b>
                        <br>
                        <b>Order Number:</b> {{ $invoice->order_number }}
                        <br>
                        <b>Logistic:</b> {{ $invoice->logistics_type }}
                        <br>
                        <b>Tracking code:</b> {{ $invoice->tracking_code }}
                        <br>
                        <b>Delivery date:</b> @if($invoice->delivered_date == 0) - @else {{ $invoice->delivered_date}} @endif
                        {{-- <br> --}}
                        {{-- <b>Delivery slot:</b> {{ $invoice->delivery_time }} --}}
                    </div>
                    
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="  table">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th>Product</th>
                            <th>Qty</th>               
                            <th>Price</th>
                            <th>Total Price</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoice->products as $item)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->pivot->quantity }}</td>
                                    <td>{{ number_format($item->offer_price, 2)}}</td>
                                    <td>{{ number_format($item->offer_price * $item->pivot->quantity, 2)}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-md-6">
                    <p class="lead">Payment Methods: 
                        @switch($invoice->payment_method)
                        @case('pod')
                            Pay on delivery
                            @break
                        @case('pol')
                            Pay online
                            @break
                        @default
                            Paypal
                        @endswitch
                    </p>
                    <p>Payment status: <span> <b>{{ $invoice->payment_status }}</b></span></p>
                    <img src="{{ asset('images_template/invoice/visa.png') }}" alt="Visa">
                    <img src="{{ asset('images_template/invoice/mastercard.png') }}" alt="Mastercard">
                    <img src="{{ asset('images_template/invoice/american-express.png') }}" alt="American Express">
                    <img src="{{ asset('images_template/invoice/paypal.png') }}" alt="Paypal">
                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                    </p>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                    {{-- <p class="lead">Amount Due 2/22/2014</p> --}}
                    <div class="table-responsive">
                        <table class="table">
                        <tbody>
                            <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td> ฿{{ number_format($invoice->sub_total, 2) }}</td>
                            </tr>
                            @if ($invoice->coupon > 0)
                                <tr>
                                    <th>Coupon:</th>
                                    <td> ฿{{ number_format($invoice->coupon, 2) }}</td>
                                </tr>
                            @endif
                            @if ($invoice->delivery_charge > 0)
                                <tr>
                                    <th>Delivery Charge:</th>
                                    <td> ฿{{ number_format($invoice->delivery_charge, 2) }}</td>
                                </tr>
                            @endif
                            <tr>
                                <th>Total Amount:</th>
                                <td> ฿{{ number_format($invoice->total_amount, 2) }}</td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                {{-- <div class="row no-print">
                    <div class=" ">
                    <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                    <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
                    <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
                    </div>
                </div> --}}
                </section>
            </div>
            </div>
        </div>
        </div>
    </div>



    <!-- jQuery -->
    <script src="{{ asset('admin/vendors/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('admin/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('admin/vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('admin/vendors/nprogress/nprogress.js') }}"></script>
    <!-- Chart.js -->
    <script src="{{ asset('admin/vendors/Chart.js/dist/Chart.min.js') }}"></script>
    <!-- gauge.js -->
    <script src="{{ asset('admin/vendors/gauge.js/dist/gauge.min.js') }}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('admin/vendors/iCheck/icheck.min.js') }}"></script>
    <!-- Skycons -->
    <script src="{{ asset('admin/vendors/skycons/skycons.js') }}"></script>
    <!-- Flot -->
    <script src="{{ asset('admin/vendors/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('admin/vendors/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('admin/vendors/Flot/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('admin/vendors/Flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('admin/vendors/Flot/jquery.flot.resize.js') }}"></script>
    <!-- Flot plugins -->
    <script src="{{ asset('admin/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
    <script src="{{ asset('admin/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/flot.curvedlines/curvedLines.js') }}"></script>
    <!-- DateJS -->
    <script src="{{ asset('admin/vendors/DateJS/build/date.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('admin/vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
    <script src="{{ asset('admin/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('admin/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('admin/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('admin/build/js/custom.min.js') }}"></script>


     <!-- Datatables -->
     <script src="{{ asset('admin/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
     <script src="{{ asset('admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
     <script src="{{ asset('admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
     <script src="{{ asset('admin/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
     <script src="{{ asset('admin/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
     <script src="{{ asset('admin/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
     <script src="{{ asset('admin/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
     <script src="{{ asset('admin/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
     <script src="{{ asset('admin/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
     <script src="{{ asset('admin/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
     <script src="{{ asset('admin/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
     <script src="{{ asset('admin/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
     <script src="{{ asset('admin/vendors/jszip/dist/jszip.min.js') }}"></script>
     <script src="{{ asset('admin/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
     <script src="{{ asset('admin/vendors/pdfmake/build/vfs_fonts.js') }}"></script>

     <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    {{-- Bootstrap Toggle --}}
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    {{-- Sweetalert2 --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.20/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.20/sweetalert2.min.js"></script>


 

    @yield('scripts')
    <script>
        setTimeout(function() {
            $('#alert').slideUp();
        },4000);
    </script>
</body>
</html>






