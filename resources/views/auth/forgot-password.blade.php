@extends('layouts.guest')

@section('lang', 'ar')
@section('dir', 'rtl')

@section('title', 'Forgot-Password')

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

            {{-- Forgot Password Form --}}
            <div class="auth-form-side">

                <div class="auth-form-header">
                    <h1>استعادة كلمة المرور</h1>
                    <p>أدخل بريدك الإلكتروني لإرسال رابط إعادة تعيين كلمة المرور</p>
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

                {{-- Status Message --}}
                @if (session('status'))
                    <div class="auth-alert auth-alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="auth-form-group">
                        <label class="auth-form-label" for="email">
                            البريد الإلكتروني
                        </label>

                        <input type="email" id="email" name="email" class="auth-form-input"
                            value="{{ old('email') }}" placeholder="example@email.com" autocomplete="email" required
                            autofocus>
                    </div>

                    <button type="submit" class="auth-submit-btn">
                        إرسال رابط إعادة التعيين
                    </button>
                </form>

                <div class="auth-switch-link">
                    تذكرت كلمة المرور؟
                    <a href="{{ route('login') }}">
                        العودة لتسجيل الدخول
                    </a>
                </div>

            </div>

            {{-- Brand Side --}}
            <div class="auth-banner">

                <a href="{{ route('home.index') }}" class="auth-banner-logo">
                    <img src="{{ asset('assets/logo.ico') }}" alt="Roadmap Hub">

                    <span>Roadmap Hub</span>
                </a>

                <h2>استعد وصولك إلى حسابك</h2>

                <p>
                    أدخل البريد الإلكتروني المرتبط بحسابك،
                    وسنرسل لك رابطًا آمنًا لإعادة تعيين كلمة المرور.
                </p>

            </div>

        </div>
    </main>

@endsection

@section('footer')
    @include('components.footers.auth-footer')
@endsection
