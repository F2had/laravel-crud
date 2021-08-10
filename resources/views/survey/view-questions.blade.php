<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Survey </title>
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>

<body>

    @include('header')
    <div class="container-fluid m-1">
        @include('message')
        <hr>

        <div class="container-fluid p-2">




            <div class="row" id="surveyRow">

                <div class="col-12 d-flex justify-content-center">
                    <div class="card" style="width: 50%;">
                        <div class="card-header" style="background-color: #6610f2"></div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $survey->title }}</h5>
                            <h6 class="card-subtitle mb-2 ">Code : {{ $survey->code }}</h6>
                            <label for="exampleFormControlTextarea1">Survey Description</label>
                            <p class="card-text">{{ $survey->description }}</p>
                        </div>
                    </div>
                </div>

                @for ($i = 0; $i < sizeof($survey->details); $i++)
                    <div class="col-12 d-flex justify-content-center p-4 question">
                        <div class="card survey-q" style="width: 50%;">
                            <div class="card-header">
                                Question {{ $i + 1 }}
                                <div class="float-right">
                                    <a href="/survey/update/question/{{ $survey->details[$i]->id }}">
                                        <div class="btn btn-primary">
                                            <i class="las la-edit"></i>
                                        </div>
                                    </a>

                                    <form action="/survey/question-delete/{{ $survey->details[$i]->id }}"
                                        method="post" class="d-inline m-0 p-0 ">
                                        @method('delete')
                                        @csrf
                                        <button type="button" class="btn btn-danger delete-question"><i
                                                class="las la-trash-alt "></i></button>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <p class="card-text">{{ $survey->details[$i]->question }}</p>
                                </div>
                                <div class="mb-3">
                                    <p class="card-text">

                                        @if ($survey->details[$i]->answer_type == 1)
                                            Scale(1-10)
                                        @elseif( $survey->details[$i]->answer_type == 2)
                                            Bad-Excellent
                                        @elseif( $survey->details[$i]->answer_type == 3)
                                            Comment
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor



            </div>
            <div class="d-flex justify-content-center">
                <button type="" id="addBtn" class="btn btn-outline-success"> <i
                        class="las la-plus-circle la-lg"></i></button>
            </div>
            <div class="d-flex justify-content-center m-4">
                <button id="updateBtn" type="submit" class="float-right btn btn-success">Update survey</button>
            </div>


        </div>



    </div>


    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @include('bootstrap')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {

        let questionDiv = ` <div class="col-12 d-flex justify-content-center p-4 new-question">
        <div class="card" style="width: 50%;">
            <div class="card-header">
                Question 1
            </div>
            <div class="card-body">
                <div class="mb-3 questionInput">
                    <input type="text" name="" class="form-control" id="" aria-describedby="queston text "
                        placeholder="Question">
                </div>
                <div class="mb-3 select">
                    <select class="custom-select" name="q-type" aria-label="question type">
                        <option disabled selected>Answer type</option>
                        <option value="1">Scale(1-10)</option>
                        <option value="2">Bad-Excellent</option>
                        <option value="3">Comment</option>
                    </select>
                </div>
                <div class="float-right deleteCard">
                    <div class="btn btn-outline-danger">
                        <i class="las la-trash-alt la-lg"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>`;


        let addBtn = $('#addBtn');
        let surveyRow = $('#surveyRow');
        let questionNO = {{ sizeof($survey->details) }}
        const surveyQuestions = []

        $(addBtn).on('click', (e) => {
            e.preventDefault();
            surveyRow.append(questionDiv);
            updateQuestions()
        });

        const updateQuestions = () => {

            $('.new-question').each(function(i, obj) {
                let header = $(this).find('.card-header').text(
                    `Question ${i + questionNO +1}`);

                $(this).find('input').attr('name', `q${i + questionNO +1}`);

            });

        }

        $('body').on('click', '.deleteCard', (e) => {
            $(e.target).closest('.new-question').remove()
            updateQuestions();
        })

        $('body').on('click', '.delete-question', (e) => {
            e.preventDefault()
            let form = $(e.target).closest('form');
            Swal.fire({
                title: 'Do you want to delete this question?',
                showCancelButton: true,
                confirmButtonText: `Confirm`,
                denyButtonText: `Cancel`,
            }).then((result) => {
             
                if (result.isConfirmed) {

                    let response = form.submit();

                }
            })
        });

        $('body').on('click', '#updateBtn', async (e) => {
            e.preventDefault();

            if (surveyQuestions.length) surveyQuestions.length = 0;

            getQuestions()
            if (!surveyQuestions.length) return null;


            let data = {
                questions: surveyQuestions,
                "_token": "{{ csrf_token() }}",
                "hdr_id": "{{ $survey->id }}"
            }

            $.ajax({
                url: '/survey/add/questions',
                type: 'POST',
                async: true,
                contentType: 'application/json',
                data: JSON.stringify(data),
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        Swal.fire(
                            'Created!',
                            'Your questions has been added successfully.',
                            'success'
                        ).then((result) => {
                            window.location.replace("/survey");
                        }).catch((err) => {
                            console.log('Error => ', err);
                        });
                    } else {
                        if (response.error) {

                            errors = ''
                            Object.keys(response.error).forEach(key => {
                                errors += response.error[key] + '<br>'
                            })
                            Swal.fire(
                                'Error!',
                                `${errors}`,
                                'error'
                            )
                        }
                    }

                }
            });

        })
        const getQuestions = () => {
            $('.new-question').each(function(i, obj) {
                if ($(this).find('input').val()) {
                    let questionDetails = {
                        sequence: i + questionNO + 1,
                        question: $(this).find('input').val(),
                        answerType: $(this).find('select').val()
                    }
                    surveyQuestions.push(questionDetails)
                }

            });
        }
        });
       
    </script>
</body>

</html>
