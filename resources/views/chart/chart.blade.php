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

        <div class="containter d-flex justify-content-center">
            <div class="w-25 h-25">
                <h4 class="text-center">{{ $course->name }}</h4>
                <canvas id="myChart" width="200" height="200"></canvas>
            </div>
        </div>
    </main>

    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.4.1/dist/chart.min.js"></script>
    <script>
        let data = {!! $course !!};
        console.log(data.type);
        const labels = []
        const chartData = []
        const backgroundColors = []

        const generateColor = () => {
            let r = Math.floor(Math.random() * 255);
            let g = Math.floor(Math.random() * 255);
            let b = Math.floor(Math.random() * 255);
            return (`rgb(${r}, ${g}, ${b})`)
        }
        for (const [key, value] of Object.entries(data.count_by)) {
            labels.push(key);
            chartData.push(value)
        }
        for (let i = 0; i < labels.length; i++) {
            backgroundColors.push(generateColor())
        }
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: `Course by ${data.type}`,
                    data: chartData,
                    backgroundColor: backgroundColors,
                    borderColor: [
                        'rgba(255, 99, 132, .2)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>
