<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enrollments</title>
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>

<body>

    @include('header')
    <div class="container-fluid m-1">

        @include('message')
        <hr>


        <div class="table-responsive pt-3">

            <div class="table-wrapper">

                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage <b>Enrollments</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="/enrollment/create" class="btn btn-success"><i class="las la-plus"></i> <span>Add
                                    New
                                    Enrollment</span></a>
                        </div>
                    </div>

                    <table class="table table-striped table-hover">
                        @foreach ($courses as $course)
                            <thead>
                                <tr>
                                    <th style="text-align:center; background-color: rgb(155, 165, 163)">
                                        {{ $course->name }}
                                        ({{ $course->students_count }})</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($course->students as $student)
                                    <tr>
                                        <td style="text-align:center">{{ $student->name }}</td>
                                    </tr>
                                @endforeach





                            </tbody>
                        @endforeach
                    </table>

                </div>

            </div>

        </div>



    </div>


    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</body>

</html>
