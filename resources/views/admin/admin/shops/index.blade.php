@extends('admin/layout')

@section('title')
	Tiendas
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<a class="btn btn-info" 
				href="{{ route('admin.shops.create') }}">
				<i class="fa fa-plus"></i> Agregar tienda
			</a>
		</div>
	</div>
	<table id="shops" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
            	<th>Area</th>
            	<th>Tienda</th>
            	<th>Código</th>
            	<th>Administrador</th>
                <th># de vendedores</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        	@foreach($shops as $shop)
				<tr>

					<td>{{ $shop->area->name }}</td>
					<td>{{ $shop->name }}</td>
					<td>{{ $shop->shop_code }}</td>
					<td>
						@if (is_null($shop->admin))
							{{''}}
						@else
							{{ $shop->admin->name }}
						@endif
					</td>
					<td>{{ count($shop->sellers) }}</td>
					<td style="text-align: center;">
						{!! Html::btn_edit('admin.shops.edit', $shop->id) !!}
	                    {{-- {!! Html::btn_destroy('admin.sellers.shop.delete', $shop->id, '¿Está seguro que desea eliminar este vendedor?') !!} --}}
	                </td>
				</tr>
        	@endforeach
        </tbody>
    </table>
@stop