@extends('layouts.app')

@section('lang', 'ar')
@section('dir', 'rtl')

@section('title', 'Learner Profile')

@section('head')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&family=Rubik:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/learner/learner-profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/learner/learner-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('navigation')
    @include('components.navbars.learner-navbar')
@endsection

@section('content')
    {{-- @var User $user --}}
    {{-- @var object $stats --}}
    <main class="profile-page">


        {{-- Page Header --}}

        <section class="page-header">

            <div>

                <p class="page-label">
                    الحساب
                </p>

                <h1>
                    الملف الشخصي للمتعلم
                </h1>

                <p>
                    أدر بيانات حسابك وتابع رحلتك التعليمية.
                </p>

            </div>

        </section>



        {{-- Profile Layout --}}

        <section class="profile-layout">


            {{-- Left Column --}}

            <div class="left-column">


                {{-- Profile Overview --}}

                <div class="profile-card">

                    <div class="profile-cover"></div>

                    <div class="profile-content">

                        <div class="big-avatar">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>

                        <h2>
                            {{ $user->name }}
                        </h2>

                        <p class="role">
                            متعلم
                        </p>

                        <p class="email">
                            {{ $user->email }}
                        </p>

                    </div>

                </div>



                {{-- Personal Information --}}

                <div class="info-card">

                    <div class="card-title">

                        <div>

                            <h2>
                                المعلومات الشخصية
                            </h2>

                            <p>
                                عدّل بياناتك الأساسية من هنا.
                            </p>

                        </div>

                    </div>


                    <form action="{{ route('learner.profile.update') }}" method="POST" class="profile-form">

                        @csrf

                        @method('PATCH')


                        {{-- Name --}}

                        <div class="form-group">

                            <label for="name">
                                الاسم بالكامل
                            </label>

                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                maxlength="255" required>

                            @error('name')
                                <span class="form-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        {{-- Email --}}

                        <div class="form-group">

                            <label for="email">
                                البريد الإلكتروني
                            </label>

                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                maxlength="255" required>

                            @error('email')
                                <span class="form-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        {{-- Account Type --}}

                        <div class="info-item">

                            <span class="info-label">
                                نوع الحساب
                            </span>

                            <strong>
                                متعلم
                            </strong>

                        </div>


                        {{-- Join Date --}}

                        <div class="info-item">

                            <span class="info-label">
                                تاريخ الانضمام
                            </span>

                            <strong>
                                {{ $user->created_at?->translatedFormat('F Y') }}
                            </strong>

                        </div>


                        <button type="submit" class="edit-btn">
                            حفظ التغييرات
                        </button>

                    </form>

                </div>

            </div>



            {{-- Right Column --}}

            <div class="right-column">


                {{-- Learning Statistics --}}

                <div class="stats-card">

                    <div class="card-title">

                        <div>

                            <h2>
                                إحصائيات التعلّم
                            </h2>

                            <p>
                                ملخص نشاطك على المنصة
                            </p>

                        </div>

                    </div>


                    <div class="stats-grid">


                        {{-- Enrollments --}}

                        <div class="stat-box">

                            <span class="stat-icon">
                                📚
                            </span>

                            <strong>
                                {{ $stats['enrollments'] }}
                            </strong>

                            <span>
                                المسارات
                            </span>

                        </div>


                        {{-- Saved --}}

                        <div class="stat-box">

                            <span class="stat-icon">
                                ♥
                            </span>

                            <strong>
                                {{ $stats['saved'] }}
                            </strong>

                            <span>
                                المحفوظات
                            </span>

                        </div>


                        {{-- Reviews --}}

                        <div class="stat-box">

                            <span class="stat-icon">
                                ★
                            </span>

                            <strong>
                                {{ $stats['reviews'] }}
                            </strong>

                            <span>
                                التقييمات
                            </span>

                        </div>


                        {{-- Enrolled --}}

                        <div class="stat-box">

                            <span class="stat-icon">
                                ✓
                            </span>

                            <strong>
                                {{ $stats['enrollments'] }}
                            </strong>

                            <span>
                                مسارات بدأت
                            </span>

                        </div>

                    </div>

                </div>



                {{-- Account Information --}}

                <div class="interests-card">

                    <div class="card-title">

                        <div>

                            <h2>
                                معلومات الحساب
                            </h2>

                            <p>
                                معلومات أساسية عن حسابك
                            </p>

                        </div>

                    </div>


                    <div class="account-info">


                        <div class="account-info-item">

                            <span>
                                البريد الإلكتروني
                            </span>

                            <strong>
                                {{ $user->email }}
                            </strong>

                        </div>


                        <div class="account-info-item">

                            <span>
                                نوع الحساب
                            </span>

                            <strong>
                                متعلم
                            </strong>

                        </div>


                        <div class="account-info-item">

                            <span>
                                تاريخ الانضمام
                            </span>

                            <strong>
                                {{ $user->created_at?->format('Y/m/d') }}
                            </strong>

                        </div>

                    </div>

                </div>



                {{-- Logout --}}

                <div class="settings-card">

                    <div class="setting-row">

                        <div>

                            <strong>
                                تسجيل الخروج
                            </strong>

                            <span>
                                تسجيل الخروج من حسابك الحالي
                            </span>

                        </div>


                        <form action="{{ route('logout') }}" method="POST">

                            @csrf

                            <button type="submit" class="setting-btn logout-btn">
                                تسجيل الخروج
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </section>

    </main>
@endsection

@section('footer')
    @include('components.footers.home-footer')
@endsection
