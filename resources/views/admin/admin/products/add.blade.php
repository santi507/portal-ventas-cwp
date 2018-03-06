@extends('admin/layout')

@section('title')
	Crear Producto
@stop

@section('content')

{!! Form::open(['route' => 'admin.products.store']) !!}
	

	<div class="row">
		<div class="form-group col-md-6">
			<label for="name_product">Nombre</label>
			<input type="text" name="name_product" class="form-control" required>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-4">
			<label for="code_product">Código</label>
			<input type="text" name="code_product" class="form-control" required>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-4">
			<label for="category">Tecnología</label>
			<select class="form-control product_category" required>
				<option value="" selected disabled>Escoger opción</option>
				@foreach ($categories as $category)
					<option value="{{ $category->id }}"> {{ $category->name }}</option>
				@endforeach
			</select>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-4">
			<select class="form-control product_subcategory" required name="subcategory">
			</select>
		</div>
	</div>

	

	<button class="btn btn-info"> Crear producto</button>

{!! Form::close() !!}


@stop