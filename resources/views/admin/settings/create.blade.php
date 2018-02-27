@extends('admin/layout')

@section('breadcrumb')
    @parent
    <li><a href="{{ route('admin.settings') }}">Configuración</a></li>
    <li class="active">Nuevo parámetro de configuración</li>
@stop

@section('back-route', route('admin.settings'))

@section('title')
    NUEVO PARÁMETRO DE CONFIGURACIÓN
@endsection

@section('content')
<p class="text-center"><i class="fa fa-fw fa-lightbulb-o"></i> Debe llenar los siguientes campos que se solicitan a continuación.</p>
<hr />

{!! Form::open(['route' => ['admin.settings.store'], 'method' => 'POST']) !!}
    <div class="row">
        <div class="col-md-9">
            <div class="form-group row">
                <div class="col-md-6 text-right">Parámetro:</div>
                <div class="col-md-6">
                    <input autocomplete="off" class="form-control" name="option_name" type="text" value="{{ old('option_name') }}" />
                    <div class="sidetip">
                        {!! Form::fulgore__sidetip('option_name') !!}
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6 text-right">Valor:</div>
                <div class="col-md-6">
                    <input autocomplete="off" class="form-control" name="option_value" type="text" value="{{ old('option_value') }}">
                    <div class="sidetip">
                        {!! Form::fulgore__sidetip('option_value') !!}
                    </div>
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