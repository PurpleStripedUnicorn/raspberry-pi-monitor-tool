<?php include "../head_message.html"; ?>
<!DOCTYPE html>
<html lang="en-gb">
<head>

    <!-- title at the top of the screen -->
    <title>Server monitor</title>

    <base href="../" />
    <?php include "../top.html"; ?>

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

</body>
</html>
