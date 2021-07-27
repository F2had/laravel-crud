let spinner = document.createElement("div");
spinner.classList.add("col", "text-center");
spinner.innerHTML = `<span>Loading...</span>
                        <div class="spinner-grow text-primary" role="status">
                        </div>`;

let grid = document.getElementById("grid");

const labels = [];
const chartData = [];
const backgroundColors = [];
const options = {
    scales: {
        y: {
            beginAtZero: true,
        },
    },
};
const generateColor = () => {
    let r = Math.floor(Math.random() * 255);
    let g = Math.floor(Math.random() * 255);
    let b = Math.floor(Math.random() * 255);
    return `rgb(${r}, ${g}, ${b})`;
};
//Extracting Labels"Key" Data"Value" from an object
for (const [key, value] of Object.entries(controllerData.count_by)) {
    labels.push(key);
    chartData.push(value);
}

for (let i = 0; i < labels.length; i++) {
    backgroundColors.push(generateColor());
}
var canvas = document.getElementById("myChart");

let data = {
    labels: labels,
    datasets: [
        {
            label: `Course by ${controllerData.by}`,
            data: chartData,
            backgroundColor: backgroundColors,
            borderColor: ["rgba(255, 99, 132, .2)"],
            borderWidth: 1,
        },
    ],
};

var ctx = canvas.getContext("2d");
var myChart = new Chart(ctx, {
    type: "bar",
    data: data,
    options: options,
});
$("#myChart").on("click", async (e) => {
    e.preventDefault();
    grid.innerHTML = "";
    let activePoints = myChart.getElementsAtEventForMode(
        e,
        "nearest",
        {
            intersect: true,
        },
        true
    );

    if (activePoints.length) {
        const firstPoint = activePoints[0];
        var label = myChart.data.labels[firstPoint.index];
        var value =
            myChart.data.datasets[firstPoint.datasetIndex].data[
                firstPoint.index
            ];
        console.log("Label =>", label);
        console.log("Value => ", value);
        //Course id
        console.log(controllerData.id);
    }
    if (value && label) {
        let appednedSpiner = grid.appendChild(spinner);

        try {
            var response = await axios.get(
                "https://jsonplaceholder.typicode.com/posts"
            );
        } catch (error) {
            console.log(error);
        }
        grid.removeChild(appednedSpiner);
        console.log(response);
        grid.innerHTML = "Done";
    }
});
