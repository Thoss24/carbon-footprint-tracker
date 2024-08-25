<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Data from database into a chart js bar graph in laravel</title>
    {{-- add bootstrap and chart js cdn links here --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">Chart js & laravel</div>
            <div class="card-body">
                {{-- this div will create a graph --}}
                <div>
                    <canvas id="myChart" style="width: 400px;"></canvas>
                  </div>
                  <script>
                    const ctx = document.getElementById('myChart');
                    // capture the data from a controller here
                    const labels = {!! json_encode($labels)!!};
                    const data = {!! json_encode($data)!!};

                    // then apply the two variable to our graph srcipt
                    new Chart(ctx, {
                      type: 'bar',
                      data: {
                        labels: labels,
                        datasets: [{
                          label: '# of Exam Marks',
                          data: data,
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
            </div>
        </div>
    </div>
</body>
</html>