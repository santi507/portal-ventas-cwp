@extends('admin/layout')

@section('title')
	Reportes de Tiendas
@stop

@section('content')
	{{--*/ $nt = 'CRR80436' /*--}}
	<div class="row">
		<div class="col-md-4">
			<a href="{{ route('admin.reports.shop.fixed.seller',['nt' => $nt]) }}" 
			   style="text-decoration: none;">
				<div class="text-center card-report fijo">
					<span>
						<i class="fa fa-globe"></i> Fijo
					</span>
				</div>
			</a>
		</div>
		<div class="col-md-4">
			<a href="{{ route('admin.reports.shop.movil.seller',['nt' => $nt]) }}" 
			   style="text-decoration: none;">
				<div class="text-center card-report movil">
					<span>
						<i class="fa fa-mobile-phone"></i> Móvil
					</span>
				</div>
			</a>
		</div>
		<div class="col-md-4">
			<div class="text-center card-report desco">
				<span>
					<i class="fa fa-plug"></i> Desconexiones
				</span>
			</div>
		</div>
	</div>
		
	
@stop