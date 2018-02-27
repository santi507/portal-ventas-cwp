@extends('admin/layout')

@section('back-route', route('admin.access'))

@section('title')
	ROLES Y PERMISOS
@endsection

@section('content')
	<br />

<div class="row">
{!! Form::open(['route' => ['admin.access.update', $role->IDRoles], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
	<fieldset>
		<div class="form-group">
			<label class="col-md-4 control-label" for="name">Nombre del rol:</label>  
			<div class="col-md-4">
				<input id="name" name="name" type="text" class="form-control input-md" value="{{ $role->name }}">
				<div class="sidetip">
					{!! Form::fulgore__sidetip('name') !!}
				</div>
				<span class="help-block">Especificar nombre del rol tal cual como se ha creado en Active Directory.</span>  
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label" for="description">Descripción del rol:</label>  
			<div class="col-md-4">
				<input id="description" name="description" type="text" class="form-control input-md" value="{{ $role->description }}">
				<div class="sidetip">
					{!! Form::fulgore__sidetip('description') !!}
				</div>
				<span class="help-block">Especifique una descripción</span>  
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label" for="textinput">Asignar roles:</label>
			<div class="col-md-8"></div>
			<div class="sidetip col-md-8 col-md-offset-2">
				{!! Form::fulgore__sidetip('permissions') !!}
			</div>
		</div>
	</fieldset>

	<div class="col-md-10 col-md-offset-1">
		@foreach($permissions as $permission)
		<div class="col-md-6">
			<table class="table">
				<tr>
					<td width="28">
						@if (in_array($permission->IDPermissions, $role->permissions->lists('IDPermissions')->toArray()))
							{!! Form::checkbox('permissions[]', $permission->IDPermissions, true) !!}
						@else
							{!! Form::checkbox('permissions[]', $permission->IDPermissions) !!}
						@endif
					</td>
					<td>
						{{ $permission->description }}<br />
						<small><a href="{{ route('admin.access.permission.show', $permission->IDPermissions) }}" title="Ver qué roles tienen este permiso" target="_blank">{{ $permission->name }}</a></small>
					</td>
				</tr>
			</table>
		</div>
		@endforeach
	</div>

	<div class="submit text-center">
		{!! Form::submit('Guardar cambios', ['class' => 'btn btn-primary btn-cwp']) !!}
	</div>
{!! Form::close() !!}
</div>
@stop