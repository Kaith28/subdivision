<x-app-layout>
    <section>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 mb-5 ">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-20 pt-10 ">
                <div class="flex flex-col items-center shadow-lg rounded-md p-4">
                    <div class="h-20 flex items-center">
                        <h2 class="text-4xl">{{ $totalResidents }}</h2>
                    </div>
                    <p class="text-xl ">
                        TOTAL of Residents
                    </p>
                </div>
                <div class="flex flex-col items-center shadow-lg rounded-md p-4">
                    <div class="h-20 flex items-center">
                        <h2 class="text-4xl">{{ $totalInGuests }}</h2>
                    </div>
                    <p class="text-xl ">
                        TOTAL Guest
                    </p>
                    <p class="text-sm">
                        Total Visitors: {{ $totalOutGuests }}
                    </p>
                </div>
                <div class="flex flex-col items-center shadow-lg rounded-md p-4">
                    <div class="h-20 flex items-center">
                        <h2 class="text-4xl">{{ $totalIn }}</h2>
                    </div>
                    <p class="text-xl ">
                        TOTAL IN
                    </p>
                </div>
                <div class="flex flex-col items-center shadow-lg rounded-md p-4">
                    <div class="h-20 flex items-center">
                        <h2 class="text-4xl">{{ $totalOut }}</h2>
                    </div>
                    <p class="text-xl">
                        TOTAL OUT
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Menus -->
    <div class="w-auto max-w-xs ml-auto mb-10">
        <label for="time-period" class="block text-sm font-medium text-center text-gray-700">Select Time Period</label>
        <select id="time-period" name="time-period"
            class="mt-1 ml-28 block w-28 p-2 border border-gray-300 bg-white-300 rounded-md shadow-sm focus:outline-none focus:border-gray-300 focus:ring focus:ring-blue-200">
            <option value="daily">Daily</option>
            <option value="weekly">Weekly</option>
            <option value="monthly">Monthly</option>
            <option value="yearly">Yearly</option>
        </select>
    </div>

    {{-- Bar Chart Here! --}}
    <?php
 
    $dataPoints1 = array(
        array("label"=> "2010", "y"=> 36.12),
        array("label"=> "2011", "y"=> 34.87),
        array("label"=> "2012", "y"=> 40.30),
        array("label"=> "2013", "y"=> 35.30),
        array("label"=> "2014", "y"=> 39.50),
        array("label"=> "2015", "y"=> 50.82),
        array("label"=> "2016", "y"=> 74.70)
    );
    $dataPoints2 = array(
        array("label"=> "2010", "y"=> 64.61),
        array("label"=> "2011", "y"=> 70.55),
        array("label"=> "2012", "y"=> 72.50),
        array("label"=> "2013", "y"=> 81.30),
        array("label"=> "2014", "y"=> 63.60),
        array("label"=> "2015", "y"=> 69.38),
        array("label"=> "2016", "y"=> 98.70)
    );
        
    ?>
    <!DOCTYPE HTML>
    <html>
    <head>  
    <script>
    window.onload = function () {
     
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        theme: "light2",
        title:{
            text: "Total of IN and OUT"
        },
        axisY:{
            includeZero: true
        },
        legend:{
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
        },{
            type: "column",
            name: "OUT",
            indexLabel: "{y}",
            yValueFormatString: "$#0.##",
            showInLegend: true,
            dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();
     
    function toggleDataSeries(e){
        if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
        }
        else{
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
    </html>          

</x-app-layout>
