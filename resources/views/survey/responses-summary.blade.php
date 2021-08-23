<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Survey Responses</title>
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>

<body>

    @include('header')
    <div class="container-fluid m-1">

        <div class="row">

            <div class="col-12 d-flex justify-content-center">
                <div class="card" style="width: 50%;">
                    <div class="card-header" style="background-color: #6610f2"></div>
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }}</h4>
                        <h6 class="card-subtitle">{{ $code }}</h6>
                        <p class="card-text">{{ $desc }}</p>
                    </div>
                </div>
            </div>

            @foreach ($details as $key => $response)

                <div class="col-12 d-flex justify-content-center pt-4">
                    <div class="card" style="width: 50%;">
                        <div class="card-header">{{ $response->question }}</div>
                        @if ($response->answer_type == 3)
                            @foreach ($response->responses as $answer)

                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">{{ $answer->response_detail }}</li>
                                </ul>

                            @endforeach
                        @else
                            @foreach ($response->responses as $answer)
                                <div class="card-body w-50">
                                    <div class="row">
                                        <div class="col-12 offset-6">
                                            <canvas id="question{{ $key + 1 }}" width="200" height="200"></canvas>
                                        </div>
                                    </div>
                                </div>
                            @break
                        @endforeach
            @endif


        </div>
    </div>
    @endforeach

    

    </div>



    </div>


    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script type="text/javascript">
        $(document).ready(() => {
            const details = {!! $details !!}
   
            const canvasElements = [];

            const getQuestionsData = (obj) => {
                let tmp = []
                obj.forEach((element, key) => {

                    let question = 'question' + (key + 1);
                    element[question].length != 0 ?  tmp.push(element[question]) : null;

                    let canvas = document.getElementById(question);
                    canvas ? canvasElements.push(canvas.getContext('2d')) : '';
                });
            
                return tmp;
            }

            let data = getQuestionsData(details);

            const createChartInstances = (arr, data) => {


                arr.forEach((canv, i) => {
                    var myChart = new Chart(canv, {
                        type: 'pie',
                        data: {
                            labels: data[i]['labels'],
                            datasets: [{
                                label: '# of Votes',
                                data: data[i]['data'],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {

                        }

                    });
                });
            }

            const prepareLabelData = (data) => {
                const tmp = [];

                data.forEach((element, i) => {
                    let labels = [];
                    let dataArr = [];
                    for (const [key, value] of Object.entries(element)) {
                        labels.push(key);
                        dataArr.push(value);
                    }
                    tmp.push({
                        labels: labels,
                        data: dataArr
                    });
                });

                return tmp;
            }

            data = prepareLabelData(data);
            createChartInstances(canvasElements, data);

        });
    </script>
</body>

</html>
