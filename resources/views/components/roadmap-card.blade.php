<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="card h-100 shadow-sm border-0">

        {{-- Card Header / Image --}}
        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
            <span class="text-muted">
                <img src="{{ asset('images/roadmaps/frontend.png') }}" class="card-img-top" alt="Frontend Development">
            </span>
        </div>

        <div class="card-body d-flex flex-column">

            {{-- Category --}}
            <span class="badge bg-primary align-self-start mb-2">
                Web Development
            </span>

            {{-- Title --}}
            <h5 class="card-title fw-bold">
                Frontend Development
            </h5>

            {{-- Description --}}
            <p class="card-text text-muted">
                Learn frontend development from HTML and CSS to
                JavaScript and modern web development.
            </p>

            {{-- Meta --}}
            <div class="d-flex flex-wrap gap-2 mb-3">
                <span class="badge bg-light text-dark border">
                    Beginner
                </span>

                <span class="badge bg-light text-dark border">
                    3 Months
                </span>
            </div>

            {{-- Creator --}}
            <div class="d-flex align-items-center gap-2 mb-3">
                <div class="rounded-circle bg-secondary" style="width: 35px; height: 35px;">
                </div>

                <div>
                    <small class="text-muted d-block">
                        Created by
                    </small>

                    <span class="fw-semibold">
                        Ahmed Mohamed
                    </span>
                </div>
            </div>

            {{-- Rating --}}
            <div class="d-flex align-items-center gap-2 mb-3">
                <span class="fw-bold">
                    4.8
                </span>

                <span class="text-warning">
                    ★★★★★
                </span>

                <small class="text-muted">
                    (124 reviews)
                </small>
            </div>

            {{-- Action --}}
            <a href="#" class="btn btn-primary mt-auto">
                View Roadmap
            </a>

        </div>
    </div>
</body>

</html>
