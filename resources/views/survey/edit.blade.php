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

            <h2>Update a Survey</h2>
            <form action="/survey/update" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $header->id }}">

                <div class="mb-3">
                    <label for="header" class="form-label">Header</label>
                    <input type="text" value="{{ $header->title }}" name="header" class="form-control" id="header">
                    @error('header')
                        <div class="error text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="code" class="form-label">Code</label>
                    <input type="text" value="{{ $header->code }}" name="code" class="form-control" id="code">
                    @error('code')
                        <div class="error text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="Textarea">Survey Description</label>
                    <textarea name="desc" class="form-control" id="Textarea"
                        rows="1">{{ $header->description }}</textarea>
                    @error('desc')
                        <div class="error text-danger">{{ $message }}</div>
                    @enderror
                </div>




                <button type="submit" class="btn btn-outline-primary">Update</button>

            </form>
        </div>


    </div>


    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @include('bootstrap')
</body>

</html>
