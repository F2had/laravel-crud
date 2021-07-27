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

   @include('header')

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
                            <td style="text-align:center">
                                <a href="/chart/{{ $course->id }}/?by=country" rel="noopener noreferrer">By
                                    Country</a>
                                | <a href="/chart/{{ $course->id }}/?by=state" rel="noopener noreferrer">By
                                    State</a>
                                | <a href="/chart/{{ $course->id }}/?by=department" rel="noopener noreferrer">By
                                    Department</a>
                            </td>
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
