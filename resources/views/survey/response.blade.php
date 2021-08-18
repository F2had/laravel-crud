<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Response {{ $survey->title }}
    </title>
</head>

<body>

    <div class="container-fluid m-1">

        @if ($survey->isOpen)
            <div class="container-fluid p-2">

                @if (!$survey)
                    <div class="d-flex justify-content-center m-4">
                        <p>Invalid URL</p>
                    </div>

                @else

                    <form action="/survey/response" id="responseForm" method="post">
                        @csrf
                        <input type="hidden" name="numberOfQuestions" value="{{ sizeof($survey->details) }}">
                        <input type="hidden" name="surveyID" value="{{ $survey->id }}">
                        <div class="row" id="responseRow">

                            <div class="col-12 d-flex justify-content-center">
                                <div class="card" style="width: 50%;">
                                    <div class="card-header" style="background-color: #6610f2"></div>
                                    <div class="card-body">
                                        <h4 class="card-title">{{ $survey->title }}</h4>
                                        <p class="card-text">{{ $survey->description }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-center p-4 question">
                                <div class="card w-50">
                                    <div class="card-header">
                                        Name
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-12 d-flex justify-content-center p-4 question">
                                <div class="card w-50">
                                    <div class="card-header">
                                        Email
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            @foreach ($survey->details as $detail)
                                <div class="col-12 d-flex justify-content-center p-4 question">
                                    <div class="card" style="width: 50%;">
                                        <div class="card-header">
                                            {{ $detail->question }}
                                        </div>
                                        <div class="card-body">

                                            @if ($detail->answer_type === 1)


                                                <div class="row">

                                                    <div class="ml-5 col-1 answer">
                                                        <label class="form-check-label">1</label>
                                                        <div class="w-100"></div>
                                                        <div class="form-check form-check-inline">
                                                            <input name="question{{ $detail->sequence }}"
                                                                data-answerType="1" class="form-check-input "
                                                                type="radio" value="1">
                                                        </div>
                                                    </div>

                                                    <div class="col-1 answer">
                                                        <label class="form-check-label">2</label>
                                                        <div class="w-100"></div>
                                                        <div class="form-check form-check-inline">
                                                            <input name="question{{ $detail->sequence }}"
                                                                class="form-check-input " type="radio"
                                                                data-answerType="1" value="2">
                                                        </div>
                                                    </div>

                                                    <div class="col-1 answer">
                                                        <label class="form-check-label">3</label>
                                                        <div class="w-100"></div>
                                                        <div class="form-check form-check-inline">
                                                            <input name="question{{ $detail->sequence }}"
                                                                class="form-check-input " type="radio"
                                                                data-answerType="1" value="3">
                                                        </div>
                                                    </div>

                                                    <div class="col-1 answer">
                                                        <label class="form-check-label">4</label>
                                                        <div class="w-100"></div>
                                                        <div class="form-check form-check-inline">
                                                            <input name="question{{ $detail->sequence }}"
                                                                class="form-check-input " data-answerType="1"
                                                                type="radio" value="4">
                                                        </div>
                                                    </div>
                                                    <div class="col-1 answer">
                                                        <label class="form-check-label">5</label>
                                                        <div class="w-100"></div>
                                                        <div class="form-check form-check-inline">
                                                            <input name="question{{ $detail->sequence }}"
                                                                class="form-check-input" data-answerType="1"
                                                                type="radio" value="5">
                                                        </div>
                                                    </div>
                                                    <div class="col-1 answer">
                                                        <label class="form-check-label">6</label>
                                                        <div class="w-100"></div>
                                                        <div class="form-check form-check-inline">
                                                            <input name="question{{ $detail->sequence }}"
                                                                class="form-check-input" data-answerType="1"
                                                                type="radio" value="6">
                                                        </div>
                                                    </div>

                                                    <div class="col-1 answer">
                                                        <label class="form-check-label">7</label>
                                                        <div class="w-100"></div>
                                                        <div class="form-check form-check-inline">
                                                            <input name="question{{ $detail->sequence }}"
                                                                class="form-check-input" data-answerType="1"
                                                                type="radio" value="7">
                                                        </div>
                                                    </div>
                                                    <div class="col-1 answer">
                                                        <label class="form-check-label">8</label>
                                                        <div class="w-100"></div>
                                                        <div class="form-check form-check-inline">
                                                            <input name="question{{ $detail->sequence }}"
                                                                class="form-check-input " type="radio"
                                                                data-answerType="1" value="8">
                                                        </div>
                                                    </div>

                                                    <div class="col-1 answer">
                                                        <label class="form-check-label">9</label>
                                                        <div class="w-100"></div>
                                                        <div class="form-check form-check-inline">
                                                            <input name="question{{ $detail->sequence }}"
                                                                class="form-check-input " type="radio"
                                                                data-answerType="1" value="9">
                                                        </div>
                                                    </div>

                                                    <div class="col-2 answer">
                                                        <label class="form-check-label">10</label>
                                                        <div class="w-100"></div>
                                                        <div class="form-check form-check-inline">
                                                            <input name="question{{ $detail->sequence }}"
                                                                class="form-check-input " type="radio"
                                                                data-answerType="1" value="10">
                                                        </div>
                                                    </div>

                                                </div>

                                            @elseif ($detail->answer_type === 2)

                                                <div class="row">

                                                    <div class="ml-3  m-2 col-2 answer">
                                                        <label class="form-check-label">Poor</label>
                                                        <div class="w-100"></div>
                                                        <div class="form-check form-check-inline">
                                                            <input name="question{{ $detail->sequence }}"
                                                                class="form-check-input " type="radio"
                                                                data-answerType="2" value="poor">
                                                        </div>
                                                    </div>

                                                    <div class="col-2 m-2 answer">
                                                        <label class="form-check-label">Fair</label>
                                                        <div class="w-100"></div>
                                                        <div class="form-check form-check-inline">
                                                            <input name="question{{ $detail->sequence }}"
                                                                class="form-check-input" type="radio"
                                                                data-answerType="2" value="fair">
                                                        </div>
                                                    </div>

                                                    <div class="col-2 m-2 answer">
                                                        <label class="form-check-label">Good</label>
                                                        <div class="w-100"></div>
                                                        <div class="form-check form-check-inline">
                                                            <input name="question{{ $detail->sequence }}"
                                                                class="form-check-input" type="radio"
                                                                data-answerType="2" value="good">
                                                        </div>
                                                    </div>

                                                    <div class="col-2 m-2 answer">
                                                        <label class="form-check-label">Very Good</label>
                                                        <div class="w-100"></div>
                                                        <div class="form-check form-check-inline">
                                                            <input name="question{{ $detail->sequence }}"
                                                                class="form-check-input" type="radio"
                                                                data-answerType="2" value="verygood">
                                                        </div>
                                                    </div>

                                                    <div class="col-2 m-2 answer">
                                                        <label class="form-check-label">Excellent</label>
                                                        <div class="w-100"></div>
                                                        <div class="form-check form-check-inline">
                                                            <input name="question{{ $detail->sequence }}"
                                                                class="form-check-input" type="radio"
                                                                data-answerType="2" value="excellent">
                                                        </div>
                                                    </div>

                                                </div>

                                            @elseif ($detail->answer_type === 3)
                                                <div class="form-group answer">
                                                    <textarea name="question{{ $detail->sequence }}"
                                                        data-answerType="3" class="form-control" id=""
                                                        rows="1"></textarea>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                            @endforeach



                        </div>

                        <div class="d-flex justify-content-center m-4">
                            <button id="submitBtn" type="submit" class="float-right btn btn-success">Send
                                Response</button>
                        </div>
                    </form>
                @endif

            </div>
        @else
            <div class="d-flex justify-content-center">
                <p class="m-5">Currently this survey is not accepting any responses</p>
            </div>
        @endif



    </div>



    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @include('bootstrap')
    <script>
        $(document).ready(function() {
            const startDate = new Date().toISOString();


            $('#responseForm').on('submit', async (e) => {
                e.preventDefault();
                const endDate = new Date().toISOString();
                const start_end_date = `&start_date=${startDate}&end_date=${endDate}`;

                let data = $('#responseForm').serialize();
                data += start_end_date;


                $.ajax({
                    url: '/survey/response',
                    type: 'POST',
                    async: true,
                    data: data,
                    success: (res) => {
                        if (res.success) {
                            successMessage();
                        }
                    },
                    error: (err) => {
                        console.log(err)
                    }
                });

            });

            const successMessage = () => {
                $('body .container-fluid').html(`<div class="container-flud" >
                            <div class="d-flex justify-content-center m-4" >
                            <p class="d-flex justify-content-center m-4">Your response has been recorded successfully. 
                            <br>
                            &#10;
                            
                            <a href="javascript:window.location.href=window.location.href">Submit another response.</a>  </p> 
                          </div>
                            </div>`);
            }
        });
    </script>
</body>

</html>
