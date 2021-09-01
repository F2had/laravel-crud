<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reports</title>
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
</head>

<body>

    @include('header')
    <div class="container-fluid m-1">
        @include('message')
        <hr>

        <div class="container p-2">
            <form action="/report" method="post">
                @csrf
                <div class="row d-flex justify-content-center pt-3">
                    <div class="col-12 d-flex justify-content-center">
                        <select class="custom-select" name="age" id="age">
                            <option disabled selected value="">Select age</option>
                            @foreach ($ages as $age)
                                <option value="{{ $age->age }}">{{ $age->age }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 d-flex justify-content-center pt-3">
                      
                        <select  class="custom-select" name="department" id="departemt">
                            <option selected disabled value="">Select department</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->department }}">{{ $department->department }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-12 d-flex justify-content-center pt-3">
                        <select class="custom-select" name="country" id="country">
                            <option selected disabled value="">Select Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->country }}">{{ $country->country }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button class="btn btn-outline-primary m-2" type="submit">Submit</button>
            </form>
        </div>



    </div>


    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


</body>

</html>
