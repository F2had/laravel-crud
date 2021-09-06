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
        <div>

        </div>
        <div class="container p-2">
            <?php
            $path = config_path('reportico.php');
            require_once $path;
            
            $engine = App::make('getReporticoEngine');
            $engine->initial_execute_mode = 'PREPARE';
            $engine->access_mode = 'ONEPROJECT';
            $engine->initial_report = 'students.xml';
            $engine->clear_reportico_session = true;
            $engine->execute();
            ?>

            

        </div>



    </div>


    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


</body>

</html>
