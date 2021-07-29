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

            <div class="d-flex justify-content-center">
                <h3 class="text-cetner">Charts</h3>
            </div>

            <div class="row d-flex justify-content-center">
                <form action="" id="chartForm" method="post">
                    @csrf
                    <div class="col">
                        <div class="input-group mb-3">
                            <select name="course" class="form-select" id="inputGroupSelect01">
                                <option disabled selected>Choose Course</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col">
                        <div class="input-group mb-3">
                            <select name="by" class="form-select" id="inputGroupSelect02">
                                <option disabled selected>Course by</option>
                                <option value="country">Country</option>
                                <option value="state">State</option>
                                <option value="department">Department</option>
                            </select>
                        </div>
                    </div>

                    <button id="submitFormID" type="submit" class="btn btn-primary">Get Chart</button>
                </form>
            </div>

            <div class="row mt-5" id="chartRow">
                <div class="col d-flex justify-content-center">
                    <div id="canvasWrapper" class="w-25 h-50">
                        <canvas id="myChart" width="400" height="400"></canvas>
                    </div>

                </div>
            </div>

            <div class="row d-flex justify-content-center" id="details">
            

            </div>

        </div>

    </main>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.4.1/dist/chart.min.js"></script>

    <script src="{{ asset('js/script.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</body>

</html>
