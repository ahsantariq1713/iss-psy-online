<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Video Call | Psychologists Online </title>
    <!-- Styles -->
    @include('partials.global.styles')
    <link rel="stylesheet" href="{{ asset('assets/css/pages/video-call.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    @include('partials.global.scripts')
    <script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    @yield('styles')
</head>

<body>
    <div class="app h-100 m-0 p-0">
        <main class="app-main h-100 p-0 m-0">
            <div class="wrapper h-100 p-0 m-0">
               @yield('content')
            </div>
        </main>
    </div>
</body>

</html>
