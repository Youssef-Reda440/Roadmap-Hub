@extends('layouts.app')

@section('lang', 'ar')
@section('dir', 'rtl')

@section('title', 'My-Learning')

@section('head')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&family=Rubik:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/learner/my-learning.css') }}">
    <link rel="stylesheet" href="{{ asset('css/learner/learner-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('navigation')
    @include('components.navbars.learner-navbar')
@endsection

@section('content')
    {{-- @var object $enrollments --}}
    <main class="learning-page">

        {{-- Header --}}
        <section class="page-header">

            <div>

                <p class="page-label">
                    رحلتك التعليمية
                </p>

                <h1>
                    تعلّمي
                </h1>

                <p>
                    تابع رحلتك التعليمية واستكمل من حيث توقفت.
                </p>

            </div>

        </section>


        {{-- Learning Cards --}}
        <section class="learning-grid">

            @forelse ($enrollments as $enrollment)
                @php
                    $roadmap = $enrollment->roadmap;
                @endphp

                <div class="learning-card">

                    {{-- Card Header --}}
                    <div class="card-header">

                        <div class="category">
                            {{ $roadmap->category->name }}
                        </div>

                        <button type="button" class="more-btn" aria-label="خيارات المسار">
                            •••
                        </button>

                    </div>


                    {{-- Roadmap Title --}}
                    <h2>
                        {{ $roadmap->title }}
                    </h2>


                    {{-- Description --}}
                    <p class="description">
                        {{ $roadmap->description }}
                    </p>


                    {{-- Roadmap Info --}}
                    <div class="card-info">

                        <span>
                            المستوى:
                            {{ match ($roadmap->level) {
                                'beginner' => 'مبتدئ',
                                'intermediate' => 'متوسط',
                                'advanced' => 'متقدم',
                                default => $roadmap->level,
                            } }}
                        </span>

                        <span>
                            المدرب:
                            {{ $roadmap->creator->name }}
                        </span>

                    </div>


                    {{-- Continue --}}
                    <a href="{{ route('learner.learning.show', $roadmap) }}" class="continue-btn">
                        متابعة التعلّم ←
                    </a>

                </div>

            @empty

                <div class="empty-state">

                    <h2>
                        لم تبدأ أي مسار تعليمي بعد
                    </h2>

                    <p>
                        استكشف المسارات المتاحة وابدأ رحلتك التعليمية.
                    </p>

                    <a href="{{ route('roadmaps.index') }}" class="primary-btn">
                        استكشف المسارات
                    </a>

                </div>
            @endforelse

        </section>

    </main>

@endsection

@section('footer')
    @include('components.footers.home-footer')
@endsection
