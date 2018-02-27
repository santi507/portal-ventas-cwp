@extends('admin/layout')

@section('breadcrumb')
    @parent
    <li><a href="{{ route('admin.settings') }}">Configuración</a></li>
    <li class="active">Editar parámetro de configuración</li>
@stop

@section('back-route', route('admin.settings'))

@section('content')
<h3>EDITAR PARÁMETRO "{{ $configuration->option_name }}"</h3>
<p class="text-center"><i class="fa fa-fw fa-lightbulb-o"></i> Aquí usted podrá cambiar el valor de un parámetro de configuración.</p>
<hr />

{!! Form::open(['route' => ['admin.settings.update', $configuration->option_name], 'method' => 'PUT']) !!}
    <div class="row">
        <div class="col-md-9">
            <div class="form-group row">
                <div class="col-md-6 text-right">Parámetro:</div>
                <div class="col-md-6">
                    <input autocomplete="off" class="form-control" name="option_name" type="text" disabled value="{{ $configuration->option_name }}" />
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6 text-right">Valor:</div>
                <div class="col-md-6">
                    <input autocomplete="off" class="form-control" name="option_value" type="text" value="{{ $configuration->option_value }}">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <div class="form-group row">
                <div class="col-md-6 col-md-offset-6">
                    <input id="save-changes" class="btn btn-block btn-lg btn-cwp btn-cwp-cyan" type="submit" value="GUARDAR CAMBIOS">
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}
@stop