@extends('layouts.guest')

@section('lang', 'ar')
@section('dir', 'rtl')

@section('title', 'Explore')

@section('head')
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
    {{-- @var object $categories --}}
    {{-- @var object $roadmaps --}}
    {{-- @var object $roadmap --}}
    <main>
        <section class="explore-page-header">
            <div class="container">
                <h1>
                    استكشف مسارات التعلم
                </h1>

                <p>
                    تصفح مجموعة متنوعة من المسارات التعليمية والتدريبية
                    المصممة لتقودك نحو احتراف تخصصك البرمجي والتقني.
                </p>
            </div>
        </section>

        <div class="explore-container">
            <form method="GET" action="{{ route('roadmaps.index') }}" class="explore-filter-bar" id="exploreFilterForm">
                <div class="filter-top-row">
                    <div class="explore-search-box">
                        <span class="explore-search-icon">
                            🔍
                        </span>

                        <input type="text" name="search" value="{{ request('search', '') }}"
                            class="explore-search-input" placeholder="ابحث بالاسم أو التقنية (React, Python, Laravel...)">
                    </div>

                    <select name="category" class="filter-select"
                        onchange="document.getElementById('exploreFilterForm').submit()">

                        <option value="">
                            جميع التصنيفات
                        </option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    <select name="level" class="filter-select"
                        onchange="document.getElementById('exploreFilterForm').submit()">

                        <option value="">
                            جميع المستويات
                        </option>

                        <option value="beginner" @selected(request('level') === 'beginner')>
                            مبتدئ (Beginner)
                        </option>

                        <option value="intermediate" @selected(request('level') === 'intermediate')>
                            متوسط (Intermediate)
                        </option>

                        <option value="advanced" @selected(request('level') === 'advanced')>
                            متقدم (Advanced)
                        </option>
                    </select>
                </div>

                {{--=========================
                    Quick Category Filters
                    ==========================--}}
                <div class="filter-categories-pills">
                    <span class="text-muted small fw-bold ms-2">
                        تصنيفات سريعة:
                    </span>

                    <a href="{{ route('roadmaps.index') }}"
                        class="category-pill-btn {{ !request('category') ? 'active' : '' }}">
                        الكل
                    </a>

                    <a href="{{ route('roadmaps.index', ['category' => 'web']) }}"
                        class="category-pill-btn {{ request('category') === 'web' ? 'active' : '' }}">
                        تطوير الويب
                    </a>

                    <a href="{{ route('roadmaps.index', ['category' => 'ai']) }}"
                        class="category-pill-btn {{ request('category') === 'ai' ? 'active' : '' }}">
                        الذكاء الاصطناعي
                    </a>

                    <a href="{{ route('roadmaps.index', ['category' => 'mobile']) }}"
                        class="category-pill-btn {{ request('category') === 'mobile' ? 'active' : '' }}">
                        الموبايل
                    </a>

                    <a href="{{ route('roadmaps.index', ['category' => 'devops']) }}"
                        class="category-pill-btn {{ request('category') === 'devops' ? 'active' : '' }}">
                        DevOps والشبكات
                    </a>

                    <a href="{{ route('roadmaps.index', ['category' => 'cybersecurity']) }}"
                        class="category-pill-btn {{ request('category') === 'cybersecurity' ? 'active' : '' }}">
                        الأمن السيبراني
                    </a>
                </div>
            </form>

            {{--=========================
                Results Header
                ==========================--}}

            <div class="explore-results-header">
                <div class="results-count">
                    عرض
                    <span>{{ $roadmaps->count() }}</span>
                    مسار تعليمي

                    @if (request('search'))
                        عن بحث:
                        <em>
                            "{{ request('search') }}"
                        </em>
                    @endif
                </div>

                @if (request('search') || request('category') || request('level'))
                    <a href="{{ route('roadmaps.index') }}" class="text-danger small fw-bold">
                        ✕ إعادة ضبط الفلاتر
                    </a>
                @endif
            </div>

            {{--=========================
                Roadmaps
                ==========================--}}
                
            <div class="explore-grid">
                @if ($roadmaps->isNotEmpty())
                    @foreach ($roadmaps as $roadmap)
                        <div class="roadmap-card">
                            <div class="roadmap-card-banner">
                                <span class="roadmap-card-badge-level">
                                    {{ match ($roadmap->level) {
                                        'beginner' => 'مبتدئ',
                                        'intermediate' => 'متوسط',
                                        'advanced' => 'متقدم',
                                        default => $roadmap->level,
                                    } }}
                                </span>

                                <span class="roadmap-card-category">
                                    {{ $roadmap->category->name }}
                                </span>

                                <div class="roadmap-card-icon">
                                    📚
                                </div>
                            </div>

                            <div class="roadmap-card-body">
                                <a href="{{ route('roadmaps.show', $roadmap) }}">
                                    <h3 class="roadmap-card-title">
                                        {{ $roadmap->title }}
                                    </h3>
                                </a>

                                <p class="roadmap-card-description">
                                    {{ $roadmap->description }}
                                </p>

                                <div class="roadmap-card-meta">
                                    <div class="roadmap-meta-item">
                                        <span>
                                            👥
                                        </span>

                                        <span>
                                            {{ $roadmap->enrollments_count ?? 0 }}
                                            متعلم
                                        </span>
                                    </div>

                                    <div class="roadmap-meta-item roadmap-rating">
                                        <span class="roadmap-star-icon">
                                            ★
                                        </span>

                                        <span>
                                            {{ number_format($roadmap->reviews->avg('rating') ?? 0, 1) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="roadmap-card-footer">
                                    <div class="roadmap-card-creator">
                                        <span class="roadmap-creator-name">
                                            {{ $roadmap->creator->name }}
                                        </span>
                                    </div>

                                    <a href="{{ route('roadmaps.show', $roadmap) }}" class="roadmap-card-btn">
                                        <span>
                                            عرض المسار
                                        </span>

                                        <span>
                                            ←
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="explore-empty-state">
                        <div class="empty-state-icon">
                            🔍
                        </div>

                        <h3>
                            لم نتمكن من العثور على مسارات تطابق بحثك
                        </h3>

                        <p>
                            جرب استخدام كلمات بحث مختلفة أو قم بإزالة بعض
                            الفلاتر المحددة لعرض كافة المسارات.
                        </p>

                        <a href="{{ route('roadmaps.index') }}" class="saas-btn saas-btn-primary">
                            عرض جميع المسارات
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection

@section('footer')
    @include('components.footers.home-footer')
@endsection
