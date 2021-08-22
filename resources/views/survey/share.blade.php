<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Share Survey</title>
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>

    @include('header')
    <div class="container-fluid m-1">
        @include('message')


        <div class="container-fluid p-2">

            <div class="row ">
                <div class="col-md-10 offset-1 ">
                    <div class="card">
                        <div class="card-header bg-dark text-white text-center">
                            <h3>Share {{ $survey->title }} Survey</h3>
                        </div>
                        <form action="" id="emailForm" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $survey->id }}">

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-10">
                                        <select name="emails[]" class="studentSearch w-100"></select>
                                    </div>

                                    <div class="col-2 form-check">
                                        <input type="checkbox" class="form-check-input" name="customMessage"
                                            id="customMessage">
                                        <label class="form-check-label" for="customMessage">Custom
                                            Message</label>
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="col mt-2">
                                        <div class="form-group " id="messageDiv" style="display: none">
                                            <label for="message">Message...</label>
                                            <textarea name="message" class="form-control" id="message"
                                                rows="3"></textarea>
                                        </div>
                                    </div>

                                    <div class="w-100"></div>
                                    <div class="col mt-3">
                                        <button class="btn btn-outline-primary mb-2 ml-2" type="submit">
                                            Share
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>


        </div>



    </div>


    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @include('bootstrap')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        $(document).ready(() => {
            const _token = $('meta[name="csrf-token"]').attr('content');

            $('.studentSearch').select2({
                placeholder: 'Select Student(s)...',
                multiple: true,
                minimumInputLength: 1,
                delay: 250,
                ajax: {
                    url: '/student/search',
                    type: 'POST',
                    dataType: 'json',
                    data: ({
                        term
                    }) => {
                        return {
                            search: term,
                            _token: _token
                        }
                    },
                    processResults: (data) => {
                        return {
                            results: $.map(data, item => {
                                return {
                                    id: item.email,
                                    text: item.name,
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            $('#emailForm').on('submit', (e) => {
                e.preventDefault();
                const data = $('#emailForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '/survey/share',
                    data: data,
                    success: (response) => {
                        console.log(response);
                    },
                    error: (err) => {
                        console.log(err);
                    }
                });

            });

            $("#customMessage").on('change', (e) => {
                const messageDiv = $('#messageDiv').toggle()
                $('#customMessage').is(':checked') ? messageDiv.show() : messageDiv.hide();
            });
        });
    </script>
</body>

</html>
