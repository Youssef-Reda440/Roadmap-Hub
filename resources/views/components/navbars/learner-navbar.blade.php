<nav class="learner-navbar">
    <div class="learner-nav-container">
        {{-- Brand --}}
        <a href="{{ route('learner.dashboard') }}" class="learner-brand">
            <div class="learner-brand-logo">
                <img src="{{ asset('assets/logo.ico') }}" alt="Roadmap Hub Logo">
            </div>

            <div class="learner-brand-name">
                <span class="learner-brand-title">Roadmap Hub</span>
                <span class="learner-brand-sub">
                    مسارات التعلم المنظمة
                </span>
            </div>
        </a>

        {{-- Navigation --}}
        <div class="learner-nav-menu">
            <a href="{{ route('learner.dashboard') }}"
                class="learner-nav-link {{ request()->routeIs('learner.dashboard') ? 'active' : '' }}">
                لوحة التحكم
            </a>

            <a href="{{ route('roadmaps.index') }}"
                class="learner-nav-link {{ request()->routeIs('roadmaps.*') ? 'active' : '' }}">
                استكشف المسارات
            </a>

            <a href="{{ route('learner.learning.index') }}"
                class="learner-nav-link {{ request()->routeIs('learner.learning.*') ? 'active' : '' }}">
                تعلّمي
            </a>

            <a href="{{ route('learner.saved-roadmaps.index') }}"
                class="learner-nav-link {{ request()->routeIs('learner.saved-roadmaps.*') ? 'active' : '' }}">
                المحفوظات
            </a>
        </div>

        {{-- User Actions --}}
        <div class="learner-nav-actions">
            {{-- Profile --}}
            <a href="{{ route('learner.profile.show') }}" class="learner-profile">
                <div class="learner-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div class="learner-profile-info">
                    <span class="learner-profile-name">
                        {{ auth()->user()->name }}
                    </span>

                    <span class="learner-profile-role">
                        متعلم
                    </span>
                </div>

                <i class="bi bi-chevron-down learner-profile-arrow"></i>
            </a>
        </div>
    </div>
</nav>
