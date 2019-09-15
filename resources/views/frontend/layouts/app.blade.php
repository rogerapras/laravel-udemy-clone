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
        <meta name="description" content="@yield('meta_description', 'Laravel Boilerplate')">
        <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
        @yield('meta')

        {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
        @stack('before-styles')

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        
        {{ style(mix('css/frontend.css')) }}

        @stack('after-styles')
    </head>
    <body>
        @include('includes.partials.read-only')

        <div id="app">
            <div id="wrapper" class="" style="height: 100vh !important;">
                <div class="wrapper-inner">

                    @include('includes.partials.logged-in-as')
                    <section class="desktop__nav d-none d-lg-block">
                        @include('frontend.includes.nav')
                    </section>
                    <section class="mobile__nav d-block d-lg-none">
                        @include('frontend.includes.nav_mobile')
                    </section>
                    
                    @include('includes.partials.messages')
                    @yield('content')

                </div>

                <footer class="gabs__footer mt-autox py-3 bg-dark text-white" style="height: 200px;">
                    <div class="container">
                        <span class="text-mutedx">Place sticky footer content here.</span>
                    </div>
                </footer>

            </div>
        </div><!-- #app -->

        <!-- Scripts -->
  
        @stack('before-scripts')
        <script src="/js/lang.js"></script>
        {!! script(mix('js/frontend.js')) !!}
        @stack('after-scripts')
  

        @include('includes.partials.ga')
    </body>
</html>
