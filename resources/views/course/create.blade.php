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
                            <a class="nav-link " aria-current="page" href="/student">Student</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/course">Course</a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/enrollment">Enrollment</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container">

         @include('message')

        <div>

            <h2>Add a new Course</h2>
            <form action="/course" method="post">
                @csrf
                @method('post')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name">
                    @error('name')
                        <div class="error text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="credit" class="form-label">Credit</label>
                    <input type="number" name="credit" class="form-control" id="credit">
                    @error('credit')
                        <div class="error text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="department" class="form-label">Department</label>
                    <input type="text" name="department" class="form-control" id="department">
                    @error('department')
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
