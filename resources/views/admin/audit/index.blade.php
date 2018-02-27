@extends('admin/layout')

@section('breadcrumb')
    @parent
    <li class="active">Auditoría</li>
@stop

@section('title')
    Auditoría
@endsection

@section('content')
    <br />

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Filtros de búsqueda</h3>
        </div>

        <div class="panel-body">
            {!! Form::open(array('route' => ['admin.audit'], 'method' => 'GET', 'class' => 'form-horizontal')) !!}

            <div class="row">
                <div class="col-xs-8 col-xs-offset-2">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label class="col-md-12">Usuario:</label>  
                                <div class="col-md-12">
                                    {!! Form::select('user', [null => '- Todos -']+$users, Input::get('user'), ['class' => 'form-control']) !!}
                                    <span class="help-block">Nombre de usuario administrador</span>  
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label class="col-md-12">Rol / Grupo:</label>  
                                <div class="col-md-12">
                                    {!! Form::select('role', [null => '- Todos -']+$roles, Input::get('role'), ['class' => 'form-control']) !!}
                                    <span class="help-block">Rol o grupo de Active Directory</span>  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label class="col-md-12">Módulo:</label>  
                                <div class="col-md-12">
                                    {!! Form::select('module', [null => '- Todos -']+$modules, Input::get('module'), ['class' => 'form-control']) !!}
                                    <span class="help-block">Módulo del sistema</span>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-xs-offset-2">
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! link_to_route('admin.audit', 'Reiniciar filtros', null, ['class' => 'btn btn-block btn-lg btn-cwp btn-cwp-gray']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-xs-4">
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::submit('Filtrar', ['class' => 'btn btn-block btn-lg btn-cwp btn-cwp-cyan']) !!}
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Resultado</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12">
                    <div class="text-right">Total de acciones: {{ count($logs) }}</div>
                    <table class="table table-responsive table-striped table-bordered table-hover table-audit">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Usuario</th>
                                <th>Módulo</th>
                                <th>Acción</th>
                                <th class="col-md-6">Contexto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $log)
                            <tr>
                                <td class="text-center td-trim">
                                    {{ strtolower(Carbon\Carbon::parse($log->created_at)->format('d/M/Y')) }}<br />
                                    {{ Carbon\Carbon::parse($log->created_at)->format('h:i a') }}
                                </td>
                                <td class="text-center td-trim">
                                    <strong>{{ $log->user }}</strong>
                                    <br />
                                    <small>({{ $log->role }})</small>
                                </td>
                                <td class="text-center td-trim">
                                    {{ $log->module }}
                                </td>
                                <td class="text-center td-trim">
                                    {{ $log->action }}
                                </td>
                                <td>
                                    {!! $log->getPrettyContext() !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {!! str_replace('/?', '?', $logs->appends(Input::except('page'))->render()) !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('styles')
    @parent
    <style>
        .table-audit pre {
            font-size: .75em;
        }

        .table-audit .info {
            border: 1px solid white;
            border-radius: 8px;
            padding: 10px;
            margin-top: 8px;
            -webkit-box-shadow: 0px 4px 10px 0px rgba(50, 50, 50, 0.75);
            -moz-box-shadow: 0px 4px 10px 0px rgba(50, 50, 50, 0.75);
            box-shadow: 0px 1px 4px 0px rgba(50, 50, 50, 0.75);
        }

        .table-audit .info .field {
            border-bottom: 1px solid #DDD;
            padding: 10px 0;
        }

        .table-audit .info .field:last-child {
            border-bottom: 0;
        }

        .table-audit th.td-trim {
            width: 1%;
            white-space: nowrap;
        }

        .table-audit .info {
            display: none;
        }
    </style>
@stop

@section('scripts')
    @parent
    <script>
        $(document).on('ready', function() {
            $('.show-info').on('click', function() {
                $(this).parent().parent().children('.info').toggle();
                $(this).text($(this).text() == '+ Mostrar detalle' ? '- Ocultar detalle' : '+ Mostrar detalle');
            });
        });
    </script>
@stop