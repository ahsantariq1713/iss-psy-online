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

<body>
    <div class="app has-fullwidth">
        @include('partials.global.outdated-alert')
        @include('partials.dashboard.header')
        <main class="app-main">
            <div class="wrapper">
                <div class="page">
                    <div class="page-inner">
                        <div class="container">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            @include('partials.dashboard.footer')
        </main>
    </div>
    <!-- Scripts -->
    @include('partials.global.scripts')
    @yield('scripts')
    <livewire:meeting-notifier />
</body>

</html>
