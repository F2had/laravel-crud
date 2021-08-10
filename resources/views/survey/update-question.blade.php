<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Survey Question</title>
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>

<body>

    @include('header')
    <div class="container-fluid m-1">
        @include('message')
        <hr>

        <div class="container-fluid p-2">
            <form action="/survey/update/question/{{ $question->id }}" method="post">
                @csrf
                @method('PUT')

                <div class="row" id="surveyRow">



                    <div class="col-12 d-flex justify-content-center p-4">
                        <div class="card" style="width: 50%;">
                            <div class="card-header">
                                Question
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <input type="text" name="question" class="form-control ""
                                        aria-describedby=" queston text " value=" {{ $question->question }}">
                                </div>
                                <div class="mb-3">
                                    <select class="custom-select" name="type" aria-label="question type">

                                        <option {{ $question->answer_type == 1 ? 'selected' : '' }} value="1">
                                            Scale(1-10)</option>
                                        <option {{ $question->answer_type == 2 ? 'selected' : '' }} value="2">
                                            Bad-Excellent</option>
                                        <option {{ $question->answer_type == 3 ? 'selected' : '' }} value="3">Comment
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="d-flex justify-content-center m-4">
                    <button class="float-right btn btn-success">Save Changes</button>
                </div>
            </form>

        </div>



    </div>


    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @include('bootstrap')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</body>

</html>
