@extends('admin/layout')

@section('breadcrumb')
    @parent
      <li class="active">Soporte</li>
@stop

@section('body-class')
    @parent
    reports-page
@stop

@section('styles')
    @parent
    <style>
        .reports-page a.report {
            display: block;
            text-decoration: none;
        }

        .reports-page a.report:hover {
            background: #7C7C7D;
        }

        .reports-page a.report:hover .title,
        .reports-page a.report:hover .fa {
            color: #FFF;
        }
        .reports-page .report {
            text-align: center;
            border: 1px solid #ddd;
            padding: 30px;
            border-radius: 10px;
        }

        .reports-page .report .title {
            font-size: 1.2em;
        }
    </style>
@stop

@section('scripts')
	@parent
@stop

@section('title')
    Soporte
@endsection

@section('content')
    <p class="text-center"><i class="fa fa-fw fa-lightbulb-o"></i> Elija la opción que desee para continuar.</p>
   <hr />

    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('log-viewer::dashboard') }}" target="_blank" class="report" data-toggle="tooltip" title="Visor de los archivos laravel.log">
                <div class="icon">
                    <i class="fa fa-3x fa-file-text-o"></i>
                </div>
                <br />
                <div class="title">
                    Logs
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('admin.support.availability') }}" class="report" data-toggle="tooltip" title="Ver errores al momento de crear clientes y órdenes">
                <div class="icon">
                    <i class="fa fa-3x fa-clock-o"></i>
                </div>
                <br />
                <div class="title">
                    Disponibilidad
                </div>
            </a>
        </div>
    </div>
@stop