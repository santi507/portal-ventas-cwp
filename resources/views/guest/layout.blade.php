@extends('master')

@section('styles')
<link href="{{ asset('assets/css/guest.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('body-class') guest-page @stop

@section('body')
	<div id="header" class="navbar" role="header">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="javascript:void(0)">
					<img src="{{ asset('assets/images/cwp-logo.png') }}" />
				</a>
			</div>
			<div class="pull-right contact hidden-xs">
				<div class="pull-left">
				</div>
				<div class="pull-right">
				</div>
			</div>
		</div>
	</div>

	<div id="content">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="content">
						@include('addons/messages')
						
						@yield('content')
					</div>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>
	</div>
@stop