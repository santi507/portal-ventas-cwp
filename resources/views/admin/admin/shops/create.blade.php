@extends('admin/layout')

@section('title')
	Crear Producto
@stop

@section('content')

{!! Form::open(['route' => 'admin.shops.create']) !!}
	

	<div class="row">
		<div class="form-group col-md-6">
			<label for="name_shop">Nombre</label>
			<input type="text" name="name_shop" class="form-control" required>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-4">
			<label for="code_shop">Código</label>
			<input type="text" name="code_shop" class="form-control" required>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-4">
			<label for="area_shop">Area</label>
			<select class="form-control area_shop" required>
				<option value="" selected disabled>Escoger opción</option>
				@foreach ($areas as $area)
					<option value="{{ $area->id }}"> {{ $area->name }}</option>
				@endforeach
			</select>
		</div>
	</div>

	

	<button class="btn btn-info"> Crear Tienda</button>

{!! Form::close() !!}


@stop