<?php include "../head_message.php"; ?>
<!DOCTYPE html>
<html lang="en-gb">
<head>

    <!-- title at the top of the screen -->
    <title>Server monitor</title>

    <!-- google font for better styling -->
    <link href="https://fonts.googleapis.com/css?family=Maven+Pro:500|Open+Sans" rel="stylesheet">
    <!-- jQuery is required for the scripts that retrieve the data -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- main styling -->
    <link rel="stylesheet" type="text/css" href="../server-monitor.css" />

</head>
<body>

    <div class="main_container">
        <div class="top_title">
            <h1>server monitor</h1>
        </div>
        <div class="content detail_content">

            <div class="detail_left">
                <table class="large_table">
                    <tbody>

                        <tr>
                            <td>
                                CPU temperature
                            </td>
                            <td>
                                <span data-output="temp_cpu">-</span>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="detail_right">
                <h1>CPU temperature (°C)</h1>
                <div class="graph_container"
                     data-output-graph="temp_cpu">
                </div>
            </div>

        </div>
    </div>

    <!-- script for updating the statistics
         also set the location of the get.php file relative to this file -->
    <script>var get_loc; get_loc = "../get.php";</script>
    <script type="text/javascript" src="../server-monitor.js"></script>

</body>
</html>
