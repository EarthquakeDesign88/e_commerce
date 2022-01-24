@extends('frontEnd.layouts.master')
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">

@section('content')

    <div class="container">
        <div class="box">
            <div class="breadcumb">
                <a href="{{ route('showHomepage') }}">Home</a>
                <span><i class='bx bxs-chevrons-right'></i></span>
                <a href="#" class="{{request()-> routeIs('checkout1')? 'active' : '' }}">Billing</a>
            </div>
        </div>
    </div>

    @include('frontEnd.layouts.progress_bar')

    @if ($errors->any())          
    <div class="container">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">     
            <ul>
                @foreach ($errors->all() as $error)
                    <li> {{ $error }}</li>
                @endforeach
            </ul>   
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>  
        </div>
    </div>
    @endif

    <form action="{{ route('checkout2') }}" method="post">
        @csrf
        <div class="section">
			<div class="container">
				<div class="row">

					<div class="col-md-12">
						<div class="billing-details" id="billing-address">
							<div class="section-title">
								<h3 class="title">Address</h3>
                                <a href="{{ route('showAddress') }}" class="btn btn-primary"><i class="fa fa-edit" data-toggle="tooltip" title="Edit address"></i></a>
							</div>
							<div class="row">
                                @php
                                    $name = explode(' ', $user->full_name);
                                @endphp
                                <div class="col-md-6 form-group">
                                    <input class="input" type="text" name="first_name"  id="first_name" placeholder="First Name" value="{{ $name[0] }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <input class="input" type="text" name="last_name" id="last_name" placeholder="Last Name" value="{{ $name[1] }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <input class="input" type="email" name="email" id="email" placeholder="Email" value="{{ Auth::user()->email }}" readonly>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input class="input" type="text" name="phone" id="phone" placeholder="Phone" value="{{ Auth::user()->phone }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <input class="input" type="text" name="country" id="country" placeholder="Country" value="{{ Auth::user()->country }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <input class="input" type="text" name="address" id="address" placeholder="Address" value="{{ Auth::user()->address }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <input class="input" type="text" name="city" id="city" placeholder="City" value="{{ Auth::user()->city }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <input class="input" type="text" name="state" id="state" placeholder="State" value="{{ Auth::user()->state }}">
                                </div>                   
                                <div class="col-md-6 form-group">
                                    <input class="input" type="text" name="postcode" id="postcode" placeholder="Postcode" value="{{ Auth::user()->postcode }}">
                                </div>

                                <div class="order-notes">
                                    <textarea class="input" placeholder="Order Notes" id="note" name="note"></textarea>
                                </div>
                                
                            </div>
			
						</div>
					</div>

                        
                        <input type="hidden" name="sub_total" value="{{ (float) str_replace(',','', Cart::instance('shopping')->subtotal()) }}">
                        <input type="hidden" name="total_amount" value="{{ (float) str_replace(',','', Cart::instance('shopping')->subtotal()) }}">

						<button type="submit" class="primary-btn order-submit">Continue</button>
					</div>
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>   
    </form>


@endsection

{{-- <script>
    $('#shiping-address').on('change', function(e) {
        e.preventDefault();

        if(this.checked){
            $('#sfirst_name').val($('#first_name').val());
            $('#slast_name').val($('#last_name').val());
            $('#email').val($('#email').val());
            $('#sphone').val($('#phone').val());
            $('#scountry').val($('#country').val());
            $('#saddress').val($('#address').val());
            $('#scity').val($('#city').val());
            $('#state').val($('#state').val());
            $('#spostcode').val($('#postcode').val());
            $('#billing-address').addClass('d-none');
        } else {
            $('#sfirst_name').val("");
            $('#slast_name').val("");
            $('#email').val("");
            $('#sphone').val("");
            $('#scountry').val("");
            $('#saddress').val("");
            $('#scity').val("");
            $('#state').val("");
            $('#spostcode').val("");
        }
    });

</script> --}}
