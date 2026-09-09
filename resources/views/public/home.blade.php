@extends('layouts.guest')

@section('lang', 'ar')
@section('dir', 'rtl')

@section('title', 'Roadmap Hub')

@section('head')
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
    {{-- @var object $featuredRoadmaps --}}
    @php
        $roadmapIcons = [
            'web' => '⚛️',
            'ai' => '🧠',
            'mobile' => '📱',
            'devops' => '☁️',
            'cybersecurity' => '🛡️',
            'data' => '📊',
            'ui-ux' => '🎨',
            'product' => '🚀',
        ];

        $levelLabels = [
            'beginner' => 'مبتدئ',
            'intermediate' => 'متوسط',
            'advanced' => 'متقدم',
        ];
    @endphp

    <main>
        {{--=========================
            Hero Section
            ==========================--}}
        <section class="saas-hero-section">
            <div class="saas-hero-container">
                <div class="hero-pill-badge">
                    <span class="spark">✨</span>
                    <span>الجيل الجديد من منصات التعلم الذاتي المنظم</span>
                </div>

                <h1 class="saas-hero-title">
                    تعلم أي مجال تقني
                    <br>

                    <span class="highlight-blue">
                        بطريقتك وخطوتك الخاصة
                    </span>
                </h1>

                <p class="saas-hero-subtitle">
                    اكتشف مسارات تعليمية وتدريبية محكمة صممها خبراء ومحترفون،
                    لتقودك خطوة بخطوة من الصفر حتى سوق العمل دون تشتت وبأعلى كفاءة.
                </p>

                <form action="{{ route('roadmaps.index') }}" method="GET" class="hero-search-wrapper">
                    <div class="hero-search-icon">
                        🔍
                    </div>

                    <input type="text" name="search" class="hero-search-input"
                        placeholder="ابحث عن مسار... (مثال: Full-Stack, AI, Flutter, DevOps)" required>

                    <button type="submit" class="hero-search-btn">
                        استكشف المسار
                    </button>
                </form>

                <div class="hero-quick-tags">
                    <span>
                        مسارات رائجة:
                    </span>

                    <a href="{{ route('roadmaps.index', ['search' => 'Frontend']) }}" class="hero-tag-link">
                        Frontend React
                    </a>

                    <a href="{{ route('roadmaps.index', ['search' => 'Backend']) }}" class="hero-tag-link">
                        Backend Laravel
                    </a>

                    <a href="{{ route('roadmaps.index', ['search' => 'AI']) }}" class="hero-tag-link">
                        Machine Learning
                    </a>

                    <a href="{{ route('roadmaps.index', ['search' => 'Cybersecurity']) }}" class="hero-tag-link">
                        الأمن السيبراني
                    </a>

                    <a href="{{ route('roadmaps.index', ['search' => 'Flutter']) }}" class="hero-tag-link">
                        تطبيقات الموبايل
                    </a>
                </div>
            </div>
        </section>

        {{--=========================
            Featured Roadmaps
            ==========================--}}

        <section class="featured-roadmaps-section">
            <div class="saas-section-header">
                <span class="section-tag">
                    مسارات موصى بها
                </span>

                <h2>
                    أحدث وأشهر المسارات التقنية
                </h2>

                <p>
                    اختر من بين مجموعة منتقاة من المسارات الأكثر طلباً
                    في سوق العمل اليوم وابدأ التعلم مباشرة.
                </p>
            </div>

            <div class="roadmaps-grid-wrapper">
                @forelse ($featuredRoadmaps as $roadmap)
                    <div class="roadmap-card">
                        <div class="roadmap-card-banner">
                            <span class="roadmap-card-badge-level">
                                {{ $levelLabels[$roadmap->level] ?? $roadmap->level }}
                            </span>

                            <span class="roadmap-card-category">
                                {{ $roadmap->category->name }}
                            </span>

                            <div class="roadmap-card-icon">
                                {{ $roadmapIcons[$roadmap->category->slug] ?? '📚' }}
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
                                        {{ $roadmap->enrollments_count }} متعلم
                                    </span>
                                </div>

                                <div class="roadmap-meta-item roadmap-rating">
                                    <span class="roadmap-star-icon">
                                        ★
                                    </span>

                                    <span>
                                        {{ number_format($roadmap->reviews_avg_rating ?? 0, 1) }}
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
                @empty
                    <div class="explore-empty-state">
                        <div class="empty-state-icon">
                            📚
                        </div>

                        <h3>
                            لا توجد مسارات منشورة حاليًا
                        </h3>

                        <p>
                            سيتم عرض المسارات هنا بمجرد نشرها واعتمادها.
                        </p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('roadmaps.index') }}" class="saas-btn saas-btn-secondary">
                    <span>
                        تصفح كافة المسارات
                    </span>

                    <span>
                        ←
                    </span>
                </a>
            </div>
        </section>

        {{--=========================
            How It Works
            ==========================--}}

        <section class="how-it-works-section" id="how-it-works">
            <div class="how-it-works-container">
                <div class="saas-section-header">
                    <span class="section-tag">
                        منهجية التعلم
                    </span>

                    <h2>
                        كيف تقودك المنصة نحو الاحتراف؟
                    </h2>

                    <p>
                        بنيت منصة Roadmap Hub لتزيل التشتت
                        وتمنحك خطة تعلم واضحة ومحددة المعالم.
                    </p>
                </div>

                <div class="steps-grid">
                    <div class="step-card">
                        <div class="step-number">
                            1
                        </div>

                        <div class="step-icon">
                            🎯
                        </div>

                        <h3 class="step-title">
                            اختر تخصصك المناسب
                        </h3>

                        <p class="step-desc">
                            تصفح المسارات المتنوعة حسب مستواك واهتمامك
                            مع استعراض كامل لمحتوى المسار قبل البدء.
                        </p>
                    </div>

                    <div class="step-card">
                        <div class="step-number">
                            2
                        </div>

                        <div class="step-icon">
                            🗺️
                        </div>

                        <h3 class="step-title">
                            اتبع المسار المنظم
                        </h3>

                        <p class="step-desc">
                            اختر مسارًا واضحًا ومترابطًا يساعدك
                            على التعلم بشكل منظم وتقليل التشتت.
                        </p>
                    </div>

                    <div class="step-card">
                        <div class="step-number">
                            3
                        </div>

                        <div class="step-icon">
                            📚
                        </div>

                        <h3 class="step-title">
                            استخدم مصادر مختارة
                        </h3>

                        <p class="step-desc">
                            اكتشف مجموعة من المصادر التعليمية المختارة
                            مثل الفيديوهات والمقالات والتوثيقات والروابط المفيدة.
                        </p>
                    </div>

                    <div class="step-card">
                        <div class="step-number">
                            4
                        </div>

                        <div class="step-icon">
                            🏆
                        </div>

                        <h3 class="step-title">
                            تابع رحلتك التعليمية
                        </h3>

                        <p class="step-desc">
                            ابدأ مسارك، تابع تقدمك وقيّم تجربتك
                            واستفد من المسارات المناسبة لأهدافك.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{--=========================
            Quote
            ==========================--}}
        <div class="saas-quote-section">
            <div class="saas-quote-mark">
                "
            </div>

            <p class="saas-quote-body">
                التعلم الحقيقي والمستدام لا يبدأ في القاعات التقليدية،
                بل ينطلق في اللحظة التي تقرر فيها امتلاك زمام نموك المهني والتقني بنفسك.
            </p>

            <div class="saas-quote-author">
                — فلسفة ورؤية Roadmap Hub للتعلم الذاتي
            </div>
        </div>

        {{--=========================
            Final CTA
            ==========================--}}
        <section class="saas-final-cta">
            <div class="saas-final-cta-container">
                <h2>
                    جاهز للانطلاق في مسارك القادم؟
                </h2>

                <p>
                    انضم إلى مجتمع Roadmap Hub واكتشف خارطة الطريق
                    المناسبة لتحقيق أهدافك المهنية خطوة بخطوة.
                </p>

                <div class="saas-final-cta-actions">

                    <a href="{{ route('roadmaps.index') }}" class="saas-btn saas-btn-yellow">
                        <span>
                            تصفح جميع المسارات الآن
                        </span>

                        <span>
                            ←
                        </span>
                    </a>

                    <a href="{{ route('register') }}" class="saas-btn saas-btn-secondary"
                        style="background: transparent; color: #ffffff; border-color: rgba(255,255,255,0.4);">
                        إنشاء حساب جديد مجاناً
                    </a>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('footer')
    @include('components.footers.home-footer')
@endsection
