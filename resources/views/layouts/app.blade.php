<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Timezone -->
    <meta name="timezone" />
    <meta name="country" />
    <title>Psychologists Online</title>
    <!-- Fav -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600">
    <!-- Icons -->
    <link rel="stylesheet" href="//cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <!-- Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <!-- App Theme -->
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/js/theme.min.js') }}"></script>
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/css/select2.css') }}">
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <!-- Sweet Alert -->
    <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/swal-alert.js') }}"></script>
    <!-- Pusher Echo -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <!-- Livewire -->
    @livewireStyles
    @livewireScripts
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
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
            @include('partials.dashboard.footer')
        </main>
    </div>
    <livewire:meeting-notifier />
</body>

</html>
