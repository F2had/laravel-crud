<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Courses</title>
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
                            <a class="nav-link" aria-current="page" href="/student">Student</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/course">Course</a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/enrollment">Enrollment</a>
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

        <div class="container text-center">
            <div>
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="table-responsive pt-3">

            <div class="table-wrapper">

                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage <b>Courses</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="/course/create" class="btn btn-success"><i class="las la-plus"></i> <span>Add New
                                    Course</span></a>
                        </div>
                    </div>

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Credit</th>
                                <th>Department</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($courses as $course)
                                <tr>

                                    <td>{{ $course->id }}</td>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ $course->credit }}</td>
                                    <td>{{ $course->department }}</td>
                                    <td>
                                        <a href="course/edit/{{ $course->id }}" class="d-inline  m-0 p-0"><i
                                                class="las la-edit la-2x"></i></a>
                                        <form action="/course/{{ $course->id }}" method="post"
                                            class="d-inline m-0 p-0">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger"><i
                                                    class="las la-trash-alt "></i></button>
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


    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</body>

</html>
