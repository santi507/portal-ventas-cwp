@extends('admin/layout')

@section('back-route', route('admin.access'))

@section('title')
	PERMISOS
@endsection

@section('content')
	<h4>- {{ $permission->name }} -</h4>
	<h4>{{ $permission->description }}</h4>
	<br />

	<div class="row">
		<div class="col col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">ROLES CON ESTE PERMISO</h3>
				</div>
				<div class="panel-body">
					<ul>
					@foreach($permission->roles as $role)
						<li><a href="{{ route('admin.access.edit', $role->IDRoles) }}" target="_blank">{{ $role->name }}</a></li>
					@endforeach
					</ul>

					<br />
					<p>Super admins</p>
					<ul>
					@foreach($superadmin as $role)
						<li><a href="{{ route('admin.access.edit', $role->IDRoles) }}" target="_blank">{{ $role->name }}</a></li>
					@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
@stop