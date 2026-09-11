@php
    $admin = auth()->user();
    $initial = $admin?->name ? mb_strtoupper(mb_substr($admin->name, 0, 1)) : 'A';
    $navigation = [
        [
            'label' => 'Dashboard',
            'icon' => 'bi-speedometer2',
            'url' => url('/admin/dashboard'),
            'active' => request()->is('admin/dashboard'),
        ],
        [
            'label' => 'Users',
            'icon' => 'bi-people',
            'url' => url('/admin/users'),
            'active' => request()->is('admin/users*'),
        ],
        [
            'label' => 'Creator Applications',
            'icon' => 'bi-person-plus',
            'url' => url('/admin/creator-applications'),
            'active' => request()->is('admin/creator-applications*'),
        ],
        [
            'label' => 'Roadmap Reviews',
            'icon' => 'bi-collection',
            'url' => url('/admin/roadmap-reviews'),
            'active' => request()->is('admin/roadmap-reviews*'),
        ],
        [
            'label' => 'Categories',
            'icon' => 'bi-grid',
            'url' => url('/admin/categories'),
            'active' => request()->is('admin/categories*'),
        ],
        [
            'label' => 'Reports',
            'icon' => 'bi-flag',
            'url' => url('/admin/reports'),
            'active' => request()->is('admin/reports*'),
        ],
    ];
@endphp

<header class="studio-header sticky-top bg-white border-bottom">
    <nav class="studio-nav container navbar navbar-expand-xl py-3" aria-label="Admin navigation">
        <a class="studio-brand navbar-brand fw-bold d-inline-flex align-items-center gap-2"
            href="{{ url('/admin/dashboard') }}">
            <span class="studio-brand-logo" aria-hidden="true">
                <img src="{{ asset('assets/logo.ico') }}" alt="">
            </span>
            <span class="studio-brand-title">Roadmap Hub</span>
        </a>

        <button class="studio-nav-toggle navbar-toggler border-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#studioNavigation" aria-controls="studioNavigation" aria-expanded="false"
            aria-label="Toggle admin navigation">
            <i class="bi bi-list" aria-hidden="true"></i>
        </button>

        <div class="studio-navigation collapse navbar-collapse justify-content-end" id="studioNavigation">
            <div class="navbar-nav align-items-xl-center gap-xl-1">
                @foreach ($navigation as $item)
                    <a class="studio-nav-link nav-link {{ $item['active'] ? 'active' : '' }}" href="{{ $item['url'] }}"
                        @if ($item['active']) aria-current="page" @endif>
                        <i class="bi {{ $item['icon'] }}" aria-hidden="true"></i>
                        {{ $item['label'] }}
                    </a>
                @endforeach

                <a class="studio-account nav-link d-inline-flex align-items-center gap-2 ms-xl-2 {{ request()->is('admin/profile') ? 'active' : '' }}"
                    href="{{ url('/admin/profile') }}" @if (request()->is('admin/profile')) aria-current="page" @endif>
                    <span
                        class="admin-avatar admin-avatar--small rounded-circle bg-primary text-white d-inline-grid place-items-center px-2 py-1">
                        {{ $initial }}
                    </span>
                    <span>
                        <strong class="d-block">{{ $admin?->name ?? 'Admin' }}</strong>
                        <small class="d-block text-secondary">Platform admin</small>
                    </span>
                </a>

                <form method="POST" action="{{ route('logout') }}" class="ms-xl-2">
                    @csrf
                    <button class="btn btn-outline-danger btn-sm" type="submit">
                        <i class="bi bi-box-arrow-right" aria-hidden="true"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>
</header>
