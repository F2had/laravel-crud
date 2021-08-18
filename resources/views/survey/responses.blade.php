<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Survey Responses</title>
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>

<body>

    @include('header')
    <div class="container-fluid m-1">

        <div class="container-fluid">

            <div class="col-12 d-flex justify-content-center">
                <div class="card" style="width: 50%;">
                    <div class="card-header" style="background-color: #6610f2"></div>
                    <div class="card-body">
                        <h4 class="card-title">{{ $survey->title }}</h4>
                        <h6 class="card-subtitle">{{ $survey->code }}</h6>
                        <p class="card-text">{{ $survey->description }}</p>
                    </div>
                    <div class="card-footer text-muted text-center">
                        <a href="{{ $responses->previousPageUrl() }}"><i class="las la-angle-left"></i></a>
                        {{ ($responses->currentpage() - 1) * $responses->perpage() + 1 }} of
                        {{ $responses->total() }} <a href="{{ $responses->nextPageUrl() }}"><i
                                class="las la-angle-right"></i></a>

                    </div>
                </div>
            </div>



            <div class="col-12 d-flex justify-content-center pt-4">
                <div class="card" style="width: 50%;">
                    <div class="card-header">Name</div>
                    <div class="card-body">
                        {{ $answer->name }}
                    </div>
                </div>
            </div>
 
            <div class="col-12 d-flex justify-content-center pt-4">
                <div class="card" style="width: 50%;">
                    <div class="card-header">Email</div>
                    <div class="card-body">
                        {{ $answer->email }}
                    </div>
                </div>
            </div>

            <div class="col-12 d-flex justify-content-center pt-4">
                <div class="card" style="width: 50%;">
                    <div class="card-header">Time Taken in mintues</div>
                    <div class="card-body">
                        {{ $answer->time_taken }}
                    </div>
                </div>
            </div>

            @foreach ($answer->answers as $response)
                <div class="col-12 d-flex justify-content-center pt-4">
                    <div class="card" style="width: 50%;">
                        <div class="card-header">{{ $response->question }}</div>
                        <div class="card-body">
                            <p class="card-text">
                                @if ($response->response)
                                    {{ $response->response }}
                                @else
                                    {{ ucfirst($response->response_detail) }}
                                @endif
                            </p>
                        </div>

                    </div>
                </div>

            @endforeach

        </div>



    </div>


    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</body>

</html>
