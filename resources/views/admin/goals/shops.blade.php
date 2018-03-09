@extends('admin/layout')

@section('title')
	Metas de Tiendas
@stop

@section('content')
	
		<div class="row">
			<div class="col-md-6">
				<h4 class="g-s-t">Formato para metas de vendedores</h4>
				<div>
					<a href="{{ route('admin.goal.shops.format.sellers') }}" class="btn btn-default">Descargar formato</a>
				</div>
				
			</div>
			<div class="col-md-6">
				<h4 class="g-s-t">Cargar metas de vendedores</h4>
				{!! Form::open(['enctype' => 'multipart/form-data']) !!}
					<div class="form-group col-md-6">
						{!! Form::file('goal-shop-seller', array('class' => 'form-control')) !!}
					</div>
					{!! Form::button('Cargar metas', array('class' => 'btn btn-default')) !!}
				{!! Form::close() !!}
			</div>
		</div>
	
@stop