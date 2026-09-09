@extends('layouts.guest')

@section('lang', 'ar')
@section('dir', 'rtl')

@section('title', 'Reset-Password')

@section('head')
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/auth.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo.ico') }}">
@endsection

@section('content')
    {{-- @var object $request --}}
    <main class="auth-page-wrapper">
        <div class="auth-container">

            {{-- Reset Password Form --}}
            <div class="auth-form-side">

                <div class="auth-form-header">
                    <h1>إعادة تعيين كلمة المرور</h1>
                    <p>أنشئ كلمة مرور جديدة لحسابك</p>
                </div>

                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="auth-alert auth-alert-error">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="auth-form-group">
                        <label class="auth-form-label" for="email">
                            البريد الإلكتروني
                        </label>

                        <input type="email" id="email" name="email" class="auth-form-input"
                            value="{{ old('email', $request->email) }}" placeholder="example@email.com" autocomplete="email"
                            required autofocus>
                    </div>

                    <div class="auth-form-group">
                        <label class="auth-form-label" for="password">
                            كلمة المرور الجديدة
                        </label>

                        <input type="password" id="password" name="password" class="auth-form-input"
                            placeholder="أدخل كلمة المرور الجديدة" autocomplete="new-password" required>
                    </div>

                    <div class="auth-form-group">
                        <label class="auth-form-label" for="password_confirmation">
                            تأكيد كلمة المرور
                        </label>

                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="auth-form-input" placeholder="أعد إدخال كلمة المرور الجديدة" autocomplete="new-password"
                            required>
                    </div>

                    <button type="submit" class="auth-submit-btn">
                        إعادة تعيين كلمة المرور
                    </button>
                </form>

                <div class="auth-switch-link">
                    تذكرت كلمة المرور؟
                    <a href="{{ route('login') }}">
                        تسجيل الدخول
                    </a>
                </div>

            </div>

            {{-- Brand Side --}}
            <div class="auth-banner">

                <a href="{{ route('home.index') }}" class="auth-banner-logo">
                    <img src="{{ asset('assets/logo.ico') }}" alt="Roadmap Hub">

                    <span>Roadmap Hub</span>
                </a>

                <h2>أنشئ كلمة مرور جديدة</h2>

                <p>
                    اختر كلمة مرور قوية وجديدة لحماية حسابك
                    والعودة إلى رحلتك التعليمية بأمان.
                </p>

            </div>

        </div>
    </main>

@endsection

@section('footer')
    @include('components.footers.auth-footer')
@endsection
