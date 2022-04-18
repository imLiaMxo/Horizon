<!DOCTYPE html>
<html lang="en">
<head>
<meta name="og:title" content="{{$configs['meta_title']}}">
    <meta name="description" content="{{$configs['meta_description']}}">
    <meta name="og:description" content="{{$configs['meta_description']}}">
    <meta name="keywords" content="{{$configs['meta_keywords']}}">
    <meta name="theme-color" content="{{$configs['meta_color']}}">

    <meta name="og:type" content="{{$configs['meta_type']}}">
    <meta name="og:url" content="{{config('app.url')}}">
    <meta name="url" content="{{config('app.url')}}">
    <meta name="identifier-URL" content="{{config('app.url')}}">
    <meta name="author" content="Liam">
    <meta name="designer" content="Liam">
    <meta name="revisit-after" content="2 days">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="Security-Hash" content="{{config('auth.enhanced_security')}}">
    <meta name="robots" content="index,follow">

    <!-- Safari Browser -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ $configs['site_logo'] }}" type="image/x-icon">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ $configs['site_logo'] }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ $configs['site_logo'] }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ $configs['site_logo'] }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ $configs['site_logo'] }}">

    <!-- Twitter Embed -->
    <meta name="og:image" content="{{ $configs['site_logo'] }}">
    <meta name="twitter:image" content="{{ $configs['site_logo'] }}">
    <meta name="twitter:card" content="summary">

    <!-- Stuff -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet">
          <script>
            if (!('theme' in localStorage)) {
                localStorage.theme = 'dark';
            }
        
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark')
            } else {
                document.documentElement.classList.remove('dark')
            }
        
            function updateTheme(theme) {
                if (theme) {
                    localStorage.theme = theme;
                }
        
                switch (localStorage.theme) {
                    case 'system':
                        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                            document.documentElement.classList.add('dark');
                        } else {
                            document.documentElement.classList.remove('dark');
                        }
                        document.documentElement.setAttribute('color-theme', 'system');
                        break;
                    case 'dark':
                        document.documentElement.classList.add('dark');
                        document.documentElement.setAttribute('color-theme', 'dark');
                        break;
                    case 'light':
                        document.documentElement.classList.remove('dark');
                        document.documentElement.setAttribute('color-theme', 'light');
                        break;
                }
            }
        
            updateTheme();
        </script>

<!--
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
        -->

        <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
      </script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
      <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css">
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <title>{{$configs['site_name']}} | @yield('title')</title>
    </head>
    
    <body class="duration-500 bg-white dark:bg-gray-600">
        <div class="flex flex-col justify-between min-h-screen">
            <main class="mb-auto flex-grow" id="app">
                @yield('content')
            </main>
            @include('includes.footer')
            <script src="{{ asset('js/app.js') }}"></script>
            @yield('scripts')
        </div>
    </body>
</html>