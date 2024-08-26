<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- add bootstrap and chart js cdn links here --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="mt-4 rounded-xl">
        <div class="card">

            <div class="card-body">
                <div class="flex flex-row gap-4">
                    <p>Low: 5</p>
                    <p>Medium: 5 to 15</p>
                    <p>High: > 15</p>
                </div>
                
                    <canvas id="myChart" class=""></canvas>
                
                <script>
                    const ctx = document.getElementById('myChart');
                    // capture the data from a controller here
                    const labels = {!! json_encode($labels) !!};
                    const data = {!! json_encode($household_entries) !!};

                    // then apply the two variable to our graph srcipt
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                    label: 'Carbon Footprint Emissions',
                                    data: data,
                                    borderWidth: 1
                                },

                            ]
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
            </div>
        </div>
    </div>
</body>

</html>
