<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Restaurant' }}</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    @livewireStyles
</head>

<body class="container">
    <main class="container mx-auto">
        {{ $slot }}
    </main>

    <footer class="bg-body-secondary text-center text-lg-start mt-3 rounded-top">
        <div class="text-center p-3">
            © 2020 Copyright:
            <a class="text-body" href="https://hay-project.vercel.app/">hayProject</a>
        </div>
    </footer>

    @livewireScripts
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
