@extends('admin/layout')

@section('title')
	RESULTADOS DE GESTIÓN - FIJO
@stop

@section('content')

{!! Form::open(['class' => 'form-inline']) !!}
	<div class="form-group col-md-4">
		<label for="fecha_consulta">Mes: </label>
		<select class="meses form-control" name="fecha_consulta"></select>
	</div>
	<button type="submit" class="btn btn-default">Consultar</button>	
{!! Form::close() !!}	
<br><br>

<div class="row">
	<div class="col-md-6">
		<label>Nombre: </label> {{ $seller->name }}
	</div>
	<div class="col-md-6">
		<label>Tienda: </label> {{ $seller->shop->name }}
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered fixed-info">
			<thead>
				<tr>
					<th rowspan="2" style="vertical-align: middle;">Producto</th>
					<th colspan="3">Meta</th>
					<th colspan="3">Real</th>
					<th colspan="3">Resultado del Mix</th>
					<th rowspan="2" style="vertical-align: middle;">Proy. Cant.</th>
				</tr>
				<tr>
					<td>Meta</td><td>Renta</td><td>ARPU</td>
					<td>Cant.</td><td>Renta</td><td>ARPU</td>
					<td>Cumpl.</td><td>Peso</td><td>%</td>
				</tr>
				
				@foreach ($categories->sortBy('orden') as $category)
					{{--*/  $metaT = GoalSale::get_goal($category->subcategories, $goals) /*--}}
					{{--*/ $arpuT = GoalSale::get_arpu($category->subcategories, $goals) /*--}}
					{{--*/ $rentaT = $metaT * $arpuT /*--}}
					<tr>
						<td>{{ $category->name }}</td>
						<td>@if($metaT != 0) {{ $metaT }} @endif</td>
						<td>@if($rentaT != 0) {{ '$'.$rentaT }} @endif</td>
						<td>@if($arpuT != 0) {{ '$'.$arpuT }} @endif</td>
						<td></td><td></td><td></td>
						<td></td><td></td><td></td>
						<td></td>
					</tr>
				@endforeach
				<tr>
					<td>{{ 'TV+DTH' }}</td>
					<td></td><td></td><td></td>
					<td></td><td></td><td></td>
					<td></td><td></td><td></td>
					<td></td>
				</tr>
				
			</thead>
		</table>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered fixed-info">
			<thead>
				<tr>
					<th rowspan="2" style="vertical-align: middle;">Producto</th>
					<th colspan="3">O. Creadas</th>
					<th colspan="3">Status O. Creadas</th>
					<th colspan="8">Ordenes Pendientes</th>
					<th colspan="3" style="vertical-align: middle;">O. Creadas</th>
				</tr>
				<tr>
					<td>Cant.</td><td>Renta</td><td>ARPU</td>
					<td>Cerra.</td><td>Pend</td><td>Cancel</td>
					<td>Total</td><td>Flujo</td><td>R</td><td>S</td><td>DG</td><td>Asig</td><td>Inst</td><td>Fact</td>
					<td>Meta</td><td>Real</td><td>%Cump</td>
				</tr>
				
				@foreach ($categories->sortBy('orden') as $category)
					
					<tr>
						<td>{{ $category->name }}</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td><td></td><td></td>
						<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
						<td></td><td></td><td></td>
					</tr>
				@endforeach
				<tr>
					<td>{{ 'TV+DTH' }}</td>
					<td></td><td></td><td></td>
					<td></td><td></td><td></td>
					<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
					<td></td><td></td><td></td>
				</tr>
				
			</thead>
		</table>
	</div>
</div>
@stop