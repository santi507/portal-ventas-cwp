<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', config('app.name')) | Cable &amp; Wireless Panama</title>
        <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" />
        <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/vendor/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/vendor/DataTables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/master.css') }}" rel="stylesheet" type="text/css" />
        @yield('styles')

    </head>
    <body class="@yield('body-class', 'cwp')">
        <div id="wrapper">
            
            @yield('body')
        </div>

        {{-- <div id="footer">
            <div class="container">
                <div class="row">
                    Copyright {{ date('Y') }}. {!! link_to('http://www.cwpanama.com', 'Cable &amp; Wireless Panama') !!}. All Rights Reserved
                </div>
                <div class="row">
                    {!! link_to('http://www.cwc.com/', 'Cable &amp; Wireless Communications', ['target' => 'blank']) !!} |
                    {!! link_to('http://www.cwc.com/live/footer/privacy-statement.html', 'Privacy statement') !!} |
                    {!! link_to('http://www.cwc.com/live/footer/legal-notice.html', 'Legal notices') !!}
                </div>
            </div>
        </div> --}}
        <script type="text/javascript">
            var app_url = '{{ URL::to('/') }}';
        </script>
        <script type="text/javascript" src="{{ asset('assets/js/lib/jquery-1.11.1.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/vendor/moment/moment.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/vendor/moment/locale/es.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/vendor/bootstrap/js/bootstrap-datetimepicker.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/vendor/select2/js/select2.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/lib/biginteger.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/vendor/DataTables/datatables.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/util/general.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/hotfix.js') }}"></script>
        @yield('scripts')

        @section('analytics')
        @show
    </body>
</html>