<footer class="bg-dark text-light mt-auto">
    <div class="container py-5">
        <div class="row g-4">
            {{-- About --}}
            <div class="col-12 col-md-6 col-lg-3">
                <h5 class="fw-bold mb-3">Roadmap Hub</h5>
                <p class="text-light-emphasis mb-0">
                    Learn any field through structured learning roadmaps
                    and trusted resources.
                </p>
            </div>

            {{-- Explore --}}
            <div class="col-6 col-md-6 col-lg-2">
                <h6 class="fw-bold mb-3">Explore</h6>

                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <a href="{{ route('roadmaps.index') }}" class="text-light text-decoration-none">
                            Roadmaps
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="{{ route('categories.index') }}" class="text-light text-decoration-none">
                            Categories
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Social --}}
            <div class="col-6 col-md-6 col-lg-3">
                <h6 class="fw-bold mb-3">Follow Us</h6>

                <div class="d-flex gap-3">
                    <a href="https://github.com/Youssef-Reda440/Roadmap-Hub" target="_blank" rel="noopener noreferrer" class="text-light fs-5"
                        aria-label="GitHub">
                        <i class="fa-brands fa-github"></i>
                    </a>

                    <a href="https://www.linkedin.com/in/youssef-reda-aa079a33b" target="_blank" rel="noopener noreferrer" class="text-light fs-5"
                        aria-label="LinkedIn">
                        <i class="fa-brands fa-linkedin"></i>
                    </a>
                </div>
            </div>
        </div>

        <hr class="border-secondary my-4">

        {{-- Bottom --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <p class="mb-0 text-light-emphasis">
                © 2026 Roadmap Hub. All rights reserved.
            </p>
        </div>
    </div>
</footer>
