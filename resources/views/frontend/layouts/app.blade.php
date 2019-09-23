@php
    $config = [
        'appName' => config('app.name'),
        'max_size' => setting('site.video_max_size_mb') ? (int)setting('site.video_max_size_mb') : 10,
        'default_currency' => setting('site.site_currency') ? setting('site.site_currency') : 'USD',
        'source' => setting('site.video_providers') ? setting('site.video_providers') : 'both'
    ];

    $pages = \App\Models\Page::where('published', true)->get();
@endphp

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
        <link rel="icon" href="{{ setting('site.favicon') }}">
        <meta name="description" content="@yield('meta_description', setting('site.site_description'))">
        <meta name="author" content="@yield('meta_author', 'ArcInspire')">
        @yield('meta')

        <script>window.config = @json($config);</script>

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
            <div id="wrapper">
                <div class="wrapper-inner" style="min-height: 100%;margin-bottom: -100px;">

                    @include('includes.partials.logged-in-as')
                    <section class="desktop__nav d-none d-lg-block">
                        @include('frontend.includes.nav')
                    </section>
                    <section class="mobile__nav d-block d-lg-none">
                        @include('frontend.includes.nav_mobile')
                    </section>
                    
                    @include('includes.partials.messages')
                    @yield('content')

                    <div class="push" style="height: 103px;"></div>
                </div>

                <footer class="gabs__footer mt-autox py-3 bg-dark text-white" style="height: 103px;">
                    <div class="container py-4">
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-inline">
                                    @foreach($pages as $page)
                                        <li class="list-inline-item">
                                            <a class="social-icon text-xs-center" href="{{ route('frontend.page', $page->slug) }}"> 
                                                {{ $page->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>


                            
                            <div class="col-md-6 text-right">
                                <div class="d-flex align-items-center justify-content-end">
                                    <!-- CURRENCY -->
                                    <div class="mr-3">
                                        <base-currency-switcher></base-currency-switcher>
                                    </div>

                                    <!-- LANGUAGE -->
                                    <div class="dropup">
                                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="about-us" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-globe"></i>
                                            <span class="text-uppercase">{{ app()->getLocale() }}</span>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="about-us">
                                            @foreach(\App\Models\Language::where('is_active', true)->get() as $lang)
                                                @if($lang->carbon_code != app()->getLocale())
                                                    <a class="dropdown-item" href="{{ '/lang/'.$lang->carbon_code }}">
                                                        @lang('menus.language-picker.langs.'.$lang->carbon_code)
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
