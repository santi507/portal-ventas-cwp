@extends('admin/layout')

@section('title')
	Actualizar Vendedor de D2D Capital y P. Oeste
@stop

@section('content')

{!! Form::open(['route' => ['admin.sellers.d2d.update', 'id' => $seller->id]]) !!}
	

	<div class="row">
		<div class="form-group col-md-6">
			<label for="name_seller">Nombre Completo</label>
			<input type="text" name="name_seller" class="form-control" required value="{{ $seller->name }}">
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-4">
			<label for="cis_seller">CIS</label>
			<input type="text" name="cis_seller" class="form-control" value="{{ $seller->cis }}">
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-4">
			<label for="nt_seller">NT</label>
			<input type="text" name="nt_seller" class="form-control" required value="{{ $seller->nt }}">
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-4">
			<label for="cwp_seller">CWP</label>
			<input type="text" name="cwp_seller" class="form-control" value="{{ $seller->cwp }}">
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-4">
			<label for="employee_id">Número de empleado</label>
			<input type="text" name="employee_id" class="form-control" required value="{{ $seller->employee_id }}">
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-4">
			<label for="status_seller">Estado</label>
			<select name="status_seller" class="form-control" required>
				<option value="1" @if($seller->status == 1) {{ 'selected' }}@endif>Activo</option>
				<option value="0" @if($seller->status == 0) {{ 'selected' }}@endif>Inactivo</option>
			</select>
		</div>
	</div>

	<button class="btn btn-info"> Actualizar vendedor</button>

{!! Form::close() !!}


@stop