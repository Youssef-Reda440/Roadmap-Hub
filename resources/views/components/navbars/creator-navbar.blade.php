@php
    /** @var \App\Models\User $user */
    $user = auth()->user();
@endphp

<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top creator-navbar">
    <div class="container">

        {{-- Brand --}}
        <a class="navbar-brand creator-brand" href="{{ route('creator.dashboard') }}">
            <i class="bi bi-kanban-fill me-2"></i>
            Roadmap Hub
        </a>

        {{-- Mobile Toggle --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#creatorNavbar"
            aria-controls="creatorNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list fs-4"></i>
        </button>

        {{-- Navigation --}}
        <div class="collapse navbar-collapse" id="creatorNavbar">

            <ul class="navbar-nav ms-auto align-items-lg-center">

                {{-- Dashboard --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('creator.dashboard') ? 'active' : '' }}"
                        href="{{ route('creator.dashboard') }}">
                        <i class="bi bi-speedometer2 me-2"></i>
                        Dashboard
                    </a>
                </li>

                {{-- My Roadmaps --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('creator.roadmaps.index', 'creator.roadmaps.edit') ? 'active' : '' }}"
                        href="{{ route('creator.roadmaps.index') }}">
                        <i class="bi bi-collection me-2"></i>
                        My Roadmaps
                    </a>
                </li>

                {{-- Add Roadmap --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('creator.roadmaps.create') ? 'active' : '' }}"
                        href="{{ route('creator.roadmaps.create') }}">
                        <i class="bi bi-plus-circle me-2"></i>
                        Add Roadmap
                    </a>
                </li>

                {{-- Profile --}}
                <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                    <div class="creator-profile">

                        <div class="creator-avatar">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>

                        <div class="d-none d-lg-block">
                            <div class="creator-profile-name">
                                {{ $user->name }}
                            </div>

                            <div class="creator-profile-role">
                                Creator
                            </div>
                        </div>

                    </div>
                </li>

                {{-- Logout --}}
                <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="btn btn-outline-danger creator-logout-btn">
                            <i class="bi bi-box-arrow-right me-1"></i>
                            Logout
                        </button>
                    </form>
                </li>

            </ul>

        </div>
    </div>
</nav>
