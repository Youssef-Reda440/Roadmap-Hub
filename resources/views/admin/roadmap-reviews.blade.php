@extends('admin.layouts.master')

@section('title', 'Roadmap Reviews | Roadmap Hub')

@section('admin-content')
    @include('admin.components.breadcrumb', ['current' => 'Roadmap reviews'])

    <section class="admin-page-heading mb-4">
        <h1 class="h2 mb-1">Roadmap reviews</h1>
        <p class="text-secondary mb-0">Check new roadmaps for quality before publishing them for learners.</p>
    </section>

    <section class="admin-panel card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="admin-filter-bar border-bottom p-3">
                <nav class="admin-status-tabs nav nav-pills gap-2" aria-label="Roadmap status filters">
                    <a class="btn admin-btn-tab {{ request()->filled('status') ? '' : 'is-active active' }}"
                        href="{{ url('/admin/roadmap-reviews') }}">All</a>
                    @foreach (['pending_review' => 'Pending review', 'published' => 'Published', 'rejected' => 'Rejected', 'draft' => 'Draft'] as $status => $label)
                        <a class="btn admin-btn-tab {{ request('status') === $status ? 'is-active active' : '' }}"
                            href="{{ url('/admin/roadmap-reviews?status=' . $status) }}">{{ $label }}</a>
                    @endforeach
                </nav>
            </div>

            @if ($roadmaps->isEmpty())
                <div class="p-4">
                    @include('admin.components.empty-state', [
                        'title' => 'No roadmaps found',
                        'description' => request()->filled('status')
                            ? 'There are no roadmaps with the selected status.'
                            : 'There are no roadmaps available for review yet.',
                        'icon' => 'bi-collection',
                        'slot' => '',
                    ])
                </div>
            @else
                <div class="admin-table-wrapper table-responsive">
                    <table class="table admin-data-table align-middle mb-0">
                        <caption class="visually-hidden">Roadmaps awaiting admin review</caption>
                        <thead>
                            <tr>
                                <th scope="col">Roadmap</th>
                                <th scope="col">Creator</th>
                                <th scope="col">Category</th>
                                <th scope="col">Level</th>
                                <th scope="col">Status</th>
                                <th scope="col">Submitted</th>
                                <th scope="col" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roadmaps as $listedRoadmap)
                                <tr>
                                    <td>
                                        <strong>{{ $listedRoadmap->title }}</strong>
                                        @if (isset($listedRoadmap->resources_count))
                                            <small class="d-block text-secondary">{{ $listedRoadmap->resources_count }}
                                                resources</small>
                                        @endif
                                    </td>
                                    <td>{{ $listedRoadmap->creator->name }}</td>
                                    <td>{{ $listedRoadmap->category->name }}</td>
                                    <td>{{ \Illuminate\Support\Str::headline($listedRoadmap->level) }}</td>
                                    <td>@include('admin.components.status-badge', [
                                        'status' => $listedRoadmap->status,
                                    ])</td>
                                    <td>{{ $listedRoadmap->created_at?->format('M j, Y') ?? '—' }}</td>
                                    <td class="text-end">
                                        <a class="btn admin-btn-secondary btn-sm"
                                            href="{{ url('/admin/roadmap-reviews/' . $listedRoadmap->id) }}{{ request()->filled('status') ? '?status=' . urlencode(request('status')) : '' }}">
                                            Review roadmap
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="admin-pagination border-top px-3 py-3">
                    {{ $roadmaps->links() }}
                </div>
            @endif
        </div>
    </section>

    @isset($roadmap)
        <section class="admin-panel card shadow-sm border-0 mt-4" id="roadmap-details">
            <div
                class="card-header bg-white d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2 py-3">
                <div>
                    <span class="admin-summary-card__eyebrow small text-secondary text-uppercase">Roadmap details</span>
                    <h2 class="h4 mt-1 mb-0">{{ $roadmap->title }}</h2>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a class="btn admin-btn-secondary btn-sm"
                        href="{{ url('/admin/roadmap-reviews') }}{{ request()->filled('status') ? '?status=' . urlencode(request('status')) : '' }}">
                        Back to roadmaps
                    </a>
                    @include('admin.components.status-badge', ['status' => $roadmap->status])
                </div>
            </div>

            <div class="card-body">
                <p class="admin-panel__description">{{ $roadmap->description }}</p>

                <dl class="admin-detail-list row mt-4 mb-0">
                    <dt class="col-sm-3 text-secondary">Creator</dt>
                    <dd class="col-sm-9">{{ $roadmap->creator->name }}</dd>

                    <dt class="col-sm-3 text-secondary">Category</dt>
                    <dd class="col-sm-9">{{ $roadmap->category->name }}</dd>

                    <dt class="col-sm-3 text-secondary">Level</dt>
                    <dd class="col-sm-9">{{ \Illuminate\Support\Str::headline($roadmap->level) }}</dd>

                    <dt class="col-sm-3 text-secondary">Enrolments</dt>
                    <dd class="col-sm-9">{{ $roadmap->enrollments->count() }}</dd>

                    <dt class="col-sm-3 text-secondary">Reviews</dt>
                    <dd class="col-sm-9 mb-0">{{ $roadmap->reviews->count() }}</dd>
                </dl>

                <section class="mt-4">
                    <h3 class="h5 mb-3">Resources</h3>
                    @forelse ($resources as $resource)
                        <article class="border rounded-3 p-3 mb-2">
                            <div class="d-flex flex-column flex-sm-row align-items-sm-start justify-content-between gap-2">
                                <div>
                                    <h4 class="h6 mb-1">{{ $resource->title }}</h4>
                                    <p class="text-secondary small mb-0">{{ $resource->description }}</p>
                                </div>
                                <span
                                    class="badge text-bg-light">{{ \Illuminate\Support\Str::headline($resource->type) }}</span>
                            </div>
                            <a class="small d-inline-block mt-2" href="{{ $resource->url }}" target="_blank"
                                rel="noopener noreferrer">
                                Open resource
                            </a>
                        </article>
                    @empty
                        <p class="text-secondary mb-0">No resources have been added to this roadmap.</p>
                    @endforelse
                </section>

                <section class="mt-4">
                    <h3 class="h5 mb-3">Reviews</h3>
                    @forelse ($roadmap->reviews as $review)
                        <article class="border rounded-3 p-3 mb-2">
                            <div class="d-flex justify-content-between gap-3">
                                <strong>{{ $review->user->name }}</strong>
                                <span class="text-warning" aria-label="Rating: {{ $review->rating }} out of 5">
                                    {{ $review->rating }}/5
                                </span>
                            </div>
                            <p class="mb-0 mt-2">{{ $review->comment }}</p>
                        </article>
                    @empty
                        <p class="text-secondary mb-0">No learner reviews have been submitted.</p>
                    @endforelse
                </section>

                <section class="mt-4">
                    <h3 class="h5 mb-3">Enrolments</h3>
                    @forelse ($roadmap->enrollments as $enrollment)
                        <div class="border-bottom py-2 d-flex flex-column flex-sm-row justify-content-between gap-1">
                            <span>{{ $enrollment->user->name }}</span>
                            <small class="text-secondary">
                                Enrolled {{ $enrollment->enrolled_at?->format('M j, Y') ?? '—' }}
                            </small>
                        </div>
                    @empty
                        <p class="text-secondary mb-0">No learners are enrolled in this roadmap.</p>
                    @endforelse
                </section>
            </div>

            @if ($roadmap->status === 'pending_review')
                <div class="card-footer bg-white">
                    <p class="small text-secondary mb-3">
                        Requesting changes is unavailable because review notes and a changes-requested status are not supported
                        by the current schema.
                    </p>
                    <div class="admin-form-actions d-flex flex-wrap justify-content-end gap-2">
                        <form method="POST" action="{{ url('/admin/roadmap-reviews/' . $roadmap->id . '/reject') }}">
                            @csrf
                            @method('PATCH')
                            <button class="btn admin-btn-danger btn-sm" type="submit">Reject roadmap</button>
                        </form>
                        <form method="POST" action="{{ url('/admin/roadmap-reviews/' . $roadmap->id . '/approve') }}">
                            @csrf
                            @method('PATCH')
                            <button class="btn admin-btn-primary btn-sm" type="submit">Publish roadmap</button>
                        </form>
                    </div>
                </div>
            @elseif ($roadmap->status === 'published')
                <div class="card-footer bg-white">
                    <div class="admin-form-actions d-flex justify-content-end">
                        <form method="POST" action="{{ url('/admin/roadmaps/' . $roadmap->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn admin-btn-danger btn-sm" type="submit">Remove roadmap</button>
                        </form>
                    </div>
                </div>
            @endif
        </section>
    @endisset
@endsection
