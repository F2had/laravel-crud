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


        <div>
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

            <!--  -->
            <div class="row d-flex justify-content-center mt-2">

                @foreach ($courses as $course)

                    <div class="col-6">

                        <div class="card shadow mb-4">

                            <div class="card-header py-2 d-flex justfiy-content-center ">

                                <button class="btn btn-link text-center" data-toggle="collapse"
                                    data-target="#{{ str_replace(' ', '', $course->name) }}">
                                    <h6 class="m-0 font-weight-bold text-primary ">{{ $course->name }}</h6>
                                </button>

                            </div>


                            <div id="{{ str_replace(' ', '', $course->name) }}" class="collapse">

                                <div class="card-body">

                                    <div class="table-responsive" id="">

                                        <table class="table table-bordered" id="" width="100%" cellspacing="0">

                                            <thead>
                                                <tr>
                                                    <th scope="col">Name</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($course->students as $student)
                                                    <tr>
                                                        <td>{{ $student->name }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="w-100"></div>

                @endforeach


            </div>
            <!--  -->
        </div>


    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {

        });
    </script>
</body>

</html>
