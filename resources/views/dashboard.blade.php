<x-app-layout>
    <section>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 mb-5 ">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-20 pt-10 ">
                <div class="flex flex-col items-center shadow-lg rounded-md p-4 bg-green-50">
                    <div class="h-20 flex items-center">
                        <h2 class="text-4xl">{{ $totalResidents }}</h2>
                    </div>
                    <p class="text-xl ">
                        TOTAL Residents
                    </p>
                </div>
                <div class="flex flex-col items-center shadow-lg rounded-md p-4 bg-orange-50">
                    <div class="h-20 flex items-center">
                        <h2 class="text-4xl">{{ $totalIn }}</h2>
                    </div>
                    <p class="text-xl ">
                        TOTAL IN
                    </p>
                    <p class="text-sm">
                        Resident and Tricycle Driver
                    </p>
                </div>
                <div class="flex flex-col items-center shadow-lg rounded-md p-4 bg-green-50">
                    <div class="h-20 flex items-center">
                        <h2 class="text-4xl">{{ $totalOut }}</h2>
                    </div>
                    <p class="text-xl">
                        TOTAL OUT
                    </p>
                    <p class="text-sm">
                        Resident and Tricycle Driver
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
        <div><label for="time-period" class="block text-sm font-medium text-gray-700">Select Time
                Period</label>
            <select id="time-period" name="time-period"
                class="block w-28 p-2 border border-orange-200 bg-white-300 rounded-md shadow-sm focus:outline-none focus:border-gray-300 focus:ring focus:ring-orange-100">
                <option value="daily">Daily</option>
                <option value="weekly">Weekly</option>
                <option value="monthly">Monthly</option>
                <option value="yearly">Yearly</option>
            </select>
        </div>
    </div>

    {{-- Bar Chart Here! --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 mb-5 ">
        <?php
        
        $dataPoints1 = [['label' => '2010', 'y' => ], ['label' => '2011', 'y' => ], ['label' => '2012', 'y' => ], ['label' => '2013', 'y' => ], ['label' => '2014', 'y' => ], ['label' => '2015', 'y' => ], ['label' => '2016', 'y' => ]];
        $dataPoints2 = [['label' => '2010', 'y' => ], ['label' => '2011', 'y' => ], ['label' => '2012', 'y' => ], ['label' => '2013', 'y' => ], ['label' => '2014', 'y' => ], ['label' => '2015', 'y' => ], ['label' => '2016', 'y' => ]];
        
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
                            type: "column",
                            name: "IN",
                            indexLabel: "{y}",
                            yValueFormatString: "$#0.##",
                            showInLegend: true,
                            dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
                        }, {
                            type: "column",
                            name: "OUT",
                            indexLabel: "{y}",
                            yValueFormatString: "$#0.##",
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
