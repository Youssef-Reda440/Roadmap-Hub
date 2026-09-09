<footer class="auth-footer">
    <div class="auth-footer-container">
        <a href="{{ route('home.index') }}" class="auth-footer-brand">
            <img src="{{ asset('assets/logo.ico') }}" width="36" height="36" alt="Roadmap Hub Logo">

            <span>Roadmap Hub</span>
        </a>

        <p class="auth-footer-copy">
            جميع الحقوق محفوظة &copy; {{ date('Y') }}
            لمنصة Roadmap Hub
        </p>

        <div class="auth-footer-links">
            <a href="{{ route('home.index') }}">
                الرئيسية
            </a>

            <a href="{{ route('roadmaps.index') }}">
                استكشف المسارات
            </a>

            <a href="{{ route('categories.index') }}">
                التصنيفات
            </a>
        </div>
    </div>
</footer>
