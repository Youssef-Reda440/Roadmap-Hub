@extends('layouts.app')

@section('lang', 'ar')
@section('dir', 'rtl')

@section('title', 'Learner Dashboard')

@section('head')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&family=Rubik:wght@400;500;600;700&display=swap">

    <link rel="stylesheet" href="{{ asset('css/learner/learner-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/learner/learner-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/style.css') }}">
@endsection

@section('navigation')
    @include('components.navbars.learner-navbar')
@endsection

@section('content')

    {{-- @var object $reviews --}}
    {{-- @var object $enrolledRoadmaps --}}
    {{-- @var object $savedRoadmaps --}}

    <main class="dashboard">

        {{-- Welcome --}}
        <section class="welcome-section">

            <div class="welcome-content">

                <p class="welcome-small">
                    مرحبًا بعودتك
                </p>

                <h1>
                    واصل تعلّمك،<br>
                    <span>{{ auth()->user()->name }}.</span>
                </h1>

                <p class="welcome-description">
                    واصل رحلتك التعليمية واستكشف المسارات المناسبة لأهدافك.
                </p>

            </div>


            {{-- Creator Application CTA --}}
            <div class="creator-cta">

                <div class="creator-cta-icon">
                    <i class="bi bi-lightbulb"></i>
                </div>

                <div class="creator-cta-content">

                    <span class="creator-cta-label">
                        شارك معرفتك
                    </span>

                    <h2>
                        كن منشئ محتوى
                    </h2>

                    <p>
                        حوّل خبرتك إلى مسارات تعليمية وساعد الآخرين
                        في بناء رحلتهم التعليمية.
                    </p>

                </div>

                <a href="{{ route('learner.creator-application.show') }}" class="creator-cta-btn">
                    كن منشئ محتوى
                    <i class="bi bi-arrow-left"></i>
                </a>

            </div>

        </section>


        {{-- Stats --}}
        <section class="stats-grid">

            <div class="stat-card">

                <div class="stat-icon blue">
                    <i class="bi bi-book"></i>
                </div>

                <div>
                    <span class="stat-label">
                        المسارات المسجلة
                    </span>

                    <h2>
                        {{ $enrolledRoadmaps->count() }}
                    </h2>
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon yellow">
                    <i class="bi bi-bookmark"></i>
                </div>

                <div>
                    <span class="stat-label">
                        المسارات المحفوظة
                    </span>

                    <h2>
                        {{ $savedRoadmaps->count() }}
                    </h2>
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon green">
                    <i class="bi bi-star"></i>
                </div>

                <div>
                    <span class="stat-label">
                        مراجعاتي
                    </span>

                    <h2>
                        {{ $reviews->count() }}
                    </h2>
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon purple">
                    <i class="bi bi-bar-chart"></i>
                </div>

                <div>
                    <span class="stat-label">
                        متوسط تقييماتي
                    </span>

                    <h2>
                        {{ $reviews->count() ? number_format($reviews->avg('rating'), 1) : '—' }}
                    </h2>
                </div>

            </div>

        </section>


        {{-- My Learning --}}
        <section class="section">

            <div class="section-header">

                <div>
                    <p class="section-label">
                        تعلّمي
                    </p>

                    <h2>
                        المسارات الحالية
                    </h2>
                </div>

                <a href="{{ route('learner.learning.index') }}" class="view-all">
                    عرض الكل ←
                </a>

            </div>


            @if ($enrolledRoadmaps->isEmpty())

                <div class="empty-state">

                    <div class="empty-state-icon">
                        <i class="bi bi-book"></i>
                    </div>

                    <h3>
                        لا توجد مسارات حتى الآن
                    </h3>

                    <p>
                        ابدأ رحلتك التعليمية باكتشاف أحد المسارات المتاحة.
                    </p>

                    <a href="{{ route('roadmaps.index') }}" class="primary-btn">
                        استكشف المسارات
                    </a>

                </div>
            @else
                <div class="roadmap-grid">

                    @foreach ($enrolledRoadmaps->take(3) as $enrollment)
                        @php
                            $roadmap = $enrollment->roadmap;
                        @endphp

                        <article class="roadmap-card">

                            <div class="card-top">

                                <div class="roadmap-category">
                                    {{ $roadmap->category->name }}
                                </div>

                                <span class="roadmap-level">
                                    {{ match ($roadmap->level) {
                                        'beginner' => 'مبتدئ',
                                        'intermediate' => 'متوسط',
                                        'advanced' => 'متقدم',
                                        default => $roadmap->level,
                                    } }}
                                </span>

                            </div>

                            <h3>
                                {{ $roadmap->title }}
                            </h3>

                            <p class="card-description">
                                {{ \Illuminate\Support\Str::limit($roadmap->description, 120) }}
                            </p>

                            <div class="card-meta">

                                <span>
                                    <i class="bi bi-person"></i>
                                    {{ $roadmap->creator->name }}
                                </span>

                                <span>
                                    <i class="bi bi-calendar3"></i>
                                    {{ $enrollment->enrolled_at?->format('Y/m/d') }}
                                </span>

                            </div>

                            <div class="card-footer">

                                <span>
                                    مسار مسجل
                                </span>

                                <a href="{{ route('learner.learning.show', $roadmap) }}" class="continue-btn">
                                    متابعة
                                </a>

                            </div>

                        </article>
                    @endforeach

                </div>

            @endif

        </section>


        {{-- Saved Roadmaps --}}
        <section class="section recommended-section">

            <div class="section-header">

                <div>
                    <p class="section-label">
                        محفوظاتك
                    </p>

                    <h2>
                        المسارات المحفوظة
                    </h2>
                </div>

                <a href="{{ route('learner.saved-roadmaps.index') }}" class="view-all">
                    عرض الكل ←
                </a>

            </div>


            @if ($savedRoadmaps->isEmpty())

                <div class="empty-state">

                    <div class="empty-state-icon">
                        <i class="bi bi-bookmark"></i>
                    </div>

                    <h3>
                        لا توجد مسارات محفوظة
                    </h3>

                    <p>
                        احفظ المسارات التي تريد الرجوع إليها لاحقًا.
                    </p>

                </div>
            @else
                <div class="recommendation-grid">

                    @foreach ($savedRoadmaps->take(2) as $savedRoadmap)
                        @php
                            $roadmap = $savedRoadmap->roadmap;
                        @endphp

                        <article class="recommendation-card">

                            <div class="recommendation-icon">
                                <i class="bi bi-bookmark"></i>
                            </div>

                            <div class="recommendation-content">

                                <span>
                                    {{ $roadmap->category->name }}
                                </span>

                                <h3>
                                    {{ $roadmap->title }}
                                </h3>

                                <p>
                                    {{ \Illuminate\Support\Str::limit($roadmap->description, 110) }}
                                </p>

                                <div class="recommendation-footer">

                                    <span>
                                        {{ $roadmap->creator->name }}
                                    </span>

                                    <a href="{{ route('roadmaps.show', $roadmap) }}">
                                        عرض المسار ←
                                    </a>

                                </div>

                            </div>

                        </article>
                    @endforeach

                </div>

            @endif

        </section>


        {{-- My Reviews --}}
        <section class="section">

            <div class="section-header">

                <div>
                    <p class="section-label">
                        تقييماتك
                    </p>

                    <h2>
                        آخر مراجعاتك
                    </h2>
                </div>

            </div>


            @if ($reviews->isEmpty())

                <div class="empty-state">

                    <div class="empty-state-icon">
                        <i class="bi bi-star"></i>
                    </div>

                    <h3>
                        لم تكتب أي مراجعات بعد
                    </h3>

                    <p>
                        شارك تجربتك بعد استخدام أحد المسارات التعليمية.
                    </p>

                </div>
            @else
                <div class="reviews-list">

                    @foreach ($reviews->take(3) as $review)
                        <article class="review-item">

                            <div class="review-item-header">

                                <div>

                                    <h4>
                                        {{ $review->roadmap->title }}
                                    </h4>

                                    <span>
                                        {{ $review->created_at?->format('Y/m/d') }}
                                    </span>

                                </div>

                                <div class="review-rating">

                                    <i class="bi bi-star-fill"></i>

                                    {{ $review->rating }}/5

                                </div>

                            </div>

                            <p>
                                {{ $review->comment }}
                            </p>

                        </article>
                    @endforeach

                </div>

            @endif

        </section>

    </main>

@endsection

@section('footer')
    @include('components.footers.home-footer')
@endsection
