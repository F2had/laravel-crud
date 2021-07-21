<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Charts</title>
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
                            <a class="nav-link" aria-current="page" href="/course">Course</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/enrollment">Enrollment</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link " aria-current="page" href="/chart">Charts</a>
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

    <main>

        <div class="contianter p-3">
            <h3>Charts</h3>
            <table class="table table-striped table-hover">
                @foreach ($courses as $course)
                    <thead>
                        <tr>
                            <th style="text-align:center; background-color: rgb(155, 165, 163)">
                                {{ $course->name }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td style="text-align:center"><a href="/chart/{{ $course->id }}/?type=country"
                                    rel="noopener noreferrer">By Country</a></td>
                        </tr>
                        <tr>
                            <td style="text-align:center"><a href="/chart/{{ $course->id }}/?type=state"
                                    rel="noopener noreferrer">By State</a></td>
                        </tr>
                        <tr>
                            <td style="text-align:center"><a href="/chart/{{ $course->id }}/?type=department"
                                    rel="noopener noreferrer">By Department</a></td>
                        </tr>

                    </tbody>
                @endforeach
            </table>
        </div>

    </main>

    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</body>

</html>
