@extends('admin/layout')

@section('title')
	Editar Producto
@stop

@section('content')

{!! Form::open(['route' => ['admin.products.update', 'id' => $product->id]]) !!}
	

	<div class="row">
		<div class="form-group col-md-6">
			<label for="name_product">Nombre</label>
			<input type="text" name="name_product" class="form-control" required value="{{ $product->name }}">
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-4">
			<label for="code_product">Código</label>
			<input type="text" name="code_product" class="form-control" value="{{ $product->code }}" required>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-4">
			<label for="category">Tecnología</label>
			<select class="form-control product_category" required>
				<option value="" selected disabled>Escoger opción</option>
				@foreach ($categories as $category)
					<option value="{{ $category->id }}" @if ($category->id == $product->subcategory->category->id){{'selected'}}@endif> 
						{{ $category->name }}
					</option>
				@endforeach
			</select>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-4">
			<select class="form-control product_subcategory" name="subcategory">
				<option value="{{ $product->subcategory_id}}" selected>{{ $product->subcategory->name }}</option>
			</select>
		</div>
	</div>

	

	<button class="btn btn-info"> Actualizar producto</button>

{!! Form::close() !!}


@stop