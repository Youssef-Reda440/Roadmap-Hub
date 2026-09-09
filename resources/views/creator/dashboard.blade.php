@extends('layouts.app')

@section('title', 'Creator Dashboard')

@section('head')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/creator/style.css') }}">
@endsection

@section('navigation')
    @include('components.navbars.creator-navbar')
@endsection

@section('content')
    {{-- @var \Illuminate\Database\Eloquent\Collection<int, \App\Models\Review> $recentReviews --}}
    {{-- @var \App\Models\User $creator --}}
    {{-- @var array<string, mixed> $stats --}}
    {{-- @var \Illuminate\Database\Eloquent\Collection<int, \App\Models\Roadmap> $recentRoadmaps --}}

    <!-- Main Content -->
    <div class="container py-4 py-lg-5">
        <!-- Dashboard -->
        <div class="view-section fade-in">

            <!-- Page Header -->
            <div class="page-header">
                <div class="creator-profile mb-4">

                    <div class="creator-avatar">
                        {{ strtoupper(substr($creator->name, 0, 1)) }}
                    </div>

                    <div>
                        <h1 class="page-title mb-1">
                            Welcome back, {{ $creator->name }}!
                        </h1>

                        <p class="page-subtitle mb-0">
                            Here's what's happening with your roadmaps.
                        </p>
                    </div>

                </div>
            </div>


            <!-- Stats Row -->
            <div class="row g-4 mb-5">

                <!-- Total Roadmaps -->
                <div class="col-6 col-lg-3">
                    <div class="stat-card">

                        <div class="stat-icon" style="background: #e0e7ff; color: #4f46e5;">
                            <i class="bi bi-kanban"></i>
                        </div>

                        <div class="stat-value">
                            {{ $stats['total_roadmaps'] }}
                        </div>

                        <div class="stat-label">
                            Total Roadmaps
                        </div>

                    </div>
                </div>


                <!-- Total Reviews -->
                <div class="col-6 col-lg-3">
                    <div class="stat-card">

                        <div class="stat-icon" style="background: #dbeafe; color: #2563eb;">
                            <i class="bi bi-star-fill"></i>
                        </div>

                        <div class="stat-value">
                            {{ $stats['total_reviews'] }}
                        </div>

                        <div class="stat-label">
                            Total Reviews
                        </div>

                    </div>
                </div>


                <!-- Average Rating -->
                <div class="col-6 col-lg-3">
                    <div class="stat-card">

                        <div class="stat-icon" style="background: #d1fae5; color: #059669;">
                            <i class="bi bi-heart-fill"></i>
                        </div>

                        <div class="stat-value">
                            {{ number_format($stats['average_rating'], 1) }}
                        </div>

                        <div class="stat-label">
                            Avg. Rating
                        </div>

                    </div>
                </div>


                <!-- Total Learners -->
                <div class="col-6 col-lg-3">
                    <div class="stat-card">

                        <div class="stat-icon" style="background: #fef3c7; color: #d97706;">
                            <i class="bi bi-people-fill"></i>
                        </div>

                        <div class="stat-value">
                            {{ $stats['total_learners'] }}
                        </div>

                        <div class="stat-label">
                            Total Learners
                        </div>

                    </div>
                </div>

            </div>


            <!-- Recent Content -->
            <div class="row g-4">

                <!-- Recent Roadmaps -->
                <div class="col-lg-8">

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <h2 class="h4 fw-bold mb-0">
                            Recent Roadmaps
                        </h2>

                        <a href="{{ route('creator.roadmaps.index') }}" class="btn btn-outline-custom btn-sm">
                            View All
                            <i class="bi bi-arrow-right ms-1"></i>
                        </a>

                    </div>


                    @if ($recentRoadmaps->isNotEmpty())

                        <div class="row g-4">

                            @foreach ($recentRoadmaps as $roadmap)
                                <div class="col-md-6">

                                    <div class="roadmap-card">

                                        <!-- Roadmap Header -->
                                        <div class="roadmap-card-header">

                                            <div>
                                                <h3 class="roadmap-card-title">
                                                    {{ $roadmap->title }}
                                                </h3>

                                                <span class="roadmap-card-category">
                                                    {{ $roadmap->category->name }}
                                                </span>
                                            </div>

                                            <span class="roadmap-status roadmap-status-{{ $roadmap->status }}">
                                                {{ str_replace('_', ' ', $roadmap->status) }}
                                            </span>

                                        </div>


                                        <!-- Description -->
                                        <div class="roadmap-card-body">

                                            <p class="roadmap-card-description">
                                                {{ Str::limit($roadmap->description, 100) }}
                                            </p>


                                            <!-- Meta -->
                                            <div class="roadmap-card-meta">

                                                <span>
                                                    <i class="bi bi-collection"></i>
                                                    {{ $roadmap->resources_count }}
                                                    {{ Str::plural('resource', $roadmap->resources_count) }}
                                                </span>

                                                <span>
                                                    <i class="bi bi-people"></i>
                                                    {{ $roadmap->enrollments_count }}
                                                </span>

                                                <span class="roadmap-rating">
                                                    <i class="bi bi-star-fill"></i>

                                                    {{ $roadmap->reviews_avg_rating ? number_format($roadmap->reviews_avg_rating, 1) : 'No rating' }}
                                                </span>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            @endforeach

                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="bi bi-kanban"></i>
                            </div>

                            <h3>No Roadmaps Yet</h3>

                            <p>
                                Create your first roadmap and start sharing your knowledge.
                            </p>

                            <a href="{{ route('creator.roadmaps.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-1"></i>
                                Create Roadmap
                            </a>
                        </div>

                    @endif

                </div>


                <!-- Recent Reviews -->
                <div class="col-lg-4">

                    <h2 class="h4 fw-bold mb-4">
                        Recent Reviews
                    </h2>


                    @if ($recentReviews->isNotEmpty())

                        <div class="dashboard-reviews">

                            @foreach ($recentReviews as $review)
                                <div class="review-card">

                                    <!-- Review Header -->
                                    <div class="review-card-header">

                                        <div class="review-user">

                                            <div class="review-avatar">
                                                {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                            </div>

                                            <div>
                                                <div class="review-user-name">
                                                    {{ $review->user->name }}
                                                </div>

                                                <div class="review-roadmap">
                                                    {{ $review->roadmap->title }}
                                                </div>
                                            </div>

                                        </div>

                                        <span class="review-date">
                                            {{ $review->created_at->diffForHumans() }}
                                        </span>

                                    </div>


                                    <!-- Rating -->
                                    <div class="review-rating">

                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="bi {{ $i <= $review->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                        @endfor

                                    </div>


                                    <!-- Comment -->
                                    <p class="review-comment mb-0">
                                        "{{ Str::limit($review->comment, 150) }}"
                                    </p>

                                </div>
                            @endforeach

                        </div>
                    @else
                        <div class="empty-state empty-state-small">

                            <div class="empty-state-icon">
                                <i class="bi bi-star"></i>
                            </div>

                            <h3>No Reviews Yet</h3>

                            <p>
                                Reviews from learners will appear here.
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>
    </div>
@endsection

@section('footer')
    @include('components.footers.footer')
@endsection
