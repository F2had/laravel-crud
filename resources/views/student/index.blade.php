<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Students</title>
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
                            <a class="nav-link active" aria-current="page" href="#">Student</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/course">Course</a>
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
        @include('message')
        <hr>


        <div class="table-responsive pt-3">

            <div class="table-wrapper">

                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage <b>Students</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="/student/create" class="btn btn-success"><i class="las la-plus"></i> <span>Add New
                                    Student</span></a>
                        </div>
                    </div>

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Department</th>
                                <th>Address</th>
                                <th>State</th>
                                <th>Country</th>
                                <th>Nationality</th>
                                <th>Enrollmnets</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($students as $student)
                                <tr>

                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->phone }}</td>
                                    <td>{{ $student->department }}</td>
                                    <td>{{ $student->address }}</td>
                                    <td>{{ $student->state }}</td>
                                    <td>{{ $student->country }}</td>
                                    <td>{{ $student->nationality }}</td>
                                    <td><a href="/enrollment/{{ $student->id }}">
                                            View
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/student/edit/{{ $student->id }}" class="edit"><i
                                                class="las la-edit la-2x"></i></a>
                                        <form action="/student/{{ $student->id }}" method="post"
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
