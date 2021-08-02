$(document).ready(function () {
    let spinner = `<div class="col d-flex justify-content-center" id="spinner">
                    <span>Loading...</span>
                        <div class="spinner-grow text-primary" role="status">
                        </div>
                   </div>`;

    let chartRow = $("#chartRow");
    var id = null;
    var by = null;

    let form = $("#chartForm").on("submit", async (e) => {
        e.preventDefault();
        $("#myChart").hide();
        $("#details").empty();
        $("#canvasWrapper").append(spinner);
        let formData = form.serialize();
        var data;
        try {
             data = await axios({
                method: "POST",
                url: "/api/chart",
                data: formData,
            });
        } catch (error) {
            console.log(error);
        }

        $("#canvasWrapper #spinner").remove();
        if (data.data) {
            makeChart(data.data);
        }
    });

    const generateColor = () => {
        let r = Math.floor(Math.random() * 255);
        let g = Math.floor(Math.random() * 255);
        let b = Math.floor(Math.random() * 255);
        return `rgb(${r}, ${g}, ${b})`;
    };
    var myChart;
    const makeChart = (data) => {
        id = data.id;
        by = data.by;
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
        //Extracting Labels => "Key" Data => "Value" from an object
        for (const [key, value] of Object.entries(data.count_by)) {
            labels.push(key);
            chartData.push(value);
        }

        for (let i = 0; i < labels.length; i++) {
            backgroundColors.push(generateColor());
        }
        let canvas = document.getElementById("myChart");

        var ctx = canvas.getContext("2d");
        if (myChart) {
            myChart.destroy();
        }
        myChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: labels,
                datasets: [
                    {
                        label: `Course by ${data.by}`,
                        data: chartData,
                        backgroundColor: backgroundColors,
                        borderColor: ["rgba(255, 99, 132, .2)"],
                        borderWidth: 1,
                    },
                ],
            },
            options: options,
        });
        $("#myChart").show();
    };

    const makeTable = (data) => {
        $("#details").empty();
        const students = data.students;
        const studentsData = data.students.data;
        let tableData = "";
        studentsData.forEach((student) => {
            tableData += ` <tr>

                 <td>${student.name}</td>
                 <td>${student.email}</td>
                  <td>${student.age}</td>
                 <td>${student.phone}</td>
                 <td>${student.department}</td>
                 <td>${student.address}</td>
                 <td>${student.state}</td>
                 <td>${student.country}</td>
                 <td>${student.nationality}</td>
                                            
              </tr>`;
        });
        let navElements = "";
        students.links.forEach((element) => {
            let active = element.active ? "active" : "";
            navElements += ` <li class="page-item ${active}" style="cursor: pointer">
                     <a class="page-link"   data-link="${element.url}">
                         ${element.label}
                     </a>
                 </li>`;
        });

        let table = `<div class="col-8">
            <div class="table-responsive pt-3">

                    <div class="table-wrapper">

                        <div class="table-title">
                        

                            <table id="studentTable" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Age</th>
                                        <th>Phone</th>
                                        <th>Department</th>
                                        <th>Address</th>
                                        <th>State</th>
                                        <th>Country</th>
                                        <th>Nationality</th>
                                    </tr>
                                </thead>
                                <tbody>
                                ${tableData}
                                </tbody>
                            </table>

                        </div>
                        <div class="w-10 h-10">
                            <div class="d-flex justify-content-center">
                            <nav aria-label="Page navigation example">
                              <ul class="pagination">
                                ${navElements}
                              </ul>
                            </nav>
                            </div>
                        </div>
                    </div>

                </div>
            </div>`;

        $("#details").append(table);
        $(".page-item").on("click", async (e) => {
            e.preventDefault;
            let url = e.target.getAttribute("data-link");

            let response = await axios.get(url);
            makeTable(response.data);
        });
    };

    $("#myChart").on("click", async (e) => {
        e.preventDefault();
        $("#details").empty();
        let details = $("#details");

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
        }

        if (value && label) {
            let host = window.location.host;
            let protocol = window.location.protocol;
            let year = $("#year").val();
            let age = $("#age").val();
            let url;

            if (age && year) {
                url = `${protocol}//${host}/api/students/filter?filterby=${by}&filterword=${label}&course-id=${id}&year=${year}&age=${age}`;
            } else if (age) {
                url = `${protocol}//${host}/api/students/filter?filterby=${by}&filterword=${label}&course-id=${id}&age=${age}`;
            } else if (year) {
                url = `${protocol}//${host}/api/students/filter?filterby=${by}&filterword=${label}&course-id=${id}&year=${year}`;
            } else {
                url = `${protocol}//${host}/api/students/filter?filterby=${by}&filterword=${label}&course-id=${id}`;
            }
            details.append(spinner);

            try {
                var response = await axios(url);
            } catch (error) {
                console.log(error);
            }

            $("#details #spinner").remove();
            if (response.data) {
                makeTable(response.data);
            }
        }
    });
});
