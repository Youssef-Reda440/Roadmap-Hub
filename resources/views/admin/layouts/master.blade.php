


@extends('layouts.app')

@section('title', 'Admin | Roadmap Hub')

@section('head')
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    @vite('resources/css/admin/admin.css')
@endsection

@section('navigation')
    @include('admin.components.header-nav')
@endsection

@section('content')
    <div class="admin-app d-flex flex-column min-vh-100">
        <div class="admin-main flex-grow-1">
            <main class="admin-content container py-4 py-lg-5">
                @include('admin.components.flash-messages')

                @yield('admin-content')
            </main>
        </div>
    </div>
@endsection

@section('footer')
    <footer class="admin-footer border-top bg-white mt-auto">
        <div class="container d-flex flex-column flex-sm-row justify-content-between gap-2 py-4 small text-secondary">
            <span>&copy; {{ now()->year }} Roadmap Hub</span>
            <span>Admin panel</span>
        </div>
    </footer>
@endsection
