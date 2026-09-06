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
    <div class="container">
        <div class="row g-4">

            <div class="col-12 col-md-6 col-lg-4">
                @include('components.roadmap-card')
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                @include('components.roadmap-card')
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                @include('components.roadmap-card')
            </div>

        </div>
    </div>
</body>

</html>
