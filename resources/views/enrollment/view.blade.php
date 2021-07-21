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

    @include('header')

    <div class="container">
        @include('message')

        <div>

            <h2 class="pt-3">Student Enrollments</h2>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>{{ $student->name }}</th>
                    </tr>
                </thead>
                <tbody>

                    @if (!$student->courses->isEmpty())
                        @foreach ($student->courses as $studentCourses)
                            <tr>
                                <td>{{ $studentCourses->name }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>Not enrolled in any subject(s)</td>
                        </tr>
                    @endif


                </tbody>
            </table>


        </div>


    </div>


    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</body>

</html>
