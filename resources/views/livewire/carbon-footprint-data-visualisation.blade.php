<div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <div class="container mt-4">

        @if ($friend_page)
            <h2>FRIEND PAGE</h2>
        @else
            <div class="text-center mb-4">
                @if ($url == 'log-household-carbon-footprint')
                    <a href="{{ route('data-history-view', ['data_type' => 'household']) }}" 
                    class="btn btn-success rounded-xl w-100">View Household Data History</a>
                @elseif ($url == 'log-transport-carbon-footprint')
                    @if ($transport_type == 'car')
                        <a href="{{ route('data-history-view', ['data_type' => 'car']) }}" 
                        class="btn btn-success rounded-xl w-100">View Car Data History</a>
                    @elseif ($transport_type == 'flights')
                        <a href="{{ route('data-history-view', ['data_type' => 'flights']) }}" 
                        class="btn btn-success rounded-xl w-100">View Flights Data History</a>
                    @elseif ($transport_type == 'bus&rail')
                        <a href="{{ route('data-history-view', ['data_type' => 'bus&rail']) }}" 
                        class="btn btn-success rounded-xl w-100">View Bus and Rail Data History</a>
                    @endif
                @elseif ($url == 'log-secondary-carbon-footprint')
                    <a href="{{ route('data-history-view', ['data_type' => 'secondary']) }}" 
                    class="btn btn-success rounded-xl w-100">View Secondary Data History</a>
                @endif
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-body">
                <form action="" class="mb-3">
                    <label for="chart_type" class="form-label">Select Chart Type</label>
                    <select wire:model="chart_type" id="chart_type" class="form-select" wire:change="updateChartType">
                        <option value="line" selected>Line Chart</option>
                        <option value="bar">Bar Chart</option>
                    </select>
                </form> 

                @if ($friend_page)
                    @if ($data_type == 'log-transport-carbon-footprint')
                        <form action="" class="mb-3">
                            <label for="transport_type" class="form-label">Select Transport Type</label>
                            <select wire:model="transport_type" id="transport_type" class="form-select" wire:change='updateTransportType'>
                                <option value="car" selected>Car</option>
                                <option value="flights">Flights</option>
                                <option value="bus&rail">Bus & Rail</option>
                            </select>
                        </form>   
                    @endif 
                @else
                    @if ($url == 'log-transport-carbon-footprint')
                        <form action="" class="mb-3">
                            <label for="transport_type" class="form-label">Select Transport Type</label>
                            <select wire:model="transport_type" id="transport_type" class="form-select" wire:change='updateTransportType'>
                                <option value="car" selected>Car</option>
                                <option value="flights">Flights</option>
                                <option value="bus&rail">Bus & Rail</option>
                            </select>
                        </form>   
                    @endif 
                @endif

                <div class="position-relative" style="width: 100%; height: 400px;">
                    <canvas id="myChart" class="w-100 h-100"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        let myChart;

        function createChart(chartType, labels, data) {
            let ctx = document.getElementById('myChart');

            if (myChart) {
                myChart.destroy();
            }

            const trimmedLabels = labels.map((label) => {
                return label.split('T')[0];
            });

            myChart = new Chart(ctx, {
                type: chartType,
                data: {
                    labels: trimmedLabels,
                    datasets: [{
                        label: 'Carbon Footprint Emissions',
                        data: data,
                        borderWidth: 1,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        document.addEventListener('livewire:init', () => {
            createChart(@json($chart_type), @json($labels), @json($entries));

            Livewire.on('updateChart', function () {
                createChart(@this.chart_type, @this.labels, @this.entries);
            });
        });
    </script>
</div>