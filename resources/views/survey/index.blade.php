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

        <hr>

        <div class="container-fluid p-2">

            @include('message')
            <div class="table-responsive pt-3">

                <div class="table-wrapper">

                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h2>Manage <b>Surveys</b></h2>
                            </div>
                            <div class="col-sm-6">
                                <a href="/survey/create" class="btn btn-success"><i class="las la-plus"></i>
                                    <span>Create
                                        New
                                        Survey</span></a>
                            </div>
                        </div>

                        <table id="surveyTable" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Header</th>
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>URL</th>
                                    <th>Questions</th>
                                    <th>Action</th>
                                    <th>Accept responses</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($headers as $header)
                                    <tr>
                                        <td>{{ $header->title }}</td>
                                        <td>{{ $header->code }}</td>
                                        <td>{{ $header->description }}</td>
                                        <td>{{ $header->url }}</td>
                                        <td><a href="/survey/show/{{ $header->id }}"
                                                rel="noopener noreferrer">View</a></td>
                                        <td>
                                            <a href="/survey/edit/{{ $header->id }}" class="edit">
                                                <div class="btn btn-primary">
                                                    <i class="las la-edit "></i>
                                                </div>
                                            </a>
                                            <form action="/survey/{{ $header->id }}" method="post"
                                                class="d-inline m-0 p-0">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="las la-trash-alt "></i></button>
                                            </form>

                                        </td>
                                        <td>
                                            <form action="" method="post">
                                                @csrf
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" {{ $header->isOpen ? 'checked' : '' }}
                                                        class="custom-control-input" id="{{ $header->id }}">
                                                    <label class="custom-control-label"
                                                        for="{{ $header->id }}"></label>
                                                </div>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach



                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
        </div>



    </div>


    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(() => {
            $('.custom-switch').on('change', async (e) => {
                e.preventDefault();

                let value = e.target.checked;
                let id = e.target.id

                const response = axios({
                    method: "POST",
                    url: `/survey/isopen-update/${id}`,
                    data: {
                        isOpen: value,
                        _token: '{{ csrf_token() }}'
                    },
                }).then((res) => {
                    console.log(res)
                }).catch(err => {
                    console.log(err.response.data)
                })
            })
        });
    </script>
</body>

</html>
