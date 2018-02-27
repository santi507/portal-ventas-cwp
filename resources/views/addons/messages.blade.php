@if(Session::has('success'))
    <div class="wa-alert alert alert-success">{!! Session::pull('success') !!}</div>
@endif

@if(isset($success))
    <div class="wa-alert alert alert-success">{!! $success !!}</div>
@endif

@if(Session::has('error'))
    <div class="wa-alert alert alert-danger">{!! Session::pull('error') !!}</div>
@endif

@if(Session::has('warning'))
    <div class="wa-alert alert alert-warning">{!! Session::pull('warning') !!}</div>
@endif

@if(isset($error))
    <div class="wa-alert alert alert-danger">{!! $error !!}</div>
@endif

@if (session()->has('flash_notification.message'))
    <div class="alert alert-{{ session('flash_notification.level') }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        {!! session('flash_notification.message') !!}
    </div>
@endif