@extends('guest/layout')

@section('content')
	<h3>{{ Config::get('app.name') }}</h3>
	<h1>ADMINISTRACIÓN</h1>

	{!! Form::open(array('route' => 'admin.login', 'method' => 'post')) !!}
	<div class="row">
		<div class="col-md-12">
			<div class="form-group row">
				<div class="col-md-12"><label for="password">Dominio:</label></div>
				<div class="col-md-12">{!! Form::select('domains', $domains, Input::old('domains'), ['class' => 'form-control']) !!}</div>
		        <div class="col-md-12 sidetip">
			        {!! Form::fulgore__sidetip('domains') !!}
		        </div>
			</div>

			<div class="form-group row">
				<div class="col-md-12"><label for="username">Usuario:</label></div>
				<div class="col-md-12">{!! Form::text('username', Input::old('username'), ['class' => 'form-control']) !!}</div>
		        <div class="col-md-12 sidetip">
			        {!! Form::fulgore__sidetip('username') !!}
		        </div>
			</div>

			<div class="form-group row">
				<div class="col-md-12"><label for="password">Contraseña:</label></div>
				<div class="col-md-12">{!! Form::password('password', ['class' => 'form-control']) !!}</div>
		        <div class="col-md-12 sidetip">
			        {!! Form::fulgore__sidetip('password') !!}
		        </div>
			</div>

			<div class="form-group row">
				<div class="col-md-12">
					{!! Form::submit('INGRESAR', ['class' => 'btn btn-block btn-lg btn-primary']) !!}
				</div>
			</div>
		</div>
	</div>
	{!! Form::close() !!}
@stop