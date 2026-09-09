@extends('layouts.app')

@section('title', 'My Roadmaps')

@section('head')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/creator/style.css') }}">
@endsection

@section('navigation')
    @include('components.navbars.creator-navbar')
@endsection

@section('content')
    {{-- @var \Illuminate\Database\Eloquent\Collection<int, \App\Models\Roadmap> $roadmaps --}}

    <div class="container py-4 py-lg-5">

        {{-- Page Header --}}
        <div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

            <div>
                <h1 class="page-title">My Roadmaps</h1>
                <p class="page-subtitle mb-0">
                    Manage and organize your learning roadmaps.
                </p>
            </div>

            <a href="{{ route('creator.roadmaps.create') }}" class="btn btn-primary-custom">
                <i class="bi bi-plus-lg me-2"></i>
                Create Roadmap
            </a>

        </div>


        {{-- Roadmaps Table --}}
        <div class="card border-0 shadow-sm">

            <div class="card-body p-0">

                @if ($roadmaps->isNotEmpty())

                    <div class="table-responsive">

                        <table class="table table-custom mb-0">

                            <thead>
                                <tr>
                                    <th>Roadmap</th>
                                    <th class="d-none d-md-table-cell">
                                        Status
                                    </th>
                                    <th class="d-none d-lg-table-cell">
                                        Resources
                                    </th>
                                    <th class="d-none d-lg-table-cell">
                                        Created
                                    </th>
                                    <th class="text-end">
                                        Actions
                                    </th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($roadmaps as $roadmap)
                                    <tr>

                                        {{-- Roadmap --}}
                                        <td>
                                            <div class="d-flex align-items-center gap-3">

                                                <div class="resource-order" style="flex-shrink: 0;">
                                                    <i class="bi bi-kanban"></i>
                                                </div>

                                                <div>
                                                    <div class="fw-bold text-dark">
                                                        {{ $roadmap->title }}
                                                    </div>

                                                    <div class="text-muted small">
                                                        {{ Str::limit($roadmap->description, 60) }}
                                                    </div>
                                                </div>

                                            </div>
                                        </td>


                                        {{-- Status --}}
                                        <td class="d-none d-md-table-cell">

                                            @php
                                                $statusClass = match ($roadmap->status) {
                                                    'published' => 'roadmap-status-published',
                                                    'draft' => 'roadmap-status-draft',
                                                    'pending_review' => 'roadmap-status-pending_review',
                                                    'rejected' => 'roadmap-status-rejected',
                                                    default => '',
                                                };

                                                $statusLabel = match ($roadmap->status) {
                                                    'published' => 'Published',
                                                    'draft' => 'Draft',
                                                    'pending_review' => 'Pending Review',
                                                    'rejected' => 'Rejected',
                                                    default => ucfirst($roadmap->status),
                                                };
                                            @endphp

                                            <span class="roadmap-status {{ $statusClass }}">
                                                {{ $statusLabel }}
                                            </span>

                                        </td>


                                        {{-- Resources --}}
                                        <td class="d-none d-lg-table-cell">

                                            <span class="text-muted">
                                                <i class="bi bi-collection me-1"></i>
                                                {{ $roadmap->resources_count }}
                                            </span>

                                        </td>


                                        {{-- Created --}}
                                        <td class="d-none d-lg-table-cell">

                                            <span class="text-muted">
                                                {{ $roadmap->created_at->format('Y-m-d') }}
                                            </span>

                                        </td>


                                        {{-- Actions --}}
                                        <td class="text-end">

                                            {{-- Edit --}}
                                            <a href="{{ route('creator.roadmaps.edit', $roadmap) }}"
                                                class="action-btn btn-edit" title="Edit Roadmap">
                                                <i class="bi bi-pencil"></i>
                                            </a>


                                            {{-- Delete --}}
                                            <form action="{{ route('creator.roadmaps.destroy', $roadmap) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="action-btn btn-delete" title="Delete Roadmap"
                                                    onclick="return confirm('Are you sure you want to delete this roadmap?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                            </form>

                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                    </div>
                @else
                    {{-- Empty State --}}
                    <div class="empty-state">

                        <div class="empty-state-icon">
                            <i class="bi bi-folder-open"></i>
                        </div>

                        <h3>
                            No roadmaps yet
                        </h3>

                        <p>
                            Create your first roadmap to get started.
                        </p>

                        <a href="{{ route('creator.roadmaps.create') }}" class="btn btn-primary-custom mt-2">
                            <i class="bi bi-plus-lg me-2"></i>
                            Create Roadmap
                        </a>

                    </div>

                @endif

            </div>

        </div>

    </div>
@endsection

@section('footer')
    @include('components.footers.footer')
@endsection
