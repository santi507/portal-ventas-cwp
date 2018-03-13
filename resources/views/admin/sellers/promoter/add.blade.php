@extends('admin/layout')

@section('title')
	Crear Vendedor de Promotores
@stop

@section('content')

{!! Form::open(['route' => 'admin.sellers.promoter.store']) !!}
	

	<div class="row">
		<div class="form-group col-md-6">
			<label for="name_seller">Nombre Completo</label>
			<input type="text" name="name_seller" class="form-control" required>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-4">
			<label for="cis_seller">CIS</label>
			<input type="text" name="cis_seller" class="form-control">
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-4">
			<label for="nt_seller">NT</label>
			<input type="text" name="nt_seller" class="form-control" required>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-4">
			<label for="cwp_seller">CWP</label>
			<input type="text" name="cwp_seller" class="form-control">
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-4">
			<label for="employee_id">Número de empleado</label>
			<input type="text" name="employee_id" class="form-control" required>
		</div>
	</div>

	<button class="btn btn-info"> Crear vendedor</button>

{!! Form::close() !!}


@stop