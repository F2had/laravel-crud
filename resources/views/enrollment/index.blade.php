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

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="/student">Student</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/course">Course</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/enrollment">Enrollment</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/logout"><span
                                    class="text-danger">Logout</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
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
