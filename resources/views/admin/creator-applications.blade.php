@extends('admin.layouts.master')

@section('title', 'Creator Applications | Roadmap Hub')

@section('admin-content')
    @include('admin.components.breadcrumb', ['current' => 'Creator applications'])

    <section
        class="admin-page-heading d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h2 mb-1">Creator applications</h1>
            <p class="text-secondary mb-0">Review applications from members who want to share their expertise and roadmaps.
            </p>
        </div>
    </section>

    <section class="admin-panel card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="admin-filter-bar border-bottom p-3">
                <nav class="admin-status-tabs nav nav-pills gap-2" aria-label="Application status filters">
                    <a class="btn admin-btn-tab {{ request()->filled('status') ? '' : 'is-active active' }}"
                        href="{{ url('/admin/creator-applications') }}">All</a>
                    @foreach (['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'] as $status => $label)
                        <a class="btn admin-btn-tab {{ request('status') === $status ? 'is-active active' : '' }}"
                            href="{{ url('/admin/creator-applications?status=' . $status) }}">{{ $label }}</a>
                    @endforeach
                </nav>
            </div>

            @if ($applications->isEmpty())
                <div class="p-4">
                    @include('admin.components.empty-state', [
                        'title' => 'No creator applications found',
                        'description' => request()->filled('status')
                            ? 'There are no ' . request('status') . ' creator applications at the moment.'
                            : 'There are no creator applications at the moment.',
                        'icon' => 'bi-person-plus',
                        'slot' => '',
                    ])
                </div>
            @else
                <div class="admin-table-wrapper table-responsive">
                    <table class="table admin-data-table align-middle mb-0">
                        <caption class="visually-hidden">Creator applications</caption>
                        <thead>
                            <tr>
                                <th scope="col">Applicant</th>
                                <th scope="col">Email</th>
                                <th scope="col">Applied</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($applications as $listedApplication)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="admin-avatar admin-avatar--small" aria-hidden="true">
                                                {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($listedApplication->user->name, 0, 1)) }}
                                            </span>
                                            <strong>{{ $listedApplication->user->name }}</strong>
                                        </div>
                                    </td>
                                    <td>{{ $listedApplication->user->email }}</td>
                                    <td>{{ $listedApplication->created_at?->format('M j, Y') ?? '—' }}</td>
                                    <td>@include('admin.components.status-badge', [
                                        'status' => $listedApplication->status,
                                    ])</td>
                                    <td class="text-end">
                                        <a class="btn admin-btn-secondary btn-sm"
                                            href="{{ url('/admin/creator-applications/' . $listedApplication->id) }}{{ request()->filled('status') ? '?status=' . urlencode(request('status')) : '' }}">
                                            Review application
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="admin-pagination px-3 py-3 border-top">
                    {{ $applications->links() }}
                </div>
            @endif
        </div>
    </section>

    @isset($application)
        <section class="admin-panel card shadow-sm border-0 mt-4" id="application-details">
            <div
                class="card-header bg-white d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2 py-3">
                <div>
                    <h2 class="h5 mb-1">{{ $application->user->name }}&rsquo;s application</h2>
                    <p class="text-secondary small mb-0">Application details and review actions.</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a class="btn admin-btn-secondary btn-sm"
                        href="{{ url('/admin/creator-applications') }}{{ request()->filled('status') ? '?status=' . urlencode(request('status')) : '' }}">
                        Back to applications
                    </a>
                    @include('admin.components.status-badge', ['status' => $application->status])
                </div>
            </div>
            <div class="card-body">
                <dl class="admin-detail-list row mb-0">
                    <dt class="col-sm-3 text-secondary">Applicant</dt>
                    <dd class="col-sm-9">{{ $application->user->name }}</dd>

                    <dt class="col-sm-3 text-secondary">Email</dt>
                    <dd class="col-sm-9">{{ $application->user->email }}</dd>

                    <dt class="col-sm-3 text-secondary">Applied</dt>
                    <dd class="col-sm-9 mb-0">{{ $application->created_at?->format('M j, Y') ?? '—' }}</dd>
                </dl>
            </div>
            @if ($application->status === 'pending')
                <div class="card-footer bg-white">
                    @if ($application->user->role !== 'learner')
                        <p class="small text-secondary mb-3">
                            This application cannot be approved because the applicant already has a
                            {{ \Illuminate\Support\Str::headline($application->user->role) }} role. Only learner accounts can
                            become creators.
                        </p>
                    @endif
                    <div class="d-flex flex-wrap justify-content-end gap-2">
                        <form method="POST" action="{{ url('/admin/creator-applications/' . $application->id . '/reject') }}">
                            @csrf
                            @method('PATCH')
                            <button class="btn admin-btn-danger btn-sm" type="submit">Reject application</button>
                        </form>
                        @if ($application->user->role === 'learner')
                            <form method="POST"
                                action="{{ url('/admin/creator-applications/' . $application->id . '/approve') }}">
                                @csrf
                                @method('PATCH')
                                <button class="btn admin-btn-primary btn-sm" type="submit">Approve creator</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endif
        </section>
    @endisset
@endsection
