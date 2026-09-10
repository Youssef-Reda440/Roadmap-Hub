@extends('admin.layouts.master')

@section('title', 'Dashboard | Roadmap Hub')

@section('admin-content')
    <nav class="admin-breadcrumb mb-3 small text-secondary" aria-label="Breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>

    <section class="admin-page-heading d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
        <div class="studio-welcome d-flex align-items-center gap-3">
            <span class="admin-avatar studio-avatar rounded-circle bg-primary text-white d-inline-grid place-items-center px-3 py-2 fs-4">
                {{ mb_strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
            </span>
            <div>
                <h1 class="h2 mb-1">Welcome back, {{ auth()->user()->name }}!</h1>
                <p class="text-secondary mb-0">Track Roadmap Hub performance and manage the latest tasks and reviews in one place.</p>
            </div>
        </div>

        <a class="btn admin-btn-primary btn-primary" href="{{ url('/admin/roadmap-reviews') }}">
            <i class="bi bi-collection me-1" aria-hidden="true"></i>
            Roadmap reviews
        </a>
    </section>

    <section class="admin-dashboard-metrics row g-4 mb-5" aria-label="Platform statistics">
        <div class="col-12 col-sm-6 col-xl-3">
            <article class="admin-stat-card card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <span class="admin-stat-card__icon text-primary"><i class="bi bi-people" aria-hidden="true"></i></span>
                    <p class="admin-stat-card__value mb-0">{{ number_format($totalUsers) }}</p>
                    <span class="admin-stat-card__label text-secondary">Total users</span>
                    <span class="admin-stat-card__meta admin-stat-card__meta--placeholder" aria-hidden="true"></span>
                </div>
            </article>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <article class="admin-stat-card card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <span class="admin-stat-card__icon text-primary"><i class="bi bi-person-video3" aria-hidden="true"></i></span>
                    <p class="admin-stat-card__value mb-0">{{ number_format($totalCreators) }}</p>
                    <span class="admin-stat-card__label text-secondary">Active creators</span>
                    <span class="admin-stat-card__meta admin-stat-card__meta--placeholder" aria-hidden="true"></span>
                </div>
            </article>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <article class="admin-stat-card card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <span class="admin-stat-card__icon text-primary"><i class="bi bi-map" aria-hidden="true"></i></span>
                    <p class="admin-stat-card__value mb-0">{{ number_format($totalRoadmaps) }}</p>
                    <span class="admin-stat-card__label text-secondary">Total roadmaps</span>
                    <span class="admin-stat-card__meta admin-stat-card__meta--placeholder" aria-hidden="true"></span>
                </div>
            </article>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <article class="admin-stat-card card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <span class="admin-stat-card__icon text-danger"><i class="bi bi-flag" aria-hidden="true"></i></span>
                    <p class="admin-stat-card__value mb-0">{{ number_format($pendingReports) }}</p>
                    <span class="admin-stat-card__label text-secondary">Pending reports</span>
                    <div class="admin-stat-card__meta">
                        <span class="admin-status-badge badge bg-warning text-dark">Needs review</span>
                        <small class="text-secondary">Average rating: {{ number_format((float) $averageRating, 1) }} / 5</small>
                    </div>
                </div>
            </article>
        </div>
    </section>

    <section class="row g-4">
        <div class="col-12 col-xl-7">
            <article class="admin-panel admin-dashboard-activity card border-0 shadow-sm">
                <div class="card-body">
                    <div class="admin-panel__header d-flex align-items-center justify-content-between mb-3">
                        <h2 class="admin-panel__title h4 mb-0">Recent activity</h2>
                        <a class="admin-panel__link small" href="{{ url('/admin/reports') }}">View reports</a>
                    </div>

                    <section class="admin-empty-state admin-dashboard-empty-state border rounded-3 bg-light text-center">
                        <i class="bi bi-activity fs-3 text-secondary" aria-hidden="true"></i>
                        <h3 class="h5 mt-2 mb-1">No recent activity available</h3>
                        <p class="text-secondary mb-0">The dashboard currently provides platform metrics only.</p>
                    </section>
                </div>
            </article>
        </div>

        <div class="col-12 col-xl-5">
            <article class="admin-panel card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="admin-panel__header mb-3">
                        <h2 class="admin-panel__title h4 mb-0">Needs your attention</h2>
                    </div>

                    <div class="admin-dashboard-attention d-grid gap-3">
                        <a class="admin-action-card btn btn-outline-primary text-start d-flex align-items-center justify-content-between"
                            href="{{ url('/admin/creator-applications?status=pending') }}">
                            <span>
                                <strong class="d-block">Creator applications</strong>
                                <small>{{ number_format($pendingCreatorApplications) }} applications awaiting review</small>
                            </span>
                            <i class="admin-action-card__arrow bi bi-arrow-right" aria-hidden="true"></i>
                        </a>

                        <a class="admin-action-card btn btn-outline-primary text-start d-flex align-items-center justify-content-between"
                            href="{{ url('/admin/roadmap-reviews?status=pending_review') }}">
                            <span>
                                <strong class="d-block">Roadmap reviews</strong>
                                <small>{{ number_format($pendingRoadmaps) }} roadmaps awaiting a decision</small>
                            </span>
                            <i class="admin-action-card__arrow bi bi-arrow-right" aria-hidden="true"></i>
                        </a>

                        <a class="admin-action-card btn btn-outline-primary text-start d-flex align-items-center justify-content-between"
                            href="{{ url('/admin/reports?status=pending') }}">
                            <span>
                                <strong class="d-block">New reports</strong>
                                <small>{{ number_format($pendingReports) }} reports need follow-up</small>
                            </span>
                            <i class="admin-action-card__arrow bi bi-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </article>
        </div>
    </section>
@endsection
