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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    @yield('styles')
</head>
<body>
    <main class="app app-site">
        @include('partials.global.outdated-alert')
        @include('partials.site.nav')
        @yield('content')
        @include('partials.site.footer')
    </main>
    <!-- Scripts -->
    @include('partials.global.scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    @yield('scripts')

    <livewire:meeting-notifier />
</body>

</html>
