<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Survey</title>
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>

<body>

    @include('header')
    <div class="container-fluid m-1">
        @include('message')
        <hr>

        <div class="container-fluid p-2">
            <form action="" method="post">
                @csrf



                <div class="row" id="surveyRow">

                    <div class="col-12 d-flex justify-content-center">
                        <div class="card" style="width: 50%;">
                            <div class="card-header" style="background-color: #6610f2"></div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <input type="text" name="survey-hdr" class="form-control " id="surveyHeader"
                                        aria-describedby="survey Header" style="font-weight: bold"
                                        placeholder="Survey Header...">
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="survey-code" class="form-control " id="surveyCode"
                                        aria-describedby="survey Header" placeholder="Survey code...">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Survey Description</label>
                                    <textarea name="survey-desc" class="form-control" id="exampleFormControlTextarea1"
                                        rows="1"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-center p-4 question">
                        <div class="card" style="width: 50%;">
                            <div class="card-header">
                                Question 1
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <input type="text" name="q1" class="form-control " id="q1"
                                        aria-describedby="queston text " placeholder="Question">
                                </div>
                                <div class="mb-3">
                                    <select class="custom-select" name="q1-type" aria-label="question type">
                                        <option disabled selected>Answer type</option>
                                        <option value="1">Scale(1-10)</option>
                                        <option value="2">Bad-Excellent</option>
                                        <option value="3">Comment</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="d-flex justify-content-center">
                    <button type="" id="addBtn" class="btn btn-outline-success"> <i
                            class="las la-plus-circle la-lg"></i></button>
                </div>
                <div class="d-flex justify-content-center m-4">
                    <button class="float-right btn btn-success">Save survey</button>
                </div>
            </form>

        </div>



    </div>


    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @include('bootstrap')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            let questionDiv = ` <div class="col-12 d-flex justify-content-center p-4 question">
                        <div class="card" style="width: 50%;">
                         <div class="card-header">
                                Question 1
                            </div>
                            <div class="card-body">
                                <div class="mb-3 questionInput">
                                    <input type="text" name="" class="form-control" id=""
                                        aria-describedby="queston text " placeholder="Question">
                                </div>
                                <div class="mb-3 select">
                                    <select class="custom-select" name="q-type" aria-label="question type">
                                        <option disabled selected>Answer type</option>
                                        <option value="1">Scale(1-10)</option>
                                        <option value="2">Bad-Excellent</option>
                                        <option value="3">Comment</option>
                                    </select>
                                </div>
                                
                              </div>
                        </div>

                    </div>`;
            let removeButton =
                ` <div id="deleteQuestion" class="float-right">
                <div   class="btn btn-outline-danger"> 
                <i class="las la-trash-alt la-lg"></i>
                </div>
                </div>`;
            let addBtn = $('#addBtn');
            let removeQuestion = $('#deleteQuestion');
            let surveyRow = $('#surveyRow');
            let questions = $('.question');
            const surveyQuestions = []

            $(addBtn).on('click', (e) => {
                e.preventDefault();
                surveyRow.append(questionDiv);
                updateQuestions()
            });

            const updateQuestions = () => {

                $('.question').each(function(i, obj) {

                    $(this).find('.card-header').text(`Question ${i +1}`);
                    // $(this).find('input').attr('name', `q${i+1}`);

                    //Assign delete button to the last questions card only
                    if (i == $('.question').length - 1) {
                        $(this).find('.select').after(removeButton)
                    } else {
                        $(this).find('#deleteQuestion').remove();
                    }
                });
            }

            $('body').on('click', '#deleteQuestion', (e) => {
                $(deleteQuestion).closest('.question').remove();
                updateQuestions()
            })

            $('body').on('submit', 'form', async (e) => {
                e.preventDefault();
                if (surveyQuestions.length) surveyQuestions.length = 0;
                //TODO move to a func
                getQuestions();

                let header = $('input[name=survey-hdr]').val();
                let code = $('input[name=survey-code]').val();
                let description = $('textarea[name="survey-desc"]').val();
                let data = {
                    header: header,
                    code: code,
                    desc: description,
                    questions: surveyQuestions,
                    "_token": "{{ csrf_token() }}",
                }

                $.ajax({
                    url: '/survey',
                    type: 'POST',
                    async: true,
                    contentType: 'application/json',
                    data: JSON.stringify(data),
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Created!',
                                'Your survey is created successfully.',
                                'success'
                            ).then((result) => {
                                window.location.replace("/survey");
                            }).catch((err) => {
                                console.log('Error => ', err);
                            });
                        } else {
                            console.log(response)
                            if (response.error) {

                                errors = ''
                                Object.keys(response.error).forEach(key => {
                                    errors += response.error[key]
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

            });

            const getQuestions = () => {
                $('.question').each(function(i, obj) {
                    //Skip questions without an input/empty.
                    if ($(this).find('input').val()) {
                        let questionDetails = {
                            sequence: i + 1,
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
