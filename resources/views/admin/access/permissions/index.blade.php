@extends('admin/layout')

@section('back-route', route('admin.access'))

@section('title')
	PERMISOS
@endsection

@section('content')
	

<div class="row">
	<div class="col-md-10 col-md-offset-1">
		@foreach($permissions as $permission)
		<div class="col-md-6">
			<table class="table">
				<tr>
					<td>
						{{ $permission->description }}<br />
						<small><a href="{{ route('admin.access.permission.show', $permission->IDPermissions) }}" title="Ver qué roles tienen este permiso">{{ $permission->name }}</a></small>
					</td>
				</tr>
			</table>
			</div>
		@endforeach
	</div>
</div>
@stop