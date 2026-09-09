@extends('layouts.app')

@section('lang', 'ar')
@section('dir', 'rtl')

@section('title', 'Learner Dashboard')

@section('head')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&family=Rubik:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/learner/creator-application.css') }}">
    <link rel="stylesheet" href="{{ asset('css/learner/learner-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('navigation')
    @include('components.navbars.learner-navbar')
@endsection

@section('content')
    {{-- @var User $application --}}
    <main class="creator-application-page">

        <!-- Page Header -->
        <section class="page-header">

            <div>

                <p class="page-label">
                    منشئو المحتوى
                </p>

                <h1>
                    كن منشئ محتوى
                </h1>

                <p>
                    شارك معرفتك وخبرتك مع مجتمع Roadmap Hub
                    وساعد الآخرين على بناء رحلتهم التعليمية.
                </p>

            </div>

        </section>


        @if (!$application)
            <!-- Application Intro -->
            <section class="application-layout">

                <!-- Main Card -->
                <div class="application-card">

                    <div class="application-icon">
                        <i class="bi bi-lightbulb"></i>
                    </div>

                    <div class="application-content">

                        <h2>
                            شارك معرفتك مع الآخرين
                        </h2>

                        <p>
                            إذا كنت تمتلك معرفة أو خبرة في مجال معين،
                            يمكنك التقديم لتصبح منشئ محتوى على Roadmap Hub
                            وإنشاء مسارات تعليمية تساعد المتعلمين على الوصول
                            إلى أهدافهم.
                        </p>

                    </div>


                    <!-- Benefits -->
                    <div class="benefits">

                        <div class="benefit-item">

                            <div class="benefit-icon">
                                <i class="bi bi-map"></i>
                            </div>

                            <div>
                                <h3>
                                    أنشئ مسارات تعليمية
                                </h3>

                                <p>
                                    حوّل خبرتك إلى مسارات منظمة وسهلة المتابعة.
                                </p>
                            </div>

                        </div>


                        <div class="benefit-item">

                            <div class="benefit-icon">
                                <i class="bi bi-people"></i>
                            </div>

                            <div>
                                <h3>
                                    ساعد المتعلمين
                                </h3>

                                <p>
                                    شارك معرفتك وساعد الآخرين في تطوير مهاراتهم.
                                </p>
                            </div>

                        </div>


                        <div class="benefit-item">

                            <div class="benefit-icon">
                                <i class="bi bi-graph-up-arrow"></i>
                            </div>

                            <div>
                                <h3>
                                    طوّر محتواك
                                </h3>

                                <p>
                                    ابنِ محتوى تعليميًا منظمًا وشارك خبرتك مع المجتمع.
                                </p>
                            </div>

                        </div>

                    </div>


                    <!-- Application Action -->
                    <div class="application-action">

                        <div>

                            <strong>
                                مستعد للبدء؟
                            </strong>

                            <span>
                                أرسل طلبك وسيتم مراجعته من قبل الإدارة.
                            </span>

                        </div>

                        <form action="{{ route('learner.creator-application.store') }}" method="POST">

                            @csrf

                            <button type="submit" class="apply-btn">
                                تقديم الطلب
                                <i class="bi bi-arrow-left"></i>
                            </button>

                        </form>

                    </div>

                </div>


                <!-- Side Information -->
                <aside class="application-info">

                    <div class="info-card">

                        <div class="info-card-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>

                        <h2>
                            كيف تتم مراجعة الطلب؟
                        </h2>

                        <p>
                            بعد إرسال الطلب، سيقوم فريق الإدارة بمراجعته.
                            في حالة الموافقة، ستتمكن من استخدام صلاحيات
                            منشئ المحتوى.
                        </p>

                    </div>


                    <div class="info-card">

                        <div class="info-card-icon">
                            <i class="bi bi-info-circle"></i>
                        </div>

                        <h2>
                            قبل التقديم
                        </h2>

                        <ul>

                            <li>
                                امتلك معرفة جيدة بالمجال الذي ستقدم فيه المحتوى.
                            </li>

                            <li>
                                احرص على تقديم مسارات واضحة ومنظمة.
                            </li>

                            <li>
                                ساعد المتعلمين على الوصول لأهدافهم بشكل عملي.
                            </li>

                        </ul>

                    </div>

                </aside>

            </section>
        @elseif ($application->status === 'pending')
            <!-- Pending Application -->
            <section class="application-status-card pending">

                <div class="status-icon">
                    <i class="bi bi-hourglass-split"></i>
                </div>

                <div class="status-content">

                    <span class="status-label">
                        قيد المراجعة
                    </span>

                    <h2>
                        طلبك قيد المراجعة
                    </h2>

                    <p>
                        تم استلام طلبك بنجاح، وسيقوم فريق الإدارة
                        بمراجعته في أقرب وقت ممكن.
                    </p>

                    <div class="status-meta">

                        <span>
                            <i class="bi bi-clock"></i>
                            تم إرسال الطلب
                        </span>

                        <span>
                            <i class="bi bi-shield-check"></i>
                            بانتظار مراجعة الإدارة
                        </span>

                    </div>

                </div>

            </section>
        @elseif ($application->status === 'approved')
            <!-- Approved Application -->
            <section class="application-status-card approved">

                <div class="status-icon">
                    <i class="bi bi-check-circle"></i>
                </div>

                <div class="status-content">

                    <span class="status-label">
                        تم القبول
                    </span>

                    <h2>
                        تهانينا! تم قبول طلبك
                    </h2>

                    <p>
                        أصبحت الآن مؤهلًا لاستخدام صلاحيات منشئ المحتوى
                        والمساهمة في بناء المسارات التعليمية على المنصة.
                    </p>

                    <a href="#" class="creator-btn">
                        الانتقال إلى لوحة المنشئ
                        <i class="bi bi-arrow-left"></i>
                    </a>

                </div>

            </section>
        @elseif ($application->status === 'rejected')
            <!-- Rejected Application -->
            <section class="application-status-card rejected">

                <div class="status-icon">
                    <i class="bi bi-x-circle"></i>
                </div>

                <div class="status-content">

                    <span class="status-label">
                        لم تتم الموافقة
                    </span>

                    <h2>
                        لم تتم الموافقة على طلبك
                    </h2>

                    <p>
                        لم يتم قبول طلبك الحالي ليصبح حسابك حساب منشئ محتوى.
                        يمكنك التقدم بطلب جديد إذا كنت ترغب في المحاولة مرة أخرى.
                    </p>


                    <form action="{{ route('learner.creator-application.store') }}" method="POST">

                        @csrf

                        <button type="submit" class="apply-again-btn">
                            التقديم مرة أخرى
                            <i class="bi bi-arrow-left"></i>
                        </button>

                    </form>

                </div>

            </section>
        @endif

    </main>
@endsection

@section('footer')
    @include('components.footers.home-footer')
@endsection
