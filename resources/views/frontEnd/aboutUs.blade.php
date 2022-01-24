@extends('frontEnd.layouts.master')
<title>About us</title>
<link rel="stylesheet" href="{{ asset('css/about_us.css') }}">

@section('content')   
	<div class="section">
		<div class="container">
			<div class="content-section">
				<div class="title">
					<h1>About Us</h1>
				</div>
				<div class="content">
					@foreach ($aboutUs as $info)
					<h3>{{ $info->header }}</h3>
					<p>{!! html_entity_decode($info->content) !!}</p>
					<div class="button">
						<a href="">Read More</a>
					</div>
					@endforeach
				
				</div>
				{{-- <div class="social">
					<a href=""><i class="fab fa-facebook-f"></i></a>
					<a href=""><i class="fab fa-instagram"></i></a>
					<a href=""><i class="fab fa-line"></i></a>
				</div> --}}
			</div>
			<div class="image-section">
				<img src="{{ $info->image }}" alt="AboutUs">
			</div>
		</div>
	</div>
@endsection




