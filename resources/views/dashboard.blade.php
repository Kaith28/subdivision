<x-app-layout>
    @if (session('success'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-green-200 border border-green-500 p-2 rounded-md" role="alert">
                {{ session('success') }}
            </div>
        </div>
    @endif
    @if (session('error'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-4">
            <div class="bg-red-200 border border-red-500 p-2 rounded-md" role="alert">
                {{ session('error') }}
            </div>
        </div>
    @endif

    @if ($expiryWarningMessage)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-4">
            <div class="bg-yellow-200 border border-yellow-500 p-2 rounded-md" role="alert">
                {{ $expiryWarningMessage }}
            </div>
        </div>
    @endif
    <!-- Add this section to display the Bulletin Board URL -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="mt-4">
            <label class="text-sm font-semibold">Bulletin Board URL:</label>
            <a class="bg-orange-200 hover:bg-orange-300 shadow-lg w-fit px-4 py-2 rounded-md "
                href="{{ $bulletinBoardUrl }}" target="_blank">smartsubdivision.xyz/{{ $bulletinBoardUrl }}</a>

        </div>
    </div>

    <section>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 mb-5 ">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-20 pt-10 ">
                <div class="flex flex-col items-center shadow-lg rounded-md p-4 bg-orange-50">
                    <div class="h-20 flex items-center">
                        <h2 class="text-4xl">{{ $totalResidents }}</h2>
                    </div>
                    <p class="text-xl ">
                        TOTAL
                    </p>
                    <p class="text-sm text-center">
                        Residents
                    </p>
                </div>
                <div class="flex flex-col items-center shadow-lg rounded-md p-4 bg-green-50">
                    <div class="h-20 flex items-center">
                        <h2 class="text-4xl">{{ $totalTricycleDrivers }}</h2>
                    </div>
                    <p class="text-xl ">
                        TOTAL
                    </p>
                    <p class="text-sm text-center">
                        Tricycle Drivers
                    </p>
                </div>
                <div class="flex flex-col items-center shadow-lg rounded-md p-4 bg-orange-50">
                    <div class="h-20 flex items-center">
                        <h2 class="text-4xl">{{ $totalIn }}</h2>
                    </div>
                    <p class="text-xl ">
                        TOTAL IN
                    </p>
                    <p class="text-sm text-center">
                        Resident & Tricycle Driver
                    </p>
                </div>
                <div class="flex flex-col items-center shadow-lg rounded-md p-4 bg-green-50">
                    <div class="h-20 flex items-center">
                        <h2 class="text-4xl">{{ $totalOut }}</h2>
                    </div>
                    <p class="text-xl">
                        TOTAL OUT
                    </p>
                    <p class="text-sm text-center">
                        Resident & Tricycle Driver
                    </p>
                </div>
                <div class="flex flex-col items-center shadow-lg rounded-md p-4 bg-orange-50">
                    <div class="h-20 flex items-center">
                        <h2 class="text-4xl">{{ $totalInGuests }}</h2>
                    </div>
                    <p class="text-xl ">
                        TOTAL Guests
                    </p>
                    <p class="text-sm">
                        Total Visitors: {{ $totalOutGuests }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Menus -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 mb-5 flex justify-end">
        <form id="redirectForm" method="GET" action="{{ route('dashboard') }}">
            <label for="time-period" class="block text-sm font-medium text-gray-700">Select Time
                Period</label>
            <select id="time-period" name="time-period"
                class="block w-28 p-2 border border-orange-200 bg-white-300 rounded-md shadow-sm focus:outline-none focus:border-gray-300 focus:ring focus:ring-orange-100">
                <option {{ $timePeriod == 'weekly' ? 'selected' : '' }} value="weekly">Weekly</option>
                <option {{ $timePeriod == 'monthly' ? 'selected' : '' }} value="monthly">Monthly</option>
                <option {{ $timePeriod == 'yearly' ? 'selected' : '' }} value="yearly">Yearly</option>
            </select>
            <div class="pt-4">
                <button class="px-4 py-2 flex items-center gap-2 bg-orange-200 hover:bg-orange-300 rounded-md"
                    type="submit">Search</button>
            </div>
        </form>
    </div>

    {{-- Bar Chart Here! --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 mb-5 ">
        <?php
        $dataPoints1 = $dataOne;
        $dataPoints2 = $dataTwo;
        ?>
        <!DOCTYPE HTML>
        <html>

        <head>
            <script>
                window.onload = function() {

                    var chart = new CanvasJS.Chart("chartContainer", {
                        animationEnabled: true,
                        theme: "light2",
                        title: {
                            text: "Total of IN and OUT"
                        },
                        axisY: {
                            includeZero: true
                        },
                        legend: {
                            cursor: "pointer",
                            verticalAlign: "center",
                            horizontalAlign: "right",
                            itemclick: toggleDataSeries
                        },
                        data: [{
                            color: '#fdba74',
                            type: "column",
                            name: "IN",
                            indexLabel: "{y}",
                            yValueFormatString: "#0.##",
                            showInLegend: true,
                            dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
                        }, {
                            color: '#86efac',
                            type: "column",
                            name: "OUT",
                            indexLabel: "{y}",
                            yValueFormatString: "#0.##",
                            showInLegend: true,
                            dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
                        }]
                    });
                    chart.render();

                    function toggleDataSeries(e) {
                        if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                            e.dataSeries.visible = false;
                        } else {
                            e.dataSeries.visible = true;
                        }
                        chart.render();
                    }

                }
            </script>
        </head>

        <body>
            <div id="chartContainer" style="height: 370px; width: 100%; mb: 20;"></div>
            <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
        </body>
    </div>



</x-app-layout>
