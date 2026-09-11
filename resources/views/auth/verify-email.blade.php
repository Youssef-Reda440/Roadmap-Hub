@extends('layouts.app')

@section('title', 'Verify Email')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body text-center p-5">
                        {{-- Icon --}}
                        <div class="mb-4">
                            <div class="d-inline-flex align-items-center justify-content-center
                                   bg-primary bg-opacity-10 text-primary rounded-circle"
                                style="width: 80px; height: 80px;">
                                <i class="fa-regular fa-envelope fa-2x"></i>
                            </div>
                        </div>

                        {{-- Title --}}
                        <h1 class="h3 fw-bold mb-3">
                            تحقق من بريدك الإلكتروني
                        </h1>

                        {{-- Description --}}
                        <p class="text-muted mb-4">
                            تم إرسال رابط التحقق إلى بريدك الإلكتروني.
                            <br>
                            افتح الرسالة واضغط على رابط التحقق لتفعيل حسابك.
                        </p>

                        {{-- Resend Form --}}
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf

                            <button type="submit" class="btn btn-primary px-4 py-2">
                                <i class="fa-solid fa-paper-plane me-2"></i>
                                إعادة إرسال رسالة التحقق
                            </button>
                        </form>

                        {{-- Success Message --}}
                        @if (session('status') === 'verification-link-sent')
                            <div class="alert alert-success mt-4 mb-0" role="alert">
                                تم إرسال رابط تحقق جديد إلى بريدك الإلكتروني.
                            </div>
                        @endif

                        {{-- Logout --}}
                        <div class="mt-4 pt-4 border-top">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit" class="btn btn-link text-decoration-none text-muted">
                                    تسجيل الخروج
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
