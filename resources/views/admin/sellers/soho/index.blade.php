@extends('admin/layout')

@section('title')
	Vendedores de Soho
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<a class="btn btn-info" 
				href="{{ route('admin.sellers.soho.create') }}">
				<i class="fa fa-plus"></i> Agregar vendedor
			</a>
		</div>
	</div>
	<table class="table table-striped table-bordered sellers" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>NT</th>
                <th>CIS</th>
                <th>CWP</th>
                <th>Empleado</th>
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
					<td>@if ($seller->status){{ 'Activo' }}@else {{ 'Inactivo' }}@endif</td>
					<td style="text-align: center;">
						{!! Html::btn_edit('admin.sellers.soho.edit', $seller->id) !!}
	                </td>
				</tr>
        	@endforeach
        </tbody>
    </table>
@stop