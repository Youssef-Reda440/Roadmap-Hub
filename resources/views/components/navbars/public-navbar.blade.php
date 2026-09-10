<nav class="saas-navbar">
    <div class="saas-nav-container">
        <div class="saas-nav-actions">
            @guest
                <a href="{{ route('login') }}" class="saas-btn-nav-login">
                    تسجيل دخول
                </a>

                <a href="{{ route('register') }}" class="saas-btn-nav-register">
                    إنشاء حساب
                </a>
            @endguest

            @auth
                @if (auth()->user()->role === 'learner')
                    <a href="{{ route('learner.dashboard') }}" class="saas-btn-nav-login">
                        لوحة التحكم
                    </a>
                @elseif(auth()->user()->role === 'creator')
                    <a href="{{ route('creator.dashboard') }}" class="saas-btn-nav-login">
                        لوحة التحكم
                    </a>
                @endif

                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="saas-btn-nav-register">
                        تسجيل خروج
                    </button>
                </form>
            @endauth
        </div>

        <button class="saas-nav-toggle" id="navToggleBtn" aria-label="تبديل القائمة">
            ☰
        </button>

        <div class="saas-nav-menu-wrapper" id="navMenuWrapper">
            <ul class="saas-nav-links">
                <li>
                    <a href="{{ route('home.index') }}"
                        class="saas-nav-link {{ request()->routeIs('home.index') ? 'active' : '' }}">
                        الرئيسية
                    </a>
                </li>

                <li>
                    <a href="{{ route('roadmaps.index') }}"
                        class="saas-nav-link {{ request()->routeIs('roadmaps.*') ? 'active' : '' }}">
                        استكشف المسارات
                    </a>
                </li>

                <li>
                    <a href="{{ route('categories.index') }}"
                        class="saas-nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                        التصنيفات
                    </a>
                </li>

                <li>
                    <a href="{{ route('home.index') }}#how-it-works" class="saas-nav-link">
                        كيف تعمل المنصة
                    </a>
                </li>
            </ul>
        </div>

        <a href="{{ route('home.index') }}" class="saas-brand">
            <div class="saas-brand-name">
                <span class="saas-brand-title">
                    Roadmap Hub
                </span>

                <span class="saas-brand-sub">
                    مسارات التعلم المنظمة
                </span>
            </div>

            <div class="saas-brand-logo">
                <img src="{{ asset('assets/logo.ico') }}" alt="Roadmap Hub Logo">
            </div>
        </a>
    </div>
</nav>
