@extends('master')

@section('styles')
	<link href="{{ asset('assets/css/auth.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('scripts')
	@parent
@stop

@section('body-class', 'auth-page')

@section('body')
	@include('components.menu-top')

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          @include('components.menu-lateral')
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        	<h1 class="page-header">@yield('title')</h1>
          @include('addons/messages')
		   	@yield('content')
        </div>
      </div>
    </div>
@stop

@section('analytics')
@stop