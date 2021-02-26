<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- SEO -->
    <title> @yield('title') | Psychologists Online </title>
    @yield('seo')
    <!-- Styles -->
    @include('partials.global.styles')
    @yield('styles')
</head>
<body class="default-skin">
    <main class="auth">
        @include('partials.global.outdated-alert')
        <header id="auth-header" class="auth-header bg-primary" style="background-image: url({{asset('assets/images/img-1.png')}})">
            <a href="/" class="text-white">
                <img src="{{ asset('assets/images/logo-big-white.png')}}" height="200" class="mb-2" alt="">
            </a>
            @if(isset($redirect)) {!! $redirect !!} @endif
            <canvas class="particles-js-canvas-el" width="1006" height="253" style="width: 100%; height: 100%;"></canvas>
        </header>
        @yield('content')
        <footer class="auth-footer"> © 2018 All Rights Reserved. <a href="#">Privacy</a> and <a href="#">Terms</a></footer>
        @include('partials.global.languages')
    </main>
    <br><br>
    <!-- Scripts -->
    @include('partials.global.scripts')
    @yield('scripts')
    <script src="{{asset('assets/js/particles.js')}}"></script>
    <script>
        $(document).on('theme:init', () => {
            particlesJS.load('auth-header', "{{asset('assets/js/data/particles.json')}}");
        });
    </script>
</body>
</html>
