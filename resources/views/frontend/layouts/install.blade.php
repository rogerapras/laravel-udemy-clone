<!DOCTYPE html>
@langrtl
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endlangrtl
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', app_name())</title>
        <meta name="description" content="@yield('meta_description', 'Laravel 5 Boilerplate')">
        <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
        @yield('meta')
        {{ style(mix('css/frontend.css')) }}

        <style>
            body{
                background: #e2e2e2;
            }
            [v-cloak]{
                display: none;
            }

            .progressbar {
                counter-reset: step;
            }
            .progressbar li {
                list-style-type: none;
                width: 20%;
                float: left;
                font-size: 12px;
                position: relative;
                text-align: center;
                text-transform: uppercase;
                color: #7d7d7d;
            }
            .progressbar li:before {
                width: 30px;
                height: 30px;
                content: counter(step);
                counter-increment: step;
                line-height: 30px;
                border: 2px solid #7d7d7d;
                display: block;
                text-align: center;
                margin: 0 auto 10px auto;
                border-radius: 50%;
                background-color: white;
            }
            .progressbar li:after {
                width: 100%;
                height: 2px;
                content: '';
                position: absolute;
                background-color: #7d7d7d;
                top: 15px;
                left: -50%;
                z-index: -1;
            }
            .progressbar li:first-child:after {
                content: none;
            }
            .progressbar li.active {
                color: green;
            }
            .progressbar li.active:before {
                border-color: #55b776;
            }
            .progressbar li.active + li:after {
                background-color: #55b776;
            }
        </style>
    </head>
    <body class="hold-transition h-100">
        <div id="app">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="mb-2 text-center">
                            <h1 class="h3">Place logo image {{ session('install_step', 0) }}</h1>
                            <div class="bg-white">
                                <ul class="progressbar">
                                    <li class="{{ active_class(if_route('frontend.installer.index')) }}">Start</li>
                                    <li class="{{ active_class(if_route('frontend.installer.requirements')) }}">Requirements</li>
                                    <li class="{{ active_class(if_route('frontend.installer.database')) }}">Database</li>
                                    <li class="{{ active_class(if_route('frontend.installer.settings')) }}">Settings</li>
                                    <li class="{{ active_class(if_route('frontend.installer.finish')) }}">Finish</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mx-auto">
                        @yield('content')
                    </div>
                </div>
            </div>
            
        </div><!-- #app -->

        <!-- Scripts -->
        <script src="/js/lang.js"></script>
        {!! script(mix('js/frontend.js')) !!}
    </body>
</html>
