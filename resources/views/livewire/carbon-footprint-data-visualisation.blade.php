<div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <body>
        <div class="mt-4 rounded-xl">
            @if ($url == 'log-household-carbon-footprint')
                <button class="rounded-xl bg-emerald-400 p-1">
                    <a class="no-underline text-white font-medium" href="{{ route('data-history-view', ['data_type' => 'household']) }}">View Household Data History</a>
                </button>
            @elseif ($url == 'log-transport-carbon-footprint')
                @if ($transport_type == 'car')
                    <button class="rounded-xl bg-emerald-400 p-1">
                        <a class="no-underline text-white font-medium" href="{{ route('data-history-view', ['data_type' => 'car']) }}">View Car Data History</a>
                    </button>
                @elseif ($transport_type == 'flights')
                    <button class="rounded-xl bg-emerald-400 p-1">
                        <a class="no-underline text-white font-medium" href="{{ route('data-history-view', ['data_type' => 'flights']) }}">View Flights Data History</a>
                    </button>
                @elseif ($transport_type == 'bus&rail')
                    <button class="rounded-xl bg-emerald-400 p-1">
                        <a class="no-underline text-white font-medium" href="{{ route('data-history-view', ['data_type' => 'bus&rail']) }}">View Bus and Rail Data History</a>
                    </button>
                @endif
            @elseif ($url == 'log-secondary-carbon-footprint')
                <button class="rounded-xl bg-emerald-400 p-1">
                    <a class="no-underline text-white font-medium" href="{{ route('data-history-view', ['data_type' => 'secondary']) }}">View Secondary Data History</a>
                </button>
            @endif
            <div class="card">
                <form action="">
                    <select wire:model="chart_type" class="w-fit" wire:change="updateChartType">
                        <option value="line" selected>Line Chart</option> 
                        <option value="bar">Bar Chart</option>
                    </select>
                </form> 
                @if ($url == 'log-transport-carbon-footprint')
                    <form action="">
                        <label for="transport_type">Select transport type</label>
                        <select wire:model="transport_type" class="w-fit" wire:change='updateTransportType'>
                            <option value="car" selected>Car</option> 
                            <option value="flights">Flights</option>
                            <option value="bus&rail">Bus & Rail</option>
                        </select>
                    </form>   
                @endif 
                <div style="width: 100vw; height: 400px" class="card-body">
                    <canvas id="myChart"></canvas>
                    
                    <script>
                        let myChart; // Declare myChart in a broader scope

                        function createChart(chartType, labels, data) {
                            let ctx = document.getElementById('myChart'); // Get context

                            if (myChart) {
                                myChart.destroy(); // Destroy if already exists
                            }

                            console.log(@json($labels));

                            // Initialize chart with updated data and type
                            myChart = new Chart(ctx, {
                                type: chartType,
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'Carbon Footprint Emissions',
                                        data: data,
                                        borderWidth: 1,
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        borderColor: 'rgba(75, 192, 192, 1)',
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
                        }

                        document.addEventListener('livewire:init', () => {
                            console.log("INIT");
                            createChart(@json($chart_type), @json($labels), @json($entries)); // Initial chart creation

                            Livewire.on('updateChart', function () {
                                console.log("Updating chart");
                                createChart(@this.chart_type, @this.labels, @this.entries); // Use @this to access the current Livewire property
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </body>
</div>