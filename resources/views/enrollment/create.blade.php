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

            <h2 class="pt-3">Add a new Enrollment</h2>
            <form action="/enrollment" method="post">
                @csrf





                <div class="mb-3">
                    <label for="student" class="form-label">Student</label>
                    <select name="student" class="form-select form-control" id="student">
                        <option value="" selected disabled>Choose...</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}"> {{ $student->id }} {{ $student->name }}</option>
                        @endforeach
                    </select>
                    @error('student')
                        <div class="error text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="course" class="form-label">Course</label>
                    <select name="course" class="form-select form-control" id="course">
                        <option value="" selected disabled>Choose...</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                    @error('course')
                        <div class="error text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-outline-primary">Add</button>

            </form>
        </div>


    </div>


    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</body>

</html>
