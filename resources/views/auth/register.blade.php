@extends('layouts.guest')

@section('lang', 'ar')
@section('dir', 'rtl')

@section('title', 'Register')

@section('head')
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/auth.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo.ico') }}">
@endsection

@section('content')
    <main class="auth-page-wrapper">
        <div class="auth-container">

            {{-- Register Form --}}
            <div class="auth-form-side">

                <div class="auth-form-header">
                    <h1>إنشاء حساب</h1>
                    <p>أنشئ حسابك وابدأ رحلتك التعليمية</p>
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

                <form method="POST" action="{{ route('register.store') }}">
                    @csrf

                    {{-- Name --}}
                    <div class="auth-form-group">
                        <label class="auth-form-label" for="name">
                            الاسم
                        </label>

                        <input type="text" id="name" name="name" class="auth-form-input"
                            value="{{ old('name') }}" placeholder="أدخل اسمك" autocomplete="name" required autofocus>
                    </div>

                    {{-- Email --}}
                    <div class="auth-form-group">
                        <label class="auth-form-label" for="email">
                            البريد الإلكتروني
                        </label>

                        <input type="email" id="email" name="email" class="auth-form-input"
                            value="{{ old('email') }}" placeholder="example@email.com" autocomplete="email" required>
                    </div>

                    {{-- Password --}}
                    <div class="auth-form-group">
                        <label class="auth-form-label" for="password">
                            كلمة المرور
                        </label>

                        <input type="password" id="password" name="password" class="auth-form-input"
                            placeholder="أدخل كلمة المرور" autocomplete="new-password" required>
                    </div>

                    {{-- Password Confirmation --}}
                    <div class="auth-form-group">
                        <label class="auth-form-label" for="password_confirmation">
                            تأكيد كلمة المرور
                        </label>

                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="auth-form-input" placeholder="أعد إدخال كلمة المرور" autocomplete="new-password"
                            required>
                    </div>

                    <button type="submit" class="auth-submit-btn">
                        إنشاء الحساب
                    </button>
                </form>

                <div class="auth-switch-link">
                    لديك حساب بالفعل؟
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

                <h2>ابدأ رحلتك التعليمية</h2>

                <p>
                    أنشئ حسابك للوصول إلى المسارات التعليمية
                    المنظمة ومتابعة تقدمك في المجال الذي تختاره.
                </p>

            </div>

        </div>
    </main>
@endsection

@section('footer')
    @include('components.footers.auth-footer')
@endsection
