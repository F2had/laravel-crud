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
                        <h6 class="card-subtitle">{{ $survey->title }}</h6>
                        <p class="card-text">{{ $survey->description }}</p>
                    </div>
                </div>
            </div>

            @foreach ($survey->details as $question)

                <div class="col-12 d-flex justify-content-center pt-4">
                    <div class="card" style="width: 50%;">
                        <div class="card-header">{{ $question->question }}</div>

                        @foreach ($question->responses as $answer)
                            <ul class="list-group list-group-flush">
                                @if ($answer->response_detail)
                                    <li class="list-group-item">{{ $answer->response_detail }}</li>
                                @else
                                    <li class="list-group-item">{{ $answer->response }}</li>
                                @endif
                            </ul>
                        @endforeach

                    </div>
                </div>

            @endforeach

            <div class="col-12 d-flex justify-content-center pt-4">
                <div class="card" style="width: 50%;">
                    <div class="card-header">Time Taken in mintues</div>

                    @foreach ($survey->responses as $answer)
                    
                        <ul class="list-group list-group-flush">
                          
                        <li class="list-group-item">{{ $answer->time_taken }}m</li>

                        </ul>
                    @endforeach

                </div>
            </div>

        </div>



    </div>


    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</body>

</html>
