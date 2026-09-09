@extends('admin.layouts.master')

@section('title', 'Reports | Roadmap Hub')

@section('admin-content')
    @include('admin.components.breadcrumb', ['current' => 'Reports'])

    <section class="admin-page-heading mb-4">
        <h1 class="h2 mb-1">Manage reports</h1>
        <p class="text-secondary mb-0">Review community reports and take action to maintain content quality.</p>
    </section>

    <section class="admin-panel card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="admin-filter-bar border-bottom p-3 d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
                <nav class="admin-status-tabs nav nav-pills gap-2" aria-label="Report status filters">
                    <a class="btn admin-btn-tab {{ request()->filled('status') ? '' : 'is-active active' }}"
                        href="{{ url('/admin/reports') }}">All</a>
                    @foreach (['pending' => 'Pending', 'resolved' => 'Resolved'] as $status => $label)
                        <a class="btn admin-btn-tab {{ request('status') === $status ? 'is-active active' : '' }}"
                            href="{{ url('/admin/reports?status=' . $status) }}">{{ $label }}</a>
                    @endforeach
                </nav>

                <div>
                    <label class="visually-hidden" for="report-type-filter">Report type</label>
                    <select id="report-type-filter" class="form-select admin-form-control admin-filter-select" disabled
                        title="Report type filtering is not available yet.">
                        <option>All report types</option>
                    </select>
                </div>
            </div>

            @if ($reports->isEmpty())
                <div class="p-4">
                    @include('admin.components.empty-state', [
                        'title' => 'No reports found',
                        'description' => request()->filled('status')
                            ? 'There are no reports with the selected status.'
                            : 'There are no community reports at the moment.',
                        'icon' => 'bi-flag',
                        'slot' => '',
                    ])
                </div>
            @else
                <div class="admin-table-wrapper table-responsive">
                    <table class="table admin-data-table align-middle mb-0">
                        <caption class="visually-hidden">Community reports</caption>
                        <thead>
                            <tr>
                                <th scope="col">Reported by</th>
                                <th scope="col">Reported content</th>
                                <th scope="col">Reason</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $listedReport)
                                @php
                                    $reportable = $listedReport->reportable;
                                    $contentTitle = data_get($reportable, 'title')
                                        ?? ($reportable ? class_basename($reportable) . ' #' . $reportable->getKey() : 'Unavailable content');
                                @endphp
                                <tr>
                                    <td><strong>{{ $listedReport->user->name }}</strong></td>
                                    <td>{{ $contentTitle }}</td>
                                    <td>{{ $listedReport->reason }}</td>
                                    <td>{{ $listedReport->created_at?->format('M j, Y') ?? '—' }}</td>
                                    <td>@include('admin.components.status-badge', ['status' => $listedReport->status])</td>
                                    <td class="text-end">
                                        <a class="btn admin-btn-secondary btn-sm" href="{{ url('/admin/reports/' . $listedReport->id) }}">
                                            Review
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="admin-pagination border-top px-3 py-3">
                    {{ $reports->links() }}
                </div>
            @endif
        </div>
    </section>

    @isset($report)
        @php
            $reportable = $report->reportable;
            $contentTitle = data_get($reportable, 'title')
                ?? ($reportable ? class_basename($reportable) . ' #' . $reportable->getKey() : 'Unavailable content');
        @endphp

        <section class="admin-panel card shadow-sm border-0 mt-4" id="report-details">
            <div class="card-header bg-white d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2 py-3">
                <div>
                    <h2 class="h5 mb-1">Report details</h2>
                    <p class="small text-secondary mb-0">Review the reported content and its submitted reason.</p>
                </div>
                @include('admin.components.status-badge', ['status' => $report->status])
            </div>
            <div class="card-body">
                <dl class="admin-detail-list row mb-0">
                    <dt class="col-sm-3 text-secondary">Reported by</dt>
                    <dd class="col-sm-9">{{ $report->user->name }}</dd>

                    <dt class="col-sm-3 text-secondary">Content</dt>
                    <dd class="col-sm-9">{{ $contentTitle }}</dd>

                    <dt class="col-sm-3 text-secondary">Reason</dt>
                    <dd class="col-sm-9">{{ $report->reason }}</dd>

                    <dt class="col-sm-3 text-secondary">Submitted</dt>
                    <dd class="col-sm-9 mb-0">{{ $report->created_at?->format('M j, Y g:i A') ?? '—' }}</dd>
                </dl>
            </div>

            @if ($report->status === 'pending')
                <div class="card-footer bg-white d-flex justify-content-end">
                    <form method="POST" action="{{ url('/admin/reports/' . $report->id . '/resolve') }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn admin-btn-primary btn-sm" type="submit">Resolve report</button>
                    </form>
                </div>
            @endif
        </section>
    @endisset
@endsection
