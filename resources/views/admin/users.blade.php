@extends('admin.layouts.master')

@section('title', 'Users | Roadmap Hub')

@section('admin-content')
    @include('admin.components.breadcrumb', ['current' => 'Users'])

    <section
        class="admin-page-heading d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h2 mb-1">Manage users</h1>
            <p class="text-secondary mb-0">Find platform accounts and review their available details.</p>
        </div>
    </section>

    <section class="admin-panel card border-0 shadow-sm">
        <div class="card-body p-4">
            {{-- The GET form keeps search and role filters shareable in the page URL. --}}
            <form class="admin-filter-bar row g-3 align-items-end mb-4" method="GET" action="{{ url('/admin/users') }}">
                <div class="col-12 col-lg">
                    <label class="form-label" for="user-search">Search users</label>
                    <div class="input-group admin-search admin-search--wide">
                        <span class="input-group-text bg-white"><i class="bi bi-search" aria-hidden="true"></i></span>
                        <input class="form-control" id="user-search" name="search" type="search"
                            value="{{ request('search') }}" placeholder="Search by name or email">
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-auto">
                    <label class="form-label" for="user-role">Role</label>
                    <select class="form-select admin-form-control admin-filter-select" id="user-role" name="role">
                        <option value="">All roles</option>
                        <option value="learner" @selected(request('role') === 'learner')>Learner</option>
                        <option value="creator" @selected(request('role') === 'creator')>Creator</option>
                        <option value="admin" @selected(request('role') === 'admin')>Admin</option>
                    </select>
                </div>

                <div class="col-12 col-sm-auto d-flex gap-2">
                    <button class="btn admin-btn-primary btn-primary" type="submit">Apply filters</button>
                    <a class="btn admin-btn-secondary btn-outline-secondary" href="{{ url('/admin/users') }}">Reset</a>
                </div>
            </form>

            <div
                class="admin-panel__header d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2 mb-3">
                <div>
                    <h2 class="admin-panel__title h4 mb-1">User list</h2>
                    <p class="admin-panel__description text-secondary mb-0">
                        Showing {{ $users->firstItem() ?? 0 }}–{{ $users->lastItem() ?? 0 }} of {{ $users->total() }}
                        registered users.
                    </p>
                </div>
            </div>

            @if ($users->isEmpty())
                @include('admin.components.empty-state', [
                    'title' => 'No users found',
                    'description' => 'Try changing the search term or selected role.',
                    'icon' => 'bi-people',
                    'slot' => '',
                ])
            @else
                <div class="admin-table-wrapper table-responsive">
                    <table class="table admin-data-table align-middle mb-0">
                        <caption class="visually-hidden">Users table</caption>
                        <thead>
                            <tr>
                                <th scope="col">User</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Joined</th>
                                <th scope="col"><span class="visually-hidden">Actions</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $listedUser)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <span
                                                class="admin-avatar admin-avatar--small rounded-circle bg-primary text-white d-inline-grid place-items-center px-2 py-1">
                                                {{ mb_strtoupper(mb_substr($listedUser->name, 0, 1)) }}
                                            </span>
                                            <strong>{{ $listedUser->name }}</strong>
                                        </div>
                                    </td>
                                    <td dir="ltr">{{ $listedUser->email }}</td>
                                    <td>
                                        <span class="admin-role-badge admin-role-badge--{{ $listedUser->role }}">
                                            {{ \Illuminate\Support\Str::headline($listedUser->role) }}
                                        </span>
                                    </td>
                                    <td>{{ $listedUser->created_at?->format('M j, Y') ?? '—' }}</td>
                                    <td class="text-end">
                                        <a class="btn admin-btn-secondary btn-sm btn-outline-secondary"
                                            href="{{ url('/admin/users/' . $listedUser->id) }}{{ request()->getQueryString() ? '?' . request()->getQueryString() : '' }}">
                                            View details
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($users->hasPages())
                    <div class="admin-pagination mt-4">
                        {{ $users->links() }}
                    </div>
                @endif
            @endif
        </div>
    </section>

    @if ($user)
        <section class="admin-panel card border-0 shadow-sm mt-4" id="user-details">
            <div
                class="card-header bg-white d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2 py-3">
                <div>
                    <h2 class="admin-panel__title h4 mb-1">User details</h2>
                    <p class="admin-panel__description text-secondary mb-0">Available account information.</p>
                </div>
                <span class="admin-role-badge admin-role-badge--{{ $user->role }}">
                    {{ \Illuminate\Support\Str::headline($user->role) }}
                </span>
            </div>
            <div class="card-body">
                <dl class="admin-detail-list row mb-0">
                    <dt class="col-sm-3 text-secondary">Name</dt>
                    <dd class="col-sm-9">{{ $user->name }}</dd>

                    <dt class="col-sm-3 text-secondary">Email</dt>
                    <dd class="col-sm-9" dir="ltr">{{ $user->email }}</dd>

                    <dt class="col-sm-3 text-secondary">Joined</dt>
                    <dd class="col-sm-9">{{ $user->created_at?->format('M j, Y') ?? '—' }}</dd>
                </dl>

                {{-- These are the only account fields supported by UserController::update. --}}
                <hr class="my-4">

                <h3 class="h5 mb-3">Edit user</h3>
                <form method="POST" action="{{ url('/admin/users/' . $user->id) }}" class="row g-3">
                    @csrf
                    @method('PATCH')

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="user-name">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" id="user-name" name="name"
                            type="text" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="user-email">Email</label>
                        <input class="form-control @error('email') is-invalid @enderror" id="user-email" name="email"
                            type="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="user-role-edit">Role</label>
                        <select class="form-select @error('role') is-invalid @enderror" id="user-role-edit" name="role"
                            @if ($user->is(auth()->user())) disabled aria-describedby="user-role-restriction" @else required @endif>
                            @foreach (['learner' => 'Learner', 'creator' => 'Creator', 'admin' => 'Admin'] as $value => $label)
                                <option value="{{ $value }}" @selected(old('role', $user->role) === $value)>{{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @if ($user->is(auth()->user()))
                            <input name="role" type="hidden" value="{{ $user->role }}">
                            <p class="form-text mb-0" id="user-role-restriction">Your own administrator role cannot be
                                changed.</p>
                        @else
                            <p class="form-text mb-0">The final administrator account cannot be changed to another role.
                            </p>
                        @endif
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 d-flex justify-content-end gap-2">
                        <a class="btn admin-btn-secondary btn-outline-secondary"
                            href="{{ url('/admin/users') }}{{ request()->getQueryString() ? '?' . request()->getQueryString() : '' }}">Close</a>
                        <button class="btn admin-btn-primary btn-primary" type="submit">Save changes</button>
                    </div>
                </form>
            </div>
        </section>
    @endif
@endsection
