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


                <div class="col-6">






                    <div class="card-body">

                        <div class="table-responsive" id="">

                            <table class="table table-bordered" id="" width="100%" cellspacing="0">

                                <thead>
                                    <tr>
                                        <th scope="col">Course name</th>
                                        <th scope="col">Enrolled students</th>
                                    </tr>
                                </thead>
                                @foreach ($courses as $course)

                                    <tbody>

                                        <tr>
                                            <td>{{ $course->name }} </td>
                                            <td><a href="/enrollment/showEnrollment/{{ $course->id }}" target="_blank"
                                                    rel="noopener noreferrer">View</a></td>
                                        </tr>

                                    </tbody>
                                @endforeach

                            </table>
                        </div>


                    </div>





                </div>
                <div class="w-100"></div>



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
</body>

</html>
