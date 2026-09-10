@extends('layouts.guest')

@section('lang', 'ar')
@section('dir', 'rtl')

@section('title', 'Categories')

@section('head')
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/pages/style.css') }}">
@endsection

@section('content')
    {{-- @var object $categories --}}
    {{-- @var object $category --}}
    @php
        // UI-only icons.
        // Category data itself comes from the database via CategoryController.
        $categoryIcons = [
            'web' => '🌐',
            'ai' => '🧠',
            'mobile' => '📱',
            'devops' => '☁️',
            'cybersecurity' => '🛡️',
            'data' => '📊',
            'ui-ux' => '🎨',
            'product' => '🚀',
        ];
    @endphp

    <main>
        <section class="categories-hero">
            <div class="container">
                <h1>
                    استكشف مجالات وتصنيفات التعلم
                </h1>

                <p>
                    اختر التخصص الذي ترغب في استكشافه وتعرف على كافة
                    المسارات المتاحة فيه لنيل المعرفة التقنية المنظمة.
                </p>
            </div>
        </section>

        <div class="categories-content-container">
            <div class="categories-grid">
                @foreach ($categories as $category)
                    <div class="category-card">
                        <div class="category-card-icon">
                            {{ $categoryIcons[$category->slug] ?? '📚' }}
                        </div>
                        
                        <h3 class="category-card-title">
                            {{ $category->name }}
                        </h3>

                        <p class="category-card-desc">
                            {{ $category->description }}
                        </p>

                        <div class="category-card-footer">
                            <a href="{{ route('roadmaps.index', ['category' => $category->slug]) }}">
                                استكشف المسارات ←
                            </a>

                            <span class="category-roadmaps-count">
                                {{ $category->roadmaps_count }} مسار
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection

@section('footer')
    @include('components.footers.home-footer')
@endsection
