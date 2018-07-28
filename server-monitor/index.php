<!DOCTYPE html>
<html lang="en-gb">
<head>

    <!-- title at the top of the screen -->
    <title>Server monitor</title>

    <!-- jQuery is required for script at the end of the document -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- main styling -->
    <link rel="stylesheet" type="text/css" href="server-monitor.css" />

</head>
<body>

    <div class="main_container">
        <div>
            <h1><span>server status</span></h1>
            <table>
                <tbody>

                    <tr>
                        <th colspan=2>
                            CPU
                        </th>
                    </tr>

                    <tr>
                        <td>
                            cpu usage (total)
                        </td>
                        <td data-output="cpu_usage_color">
                            <span data-output="cpu_usage">0</span>%
                        </td>
                    </tr>

                    <tr>
                        <td>
                            cpu usage (core0)
                        </td>
                        <td data-output="cpu_usage_color_core0">
                            <span data-output="cpu_usage_core0">0</span>%
                        </td>
                    </tr>

                    <tr>
                        <td>
                            cpu usage (core1)
                        </td>
                        <td data-output="cpu_usage_color_core1">
                            <span data-output="cpu_usage_core1">0</span>%
                        </td>
                    </tr>

                    <tr>
                        <td>
                            cpu usage (core2)
                        </td>
                        <td data-output="cpu_usage_color_core2">
                            <span data-output="cpu_usage_core2">0</span>%
                        </td>
                    </tr>

                    <tr>
                        <td>
                            cpu usage (core3)
                        </td>
                        <td data-output="cpu_usage_color_core3">
                            <span data-output="cpu_usage_core3">0</span>%
                        </td>
                    </tr>

                    <tr>
                        <td>
                            cpu temperature
                        </td>
                        <td>
                            <span data-output="cpu_temp">0°C</span>
                        </td>
                    </tr>

                </tbody>
            </table>
            <table>
                <tbody>

                    <tr>
                        <th colspan=2>
                            Storage
                        </th>
                    </tr>

                    <tr>
                        <td>
                            total storage
                        </td>
                        <td data-output="storage_total">
                            0G
                        </td>
                    </tr>

                    <tr>
                        <td>
                            storage free
                        </td>
                        <td data-output="storage_free">
                            0G
                        </td>
                    </tr>

                    <tr>
                        <td>
                            storage used
                        </td>
                        <td data-output="storage_used">
                            0G
                        </td>
                    </tr>

                </tbody>
            </table>
            <table>
                <tbody>

                    <tr>
                        <th colspan=2>
                            RAM
                        </th>
                    </tr>

                    <tr>
                        <td>
                            RAM total
                        </td>
                        <td data-output="ram_total">
                            0M
                        </td>
                    </tr>

                    <tr>
                        <td>
                            RAM used
                        </td>
                        <td data-output="ram_used">
                            0M
                        </td>
                    </tr>

                    <tr>
                        <td>
                            RAM free
                        </td>
                        <td data-output="ram_free">
                            0M
                        </td>
                    </tr>

                    <tr>
                        <td>
                            RAM shared
                        </td>
                        <td data-output="ram_shared">
                            0M
                        </td>
                    </tr>

                    <tr>
                        <td>
                            RAM buff/cache
                        </td>
                        <td data-output="ram_buff_cache">
                            0M
                        </td>
                    </tr>

                    <tr>
                        <td>
                            RAM available
                        </td>
                        <td data-output="ram_available">
                            0M
                        </td>
                    </tr>

                </tbody>
            </table>
            <p class="tiny_bottom">
                Query processing time: <span data-output="query_time">0.000s</span>
            </p>
        </div>
    </div>

    <!-- script for updating the statistics -->
    <script>

    // function that is run to update the page
    function g () {
        // send AJAX to get.php page
        $.ajax({
            url: "./get.php", // page
            type: "get", // GET request
            success: function (data) {
                // log JSON data to the browser console
                console.log(data);

                // define color data
                var green = {
                    "r": 76,
                    "g": 224,
                    "b": 152
                }
                var orange = {
                    "r": 241,
                    "g": 177,
                    "b": 99
                }
                var red = {
                    "r": 241,
                    "g": 99,
                    "b": 99
                }

                // get the json data (already decoded) and process each value

                // CPU usage
                var cpu_checks = ["", "_core0", "_core1", "_core2", "_core3"];
                // go over every element that involves cpu usage (total + every core)
                for (i = 0; i < cpu_checks.length; i++) {
                    $( "[data-output=cpu_usage"+cpu_checks[i]+"]" ).html( data["cpu_usage"+cpu_checks[i]] );
                    // set color
                    var usage = Number(data["cpu_usage"+cpu_checks[i]]);
                    var orange_mid = 25; // value between 0 and 100
                    // green:   rgb(96, 239, 86)
                    // orange:  rgb(239, 196, 86)
                    // red: rgb(242, 89, 89)
                    var r = (usage < orange_mid) ?
                            (green["r"] + (usage / orange_mid) * (orange["r"] - green["r"])) :
                            (orange["r"] + ((usage - orange_mid) / (100 - orange_mid)) * (red["r"] - orange["r"]));
                    var g = (usage < orange_mid) ?
                            (green["g"] + (usage / orange_mid) * (orange["g"] - green["g"])) :
                            (orange["g"] + ((usage - orange_mid) / (100 - orange_mid)) * (red["g"] - orange["g"]));
                    var b = (usage < orange_mid) ?
                            (green["b"] + (usage / orange_mid) * (orange["b"] - green["b"])) :
                            (orange["b"] + ((usage - orange_mid) / (100 - orange_mid)) * (red["b"] - orange["b"]));
                    $( "[data-output=cpu_usage_color"+cpu_checks[i]+"]" ).css( "background-color", "rgb("+r+","+g+","+b+")" );
                    $( "[data-output=cpu_usage_color"+cpu_checks[i]+"]" ).css( "color", "white" );
                }

                // CPU TEMPERATURE
                $( "[data-output=cpu_temp]" ).html( data["cpu_temp"] );

                // STORAGE TOTAL
                $( "[data-output=storage_total]" ).html( data["storage_total"] );

                // STORAGE USED
                $( "[data-output=storage_used]" ).html( data["storage_used"] );

                // STORAGE FREE
                $( "[data-output=storage_free]" ).html( data["storage_free"] );

                // RAM USAGE
                var ram_checks = ["total", "used", "free", "shared", "buff_cache", "available"];
                for (i = 0; i < ram_checks.length; i++) {
                    $( "[data-output=ram_"+ram_checks[i]+"]" ).html( data["ram_"+ram_checks[i]] );
                }

                // UPDATE TIME
                $( "[data-output=query_time]" ).html( data["query_time"] );

            },
            // function for when the document is updated
            // request new data
            complete: function () {
                setTimeout(g, 100); // delay with 100ms to not overload the server
            },
            dataType: "json" // set type to json just in case
        });
    }

    g();

    </script>

</body>
</html>
