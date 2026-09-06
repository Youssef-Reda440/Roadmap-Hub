<!DOCTYPE html>
<html lang="@yield('lang', 'en')" dir="@yield('dir', 'ltr')">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('description', 'Roadmap Hub - Learning platform for structured roadmaps and trusted resources.')">
    <meta name="author" content="Roadmap Hub">

    <title>@yield('title', 'Roadmap Hub')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('head')
</head>

<body>
    {{-- Role-specific navigation --}}
    @yield('navigation')

    {{-- Page Content --}}
    @yield('content')

    {{-- Shared Footer --}}
    @include('components.footer')
</body>

</html>
