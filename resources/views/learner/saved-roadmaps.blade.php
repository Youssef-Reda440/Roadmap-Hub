@extends('layouts.app')

@section('lang', 'ar')
@section('dir', 'rtl')

@section('title', 'Saved Roadmaps')

@section('head')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&family=Rubik:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/learner/saved-roadmaps.css') }}">
    <link rel="stylesheet" href="{{ asset('css/learner/learner-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/style.css') }}">
@endsection

@section('navigation')
    @include('components.navbars.learner-navbar')
@endsection

@section('content')
    {{-- @var Roadmaps $savedRoadmaps --}}
    <main class="saved-page">

        {{-- Header --}}
        <section class="page-header">

            <div>

                <p class="page-label">
                    مجموعتك
                </p>

                <h1>
                    المسارات المحفوظة
                </h1>

                <p>
                    احتفظ بالمسارات المفضلة لديك وارجع إليها في أي وقت.
                </p>

            </div>

            <div class="saved-count">

                <strong>
                    {{ $savedRoadmaps->count() }}
                </strong>

                <span>
                    {{ $savedRoadmaps->count() === 1 ? 'مسار محفوظ' : 'مسارات محفوظة' }}
                </span>

            </div>

        </section>


        {{-- Saved Roadmaps --}}
        <section class="roadmap-grid">

            @forelse ($savedRoadmaps as $saved)
                @php
                    $roadmap = $saved->roadmap;
                @endphp

                <article class="roadmap-card">

                    {{-- Card Image / Category --}}
                    <div class="card-image">

                        <span>
                            {{ $roadmap->category->name }}
                        </span>

                        {{-- Remove from saved --}}
                        <form action="{{ route('learner.roadmaps.unsave', $roadmap) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="save-btn" aria-label="إزالة المسار من المحفوظات"
                                title="إزالة من المحفوظات">
                                ♥
                            </button>
                        </form>

                    </div>


                    {{-- Card Body --}}
                    <div class="card-body">

                        {{-- Creator --}}
                        <div class="creator">

                            <div class="creator-avatar">
                                {{ strtoupper(substr($roadmap->creator->name, 0, 1)) }}
                            </div>

                            <span>
                                بواسطة {{ $roadmap->creator->name }}
                            </span>

                        </div>


                        {{-- Title --}}
                        <h2>
                            {{ $roadmap->title }}
                        </h2>


                        {{-- Description --}}
                        <p>
                            {{ $roadmap->description }}
                        </p>


                        {{-- Meta --}}
                        <div class="card-meta">

                            <span>
                                {{ $roadmap->resources->count() }} موارد
                            </span>

                            <span>•</span>

                            <span>
                                @switch($roadmap->level)
                                    @case('beginner')
                                        مبتدئ
                                    @break

                                    @case('intermediate')
                                        متوسط
                                    @break

                                    @case('advanced')
                                        متقدم
                                    @break

                                    @default
                                        {{ $roadmap->level }}
                                @endswitch
                            </span>

                        </div>


                        {{-- Footer --}}
                        <div class="card-footer">

                            <span class="saved-status">
                                ♥ محفوظ
                            </span>

                            <a href="{{ route('roadmaps.show', $roadmap) }}" class="view-btn">
                                عرض المسار ←
                            </a>

                        </div>

                    </div>

                </article>

                @empty

                    <div class="empty-state">

                        <div class="empty-icon">
                            ♥
                        </div>

                        <h2>
                            لا توجد مسارات محفوظة
                        </h2>

                        <p>
                            احفظ المسارات التي تهمك لتتمكن من الرجوع إليها لاحقًا.
                        </p>

                        <a href="{{ route('roadmaps.index') }}" class="browse-btn">
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
