@extends('layouts.guest')

@section('lang', 'ar')
@section('dir', 'rtl')

{{-- @var object $roadmap --}}

@section('title', $roadmap->title)

@section('head')
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/pages/style.css') }}">
@endsection

@section('content')
    <main>
        {{-- =========================
            Roadmap Hero
            ========================== --}}
        <section class="roadmap-hero">
            <div class="roadmap-hero-container">
                <div class="roadmap-breadcrumb">
                    <a href="{{ route('home.index') }}">
                        الرئيسية
                    </a>

                    <span>/</span>

                    <a href="{{ route('roadmaps.index') }}">
                        المسارات
                    </a>

                    <span>/</span>

                    <span>
                        {{ $roadmap->category->name }}
                    </span>
                </div>

                <div class="roadmap-hero-badge-row">
                    <span class="saas-badge saas-badge-warning">
                        مستوى:
                        {{ match ($roadmap->level) {
                            'beginner' => 'مبتدئ',
                            'intermediate' => 'متوسط',
                            'advanced' => 'متقدم',
                            default => $roadmap->level,
                        } }}
                    </span>

                    <span class="saas-badge saas-badge-primary">
                        {{ $roadmap->category->name }}
                    </span>

                    <span class="saas-badge saas-badge-success">
                        محدث {{ $roadmap->updated_at->format('Y') }}
                    </span>
                </div>

                <h1 class="roadmap-hero-title">
                    {{ $roadmap->title }}
                </h1>

                <p class="roadmap-hero-desc">
                    {{ $roadmap->description }}
                </p>

                <div class="roadmap-hero-stats-row">
                    <div class="roadmap-hero-stat-item">
                        <span>
                            👥
                        </span>

                        <span>
                            المتعلمون:
                            <strong>
                                {{ $roadmap->enrollments->count() }}
                            </strong>
                        </span>
                    </div>

                    <div class="roadmap-hero-stat-item">
                        <span style="color: var(--bright-yellow);">
                            ★
                        </span>

                        <span>
                            التقييم:
                            <strong>
                                {{ number_format($roadmap->reviews->avg('rating') ?? 0, 1) }}
                                / 5.0
                            </strong>
                        </span>
                    </div>

                    <div class="roadmap-hero-stat-item">
                        <span>
                            💬
                        </span>

                        <span>
                            عدد المراجعات:
                            <strong>
                                {{ $roadmap->reviews->count() }}
                            </strong>
                        </span>
                    </div>
                </div>
            </div>
        </section>

        {{-- =========================
            Main Content
            ========================== --}}

        <div class="roadmap-details-layout">
            <div class="learning-path-wrapper">
                <h3>
                    المصادر التعليمية
                </h3>

                <p class="learning-path-subtitle">
                    مجموعة المصادر التعليمية التي اختارها صانع المسار
                    لمساعدتك على تعلم المهارات المطلوبة.
                </p>

                <div class="topic-resources-list">
                    @forelse ($roadmap->resources as $resource)
                        @php
                            $resourceIcons = [
                                'video' => '🎥',
                                'documentation' => '📖',
                                'article' => '📰',
                                'link' => '🔗',
                                'other' => '📚',
                            ];

                            $resourceLabels = [
                                'video' => 'فيديو',
                                'documentation' => 'توثيق رسمي',
                                'article' => 'مقال',
                                'link' => 'رابط',
                                'other' => 'مصدر',
                            ];
                        @endphp

                        <a href="{{ $resource->url }}" target="_blank" rel="noopener noreferrer"
                            class="resource-link-item {{ $resource->type }}">

                            <div class="resource-left">
                                <div class="resource-type-icon">
                                    {{ $resourceIcons[$resource->type] ?? '📚' }}
                                </div>

                                <div>
                                    <div class="resource-title">
                                        {{ $resource->title }}
                                    </div>

                                    @if ($resource->description)
                                        <div class="resource-description">
                                            {{ $resource->description }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="resource-right">
                                <span class="resource-type-badge">
                                    {{ $resourceLabels[$resource->type] ?? 'مصدر' }}
                                </span>

                                <span class="resource-external-icon">
                                    ↗
                                </span>
                            </div>
                        </a>
                    @empty
                        <div class="explore-empty-state">
                            <div class="empty-state-icon">
                                📚
                            </div>

                            <h3>
                                لا توجد مصادر متاحة لهذا المسار حاليًا
                            </h3>

                            <p>
                                سيتم إضافة المصادر التعليمية من قبل صانع المسار.
                            </p>
                        </div>
                    @endforelse
                </div>

                {{-- =========================
                    Reviews
                    ========================== --}}

                <div class="roadmap-reviews-section">
                    <h3>
                        تقييمات وآراء المتعلمين
                    </h3>

                    <div class="reviews-summary-card">
                        <div class="rating-big-number">
                            <h2>
                                {{ number_format($roadmap->reviews->avg('rating') ?? 0, 1) }}
                            </h2>

                            <div style="color: var(--bright-yellow);" class="mb-1">
                                ★★★★★
                            </div>

                            <span class="text-muted small">
                                بناءً على
                                {{ $roadmap->reviews->count() }}
                                مراجعة
                            </span>
                        </div>

                        <div
                            style="
                                flex: 1;
                                display: flex;
                                flex-direction: column;
                                gap: 0.4rem;
                            ">

                            @php
                                $reviewCount = $roadmap->reviews->count();
                                $fiveStars = $roadmap->reviews->where('rating', 5)->count();
                                $fourStars = $roadmap->reviews->where('rating', 4)->count();
                                $threeStars = $roadmap->reviews->where('rating', 3)->count();

                                $fivePercentage = $reviewCount ? round(($fiveStars / $reviewCount) * 100) : 0;
                                $fourPercentage = $reviewCount ? round(($fourStars / $reviewCount) * 100) : 0;
                                $threePercentage = $reviewCount ? round(($threeStars / $reviewCount) * 100) : 0;
                            @endphp

                            <div class="d-flex align-items-center gap-2 small">
                                <span>
                                    5 نجوم
                                </span>

                                <div class="progress flex-grow-1" style="height: 8px;">
                                    <div class="progress-bar bg-warning" style="width: {{ $fivePercentage }}%"></div>
                                </div>

                                <span>
                                    {{ $fivePercentage }}%
                                </span>

                            </div>

                            <div class="d-flex align-items-center gap-2 small">
                                <span>
                                    4 نجوم
                                </span>

                                <div class="progress flex-grow-1" style="height: 8px;">
                                    <div class="progress-bar bg-warning" style="width: {{ $fourPercentage }}%"></div>
                                </div>

                                <span>
                                    {{ $fourPercentage }}%
                                </span>
                            </div>

                            <div class="d-flex align-items-center gap-2 small">
                                <span>
                                    3 نجوم
                                </span>

                                <div class="progress flex-grow-1" style="height: 8px;">
                                    <div class="progress-bar bg-warning" style="width: {{ $threePercentage }}%"></div>
                                </div>

                                <span>
                                    {{ $threePercentage }}%
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="reviews-grid-list">
                        @forelse ($roadmap->reviews as $review)
                            <div class="saas-review-card">
                                <div class="review-card-header">
                                    <div class="reviewer-profile">
                                        <div class="reviewer-info">
                                            <h5>
                                                {{ $review->user->name }}
                                            </h5>

                                            <span class="reviewer-status">
                                                متعلم
                                            </span>
                                        </div>
                                    </div>

                                    <div class="review-stars-wrap">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span
                                                style="
                                                    color:
                                                    {{ $i <= $review->rating ? 'var(--bright-yellow)' : '#cbd5e1' }};
                                                ">
                                                ★
                                            </span>
                                        @endfor
                                    </div>
                                </div>

                                <p class="review-comment">
                                    "{{ $review->comment }}"
                                </p>

                                <div class="review-card-footer">
                                    <span class="review-date">
                                        {{ $review->created_at->diffForHumans() }}
                                    </span>

                                    <span class="text-muted">
                                        مراجعة
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="explore-empty-state">
                                <div class="empty-state-icon">
                                    💬
                                </div>

                                <h3>
                                    لا توجد مراجعات لهذا المسار بعد
                                </h3>

                                <p>
                                    كن أول من يشارك تجربته مع هذا المسار.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- =========================
    Sidebar
    ========================== --}}

            @php
                $showLearnerSidebar = auth()->guest() || auth()->user()->role === 'learner';
            @endphp

            @if ($showLearnerSidebar)
                <div class="roadmap-sidebar">

                    <div class="sidebar-action-card">
                        <div class="sidebar-price-tag">
                            مجاني 100%
                        </div>

                        <div class="sidebar-action-btns">

                            @guest
                                {{-- Guest: Login before enrolling --}}
                                <a href="{{ route('login') }}" class="saas-btn saas-btn-primary w-100 py-3">
                                    🚀 ابدأ متابعة المسار الآن
                                </a>

                                {{-- Guest: Login before saving --}}
                                <a href="{{ route('login') }}" class="saas-btn saas-btn-secondary w-100">
                                    ☆ حفظ في المفضلة
                                </a>
                            @endguest

                            @auth
                                @if (auth()->user()->role === 'learner')
                                    @php
                                        $isEnrolled = auth()
                                            ->user()
                                            ->roadmapEnrollments()
                                            ->where('roadmap_id', $roadmap->id)
                                            ->exists();

                                        $isSaved = auth()
                                            ->user()
                                            ->savedRoadmaps()
                                            ->where('roadmap_id', $roadmap->id)
                                            ->exists();
                                    @endphp

                                    {{-- Enrollment --}}
                                    @if ($isEnrolled)
                                        <a href="{{ route('learner.learning.show', $roadmap) }}"
                                            class="saas-btn saas-btn-primary w-100 py-3">
                                            ▶ متابعة المسار
                                        </a>
                                    @else
                                        <form method="POST" action="{{ route('learner.learning.enroll', $roadmap) }}">
                                            @csrf

                                            <button type="submit" class="saas-btn saas-btn-primary w-100 py-3">
                                                🚀 ابدأ متابعة المسار الآن
                                            </button>
                                        </form>
                                    @endif

                                    {{-- Saved Roadmap --}}
                                    @if ($isSaved)
                                        <form method="POST" action="{{ route('learner.roadmaps.unsave', $roadmap) }}">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="saas-btn saas-btn-secondary w-100">
                                                ⭐ إزالة من المفضلة
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('learner.roadmaps.save', $roadmap) }}">
                                            @csrf

                                            <button type="submit" class="saas-btn saas-btn-secondary w-100">
                                                ☆ حفظ في المفضلة
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            @endauth

                        </div>

                        <ul class="sidebar-features-list">
                            <li>
                                <span>✓</span>
                                الوصول إلى جميع المصادر المتاحة للمسار
                            </li>

                            <li>
                                <span>✓</span>
                                مصادر تعليمية مختارة ومنظمة
                            </li>

                            <li>
                                <span>✓</span>
                                مراجعات وتقييمات من المتعلمين
                            </li>

                            <li>
                                <span>✓</span>
                                إمكانية متابعة المسار بعد تسجيل الدخول
                            </li>
                        </ul>
                    </div>

                    {{-- Creator Information --}}
                    <div class="sidebar-creator-card">
                        <h4>
                            مُعد المسار
                        </h4>

                        <div class="sidebar-creator-flex">
                            <div class="sidebar-creator-avatar">
                                {{ strtoupper(substr($roadmap->creator->name, 0, 1)) }}
                            </div>

                            <div class="sidebar-creator-details">
                                <h5>
                                    {{ $roadmap->creator->name }}
                                </h5>

                                <p>
                                    Creator
                                </p>
                            </div>
                        </div>

                        <p class="text-muted small mb-0">
                            صانع المسار المسؤول عن إعداد وتنظيم المحتوى
                            والمصادر التعليمية الموجودة داخله.
                        </p>
                    </div>

                </div>
            @endif
        </div>
    </main>
@endsection

@section('footer')
    @include('components.footers.home-footer')
@endsection
