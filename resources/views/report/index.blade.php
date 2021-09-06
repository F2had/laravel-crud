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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


</head>

<body>

    @include('header')
    <div class="container-fluid m-1">
        @include('message')
        <hr>

        <div class="container p-2">
            <form id="formID" action="/reportico/ajax" method="post">
                @csrf

                <div class="row">

                    <div class="col">
                        <select class="custom-select" id="project">
                            <option selected disabled>Select Project</option>
                            @foreach ($projects as $prject)
                                <option value="{{ $prject }}">{{ ucwords($prject) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-100"></div>
                    <div class="col py-2">
                        <select class="custom-select" id="report">
                            <option selected disabled>Select Report</option>
                            @foreach ($reports as $report)
                                <option value="{{ $report }}">{{ ucwords($report) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-100"></div>
                    <div class="col py-2">
                        <select class="custom-select" name="DIRECT_age[]" id="" multiple>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                        </select>
                    </div>
                    <div class="w-100"></div>
                    <div class="col form-group">
                        <input class="form-control" type="text" name="MANUAL_daterange" id="date"
                            placeholder="Date Range">
                    </div>

                    <div class="w-100"></div>
                    <div class="col">

                        <select class="custom-select" name="MANUAL_country" multiple>
                            <option value="Côte d'Ivoire (Ivory Coast)">Côte d'Ivoire (Ivory Coast)</option>
                            <option value="Japan">Japan</option>
                            <option value="USA">USA</option>
                            <option value="Australia">Australia</option>
                            <option value="France">France</option>
                        </select>
                    </div>

                    <div class="w-100"></div>
                    <div class="col py-2">

                        <select class="custom-select" name="target_format">
                            <option value="PDF">PDF</option>
                            <option value="CSV">CSV</option>
                        </select>
                    </div>

                </div>

                <button class="btn btn-outline-primary m-2" type="submit">Submit</button>
            </form>
        </div>



    </div>


    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        // $('#project').on('change', (e) => {
        //     let project = $('#project').find(":selected").val();
        //     console.log('Selected', project);
        // });
        $('#formID').on('submit', (e) => {
            e.preventDefault();

            let project = $('#project').find(":selected").val();
            let report = $('#report').find(":selected").val();
            let myForm = document.getElementById('formID');
            const queryString = new URLSearchParams(new FormData(myForm)).toString();
            
            window.open(
                `${window.location.origin}/reportico/execute/${project}/${report}?${queryString}`,
                '_parent');
          


        });
        let a = flatpickr("#date", {
            mode: 'range',
            onChange: function(selectedDates, datestr) {
                let formattedDate = datestr.replace('to', '-');
                $("#date").val(formattedDate)
            }
        });
    </script>


</body>


</html>
