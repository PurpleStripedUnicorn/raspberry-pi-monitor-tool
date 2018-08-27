<?php include dirname(__DIR__)."/init.php"; ?>
<?php include "../head_message.php"; ?>
<!DOCTYPE html>
<html lang="en-gb">
<head>

    <title>Server monitor</title>

    <base href="../" />
    <?php include "../top.php"; ?>

</head>
<body>

    <div class="main_container">
        <div class="top_title">
            <h1>server monitor</h1>
        </div>
        <div class="content detail_content">

            <div class="detail_left">
                <div class="graph_container mobile_graph_container"
                     data-output-graph="temp_cpu">
                </div>
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

</body>
</html>
