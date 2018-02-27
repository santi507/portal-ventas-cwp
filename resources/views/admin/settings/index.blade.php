@extends('admin/layout')

@section('breadcrumb')
    @parent
    <li class="active">Configuración</li>
@stop

@section('content')
<h3>Gestión de Configuración</h3>
<p class="text-center"><i class="fa fa-fw fa-lightbulb-o"></i> A continuación se muestra el listado de los parámetros de configuración de la aplicación.</p>
<hr />

<div class="row">
	<div class="clearfix">
		{!! Form::open(['route' => 'admin.settings', 'method' => 'GET', 'class' => 'form-inline pull-left']) !!}
			<div class="form-group">
				{!! Form::text('search', Input::get('search'), ['class' => 'form-control']) !!}
				<button class="btn btn-cwp-cyan" type="submit"><i class="fa fa-fw fa-search"></i> Buscar</button>

				@if(Input::get('search'))
					<button onclick="location.href='{{ route('admin.settings') }}'" type="button" class="btn btn-default"><i class="fa fa-fw fa-filter"></i> Limpiar filtro</button>
				@endif
			</div>
		{!! Form::close() !!}
		<div class="pull-right">
			<a href="{{ route('admin.settings.create') }}" class="btn btn-default"><i class="fa fa-fw fa-plus-circle cyan"></i> Nuevo parámetro</a>
		</div>
	</div>
	<br />

	<table class="table table-bordered table-striped table-hover data-table">
		<thead>
			<tr>
				<th>Nombre del parámetro</th>
				<th>Valor</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			@if(count($params) > 0)
				@foreach($params as $param)
				<tr>
					<td>{!! $param->option_name !!}</td>
					<td>{!! $param->option_value !!}</td>
					<td>
	                    {!! Html::btn_edit('admin.settings.edit', $param->option_name) !!}
	                    {!! Html::btn_destroy('admin.settings.destroy', $param->option_name, '¿Está seguro que desea eliminar este parámetro? Tome en cuenta que puede estar usándose actualmente en la aplicación y podría ocasionar un mal funcionamiento.') !!}
	                </td>
				</tr>
				@endforeach
			@else
				<tr>
					<td colspan="6" class="alert alert-warning text-center">
						<div class="">No hay opciones de configuración registrados</div>
					</td>
				</tr>
			@endif
		</tbody>
	</table>

	{!! str_replace('/?', '?', $params->appends(Input::except('page'))->render()) !!}
</div>
@stop