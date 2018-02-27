@extends('admin/layout')

@section('breadcrumb')
    @parent
    <li class="active">Roles y permisos</li>
@stop

@section('title')
	ROLES Y PERMISOS
@endsection


@section('content')
	<p><i class="fa fa-fw fa-lightbulb-o"></i> La gestión de usuarios por rol se hace a través de Service Desk.</p>

	<div class="clearfix">
		<div class="pull-right">
			<a href="{{ route('admin.access.permission') }}" class="btn btn-default">
				<i class="fa fa-fw fa-list cyan"></i> Listado de permisos
			</a>
			<a href="{{ route('admin.access.create') }}" class="btn btn-default">
				<i class="fa fa-fw fa-plus-circle cyan"></i> Nuevo rol
			</a>
		</div>
	</div>

	<br />

	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th></th>
				<th>Nombre del rol</th>
				<th>Description</th>
				<th>Permisos</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($roles as $role)
				<tr>
					<td>{{ $role->IDRoles }}</td>
					<td><a href="{{ route('admin.access.edit', $role->IDRoles) }}">{{ $role->name }}</a></td>
					<td>{{ $role->description }}</td>
					<td>{{ count($role->permissions) }}</td>
					<td>
						{!! HTML::btn_edit('admin.access.edit', $role->IDRoles) !!}
						{!! HTML::btn_destroy('admin.access.destroy', $role->IDRoles) !!}
					</td>
				</tr>
			@endforeach

		</tbody>
	</table>
@stop