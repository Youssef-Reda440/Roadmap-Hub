<footer class="saas-footer">
    <div class="saas-footer-container">
        <div class="saas-footer-grid">
            {{-- Brand --}}
            <div class="saas-footer-brand">
                <a href="{{ route('home.index') }}" class="brand-header">
                    <div class="brand-logo">
                        <img src="{{ asset('assets/logo.ico') }}" width="56" height="56" alt="Roadmap Hub Logo">
                    </div>

                    <span class="brand-text">Roadmap Hub</span>
                </a>

                <p>
                    منصة تعليمية عربية حديثة توفر مسارات تعليمية تقنية متكاملة ومحكمة،
                    تم إعدادها بواسطة نخبة من الخبراء وصناع المحتوى، لمساعدتك على بدء
                    رحلتك واحتراف مجالك بالسرعة والأسلوب المناسبين لك.
                </p>
            </div>

            {{-- Quick Links --}}
            <div class="saas-footer-col">
                <h4 class="no-accent">روابط سريعة</h4>

                <ul>
                    <li>
                        <a href="{{ route('home.index') }}">
                            الرئيسية
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('roadmaps.index') }}">
                            استكشف المسارات
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('categories.index') }}">
                            كل التصنيفات
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('home.index') }}#how-it-works">
                            كيف تبدأ التعلم
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Popular Categories --}}
            <div class="saas-footer-col">
                <h4 class="no-accent">أشهر المسارات</h4>

                <ul>
                    <li>
                        <a href="{{ route('roadmaps.index', ['category' => 'web']) }}">
                            تطوير الويب (Full-Stack)
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('roadmaps.index', ['category' => 'ai']) }}">
                            الذكاء الاصطناعي و ML
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('roadmaps.index', ['category' => 'mobile']) }}">
                            تطبيقات الموبايل
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('roadmaps.index', ['category' => 'devops']) }}">
                            DevOps والحوسبة السحابية
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('roadmaps.index', ['category' => 'cybersecurity']) }}">
                            الأمن السيبراني
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Footer Bottom --}}
        <div class="saas-footer-bottom">
            <div class="saas-footer-bottom-copy">
                جميع الحقوق محفوظة &copy; {{ date('Y') }}
                لمنصة <strong>Roadmap Hub</strong>
            </div>
        </div>
    </div>
</footer>
