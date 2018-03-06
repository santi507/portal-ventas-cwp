@extends('admin/layout')

@section('title')
	Productos
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<a class="btn btn-info" 
				href="{{ route('admin.products.add') }}">
				<i class="fa fa-plus"></i> Agregar producto
			</a>
		</div>
	</div>
	<table id="products" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
            	<th>Código</th>
                <th>Nombre</th> 
                <th>Tecnología</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        	@foreach($products as $product)
				<tr>
					<td>{{ $product->code }}</td>
					<td>{{ $product->name }}</td>
					<td>{{ $product->subcategory->name }}</td>
					<td>@if ($product->status){{ 'Activo' }}@else {{ 'Inactivo' }}@endif</td>
					<td style="text-align: center;">
						{!! Html::btn_edit('admin.products.edit', $product->id) !!}
	                    {{-- {!! Html::btn_destroy('admin.sellers.shop.delete', $product->id, '¿Está seguro que desea eliminar este vendedor?') !!} --}}
	                </td>
				</tr>
        	@endforeach
        </tbody>
    </table>
@stop