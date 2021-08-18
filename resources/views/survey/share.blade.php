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
                <div class="col-md-10 offset-1 text-center">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h3>Share {{ $survey->title }} Survey</h3>
                        </div>
                        <form action="" id="emailForm" method="post">
                            <div class="card-body">
                                <select name="emails" class="studentSearch w-100"></select>
                            </div>
                            <button class="btn btn-outline-primary" type="submit">
                                Submit
                            </button>
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
                    data: ({ term }) => { return { search: term, _token: _token } },
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
            });
        });
    </script>
</body>

</html>
