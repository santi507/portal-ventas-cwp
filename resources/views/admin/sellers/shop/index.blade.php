@extends('admin/layout')

@section('title')
	Vendedores de Tienda
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<a class="btn btn-info" 
				href="{{ route('admin.sellers.shop.create') }}">
				<i class="fa fa-plus"></i> Agregar vendedor
			</a>
		</div>
	</div>
	<table id="shop_sellers" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>NT</th>
                <th>CIS</th>
                <th>CWP</th>
                <th>Empleado</th>
                <th>Tienda</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        	@foreach($sellers as $seller)
				<tr>
					<td>{{ $seller->name }}</td>
					<td>{{ $seller->nt }}</td>
					<td>{{ $seller->cis }}</td>
					<td>{{ $seller->cwp }}</td>
					<td>{{ $seller->employee_id }}</td>
					<td>{{ $seller->shop->name }}</td>
					<td>@if ($seller->status){{ 'Activo' }}@else {{ 'Inactivo' }}@endif</td>
					<td style="text-align: center;">
						{!! Html::btn_edit('admin.sellers.shop.edit', $seller->id) !!}
	                    {{-- {!! Html::btn_destroy('admin.sellers.shop.delete', $seller->id, '¿Está seguro que desea eliminar este vendedor?') !!} --}}
	                </td>
				</tr>
        	@endforeach
        </tbody>
    </table>
@stop