@extends('admin/layout')

@section('breadcrumb')
    @parent
	<li><a href="{{ route('admin.support') }}">Soporte</a></li>
	<li class="active">Disponibilidad de servicios</li>
@stop

@section('styles')
	@parent
	<style>
		a:hover,a:focus{
		    outline: none;
		    text-decoration: none;
		}
		.tab .nav-tabs{
		    position: relative;
		    border-bottom: 0 none;
		    background: #fff;
		}
		.tab .nav-tabs li{
		    text-align: center;
		    margin-right: 0;
		}
		.tab .nav-tabs li a{
		    font-size: 15px;
		    font-weight: 600;
		    color: #999;
		    text-transform: uppercase;
		    padding: 15px 30px;
		    background: #fff;
		    margin-right: 0;
		    border-radius: 0;
		    border: 1px solid #ddd;
		    border-right: none;
		    border-bottom: 2px solid #ddd;
		    position: relative;
		}
		.tab .nav-tabs li:last-child a,
		.tab .nav-tabs li:last-child.active a,
		.tab .nav-tabs li:last-child a:hover{
		    border-right: 1px solid #ddd;
		}

		.tab .nav-tabs li a:hover,
		.tab .nav-tabs li a:focus,
		 {
			color: #00A7CF;
		}

		.tab .nav-tabs li.active a{
		    color: #00A7CF;
		    border-bottom: 2px solid #00A7CF;
		    border-right: none;
			border-top: 1px solid #ddd !important;
			border-left: 1px solid #ddd !important;
		}
		.tab .tab-content{
		    font-size: 14px;
		    color: #6f6c6c;
		    line-height: 26px;
		    padding: 20px 10px;
		    border:1px solid #ddd;
		    padding-bottom: 0;
		}
		.tab .tab-content h3{
		    font-size: 24px;
		    color: #6f6c6c;
		    margin-top: 0;
		}
		@media only screen and (max-width: 480px){
		    .tab .nav-tabs li{
		        width: 100%;
		        border-right: 1px solid #ddd;
		        margin-bottom: 8px;
		    }
		}
	</style>
@stop

@section('body-class')
    @parent
    reports-page
@stop

@section('content')
    <h3>Disponibilidad</h3>
    <p class="text-center"><i class="fa fa-fw fa-lightbulb-o"></i> Aquí usted verá los servicios y bases de datos a los que se conecta la aplicación y confirmar su disponibilidad.</p>
   <hr />

    <div class="row">
        <div class="col-md-12">
        	<div>
        		<i class="fa fa-fw fa-circle" style="color:#3c763d"></i> = Disponible<br />
        		<i class="fa fa-fw fa-circle" style="color:#DA242E"></i> = No disponible<br />
        	</div>
        	<br />
            <div class="tab" role="tabpanel">
	            <ul class="nav nav-tabs" role="tablist">
	                <li role="presentation" class="active"><a href="#nav_databases" role="tab" data-toggle="tab">Bases de datos</a></li>
	                <li role="presentation"><a href="#nav_services" role="tab" data-toggle="tab">Servicios</a></li>
	            </ul>

	            <!-- Tab panes -->
	            <div class="tab-content tabs">
	                <div role="tabpanel" class="tab-pane active" id="nav_databases">
						<table class="table table-bordered" id="dbs">
							<thead>
								<tr>
									<th>Nombre</th>
									<th>Driver</th>
									<th>Host</th>
									<th>Base de datos</th>
									<th>Usuario</th>
									<th>Estado</th>
								</tr>
							</thead>
							<tbody>
								@if(count($dbs) > 0)
									@foreach($dbs as $db)
										<tr>
											<td class="item-name">{{ $db['name'] }}</td>
											<td>{{ $db['driver'] }}</td>
											<td>{{ $db['host'] }}</td>
											<td>{{ $db['database'] }}</td>
											<td>{{ $db['username'] }}</td>
											<td class="item-status text-center"><i class="fa fa-fw fa-refresh fa-spin" style="color: #00A7CF"></i></td>
										</tr>
									@endforeach
								@else
									<tr><td colspan="3" class="alert alert-warning text-center">No se han registrado servicios web</tr>
								@endif
							</tbody>
						</table>
	                </div>
	                <div role="tabpanel" class="tab-pane" id="nav_services">
						<table class="table table-bordered" id="services">
							<thead>
								<tr>
									<th>Nombre del servicio</th>
									<th>Endpoint</th>
									<th>Estado</th>
								</tr>
							</thead>
							<tbody>
								@if(count($services) > 0)
									@foreach($services as $service)
										<tr>
											<td class="item-name">{{ $service['name'] }}</td>
											<td>{{ $service['endpoint'] }}</td>
											<td class="item-status text-center"><i class="fa fa-fw fa-refresh fa-spin" style="color: #00A7CF"></i></td>
										</tr>
									@endforeach
								@else
									<tr><td colspan="3" class="alert alert-warning text-center">No se han registrado servicios web</tr>
								@endif
							</tbody>
						</table>
	                </div>
	            </div>
			</div>
        </div>
    </div>
@stop

@section('scripts')
	<script>
		$(document).on('ready', function() {
			$('#services tbody tr').each(function(num, obj) {
				var name = $(obj).find('.item-name').html();

		        $.ajax({
		            type: "POST",
		            url: '{{ route('api.availability.check', 'service') }}',
		            data: {
		            	'name': name,
	            		'_token': '{{ csrf_token() }}'
	            	},
		            success: function(response) {
		                success = response.success;

		                if (success) {
		                	$(obj).find('.item-status').html('<i class="fa fa-fw fa-circle" style="color:#3c763d"></i>');
		                } else {
		                	$(obj).find('.item-status').html('<i class="fa fa-fw fa-circle" style="color:#DA242E"></i>');
		                	$(obj).addClass('alert alert-danger');
		                }
		            },
		            error: function(response) {
						$(obj).find('.item-status').html('<i class="fa fa-fw fa-circle" style="color:#DA242E"></i>');
						$(obj).addClass('alert alert-danger');
		            }
		        });
			});

			$('#dbs tbody tr').each(function(num, obj) {
				var name = $(obj).find('.item-name').html();

		        $.ajax({
		            type: "POST",
		            url: '{{ route('api.availability.check', 'db') }}',
		            data: {
		            	'name': name,
	            		'_token': '{{ csrf_token() }}'
	            	},
		            success: function(response) {
		                success = response.success;

		                if (success) {
		                	$(obj).find('.item-status').html('<i class="fa fa-fw fa-circle" style="color:#3c763d"></i>');
		                } else {
		                	$(obj).find('.item-status').html('<i class="fa fa-fw fa-circle" style="color:#DA242E"></i>');
		                	$(obj).addClass('alert alert-danger');
		                }
		            },
		            error: function(response) {
						$(obj).find('.item-status').html('<i class="fa fa-fw fa-circle" style="color:#DA242E"></i>');
						$(obj).addClass('alert alert-danger');
		            }
		        });
			});
		});
	</script>
@stop