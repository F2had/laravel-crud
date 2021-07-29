<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Charts</title>
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>

<body>

    @include('header')
    <main>

        <div class="containter ">
            <div class="d-flex justify-content-center h-100">
                <div class="w-25 h-50">
                    <h4 class="text-center">{{ $course->name }}</h4>
                    <canvas id="myChart" width="400" height="400"></canvas>
                </div>
            </div>
            <div class="row d-flex justify-content-center mt-5" id="grid">
                <div class="col-6 text-center">
                   Hello
                </div>
            </div>

        </div>
    </main>

    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.4.1/dist/chart.min.js"></script>

    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
