<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;400;700&family=DM+Sans:wght@400;700&family=Dancing+Script:wght@400;700&family=Montserrat+Subrayada&family=Montserrat:wght@200;400;700&family=Oswald:wght@200;300;700&family=Poppins:wght@300;700;800&family=Raleway:wght@300;600&family=Roboto:wght@100&family=Sen:wght@800&family=Signika+Negative:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"/>

    <!-- Scripts -->
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    @vite('resources/js/app.js')
</head>
<body style="font-family: DM Sans, sans-serif">
<div class="min-h-screen">

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>
</body>
</html>
