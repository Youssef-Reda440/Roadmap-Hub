<nav class="navbar navbar-expand-lg bg-white border-bottom">
    <div class="container">

        {{-- Brand --}}
        <a class="navbar-brand fw-bold" href="#">
            Roadmap Hub
        </a>

        {{-- Mobile Toggle --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#publicNavbar"
            aria-controls="publicNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Navigation --}}
        <div class="collapse navbar-collapse" id="publicNavbar">

            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        الرئيسية
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        المسارات
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        التصنيفات
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        المبدعون
                    </a>
                </li>

            </ul>

            {{-- Auth Actions --}}
            <div class="d-flex gap-2">

                <a href="#" class="btn btn-outline-primary">
                    تسجيل الدخول
                </a>

                <a href="#" class="btn btn-primary">
                    إنشاء حساب
                </a>

            </div>

        </div>

    </div>
</nav>
