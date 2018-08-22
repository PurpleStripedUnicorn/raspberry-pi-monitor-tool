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
                                CPU usage (total)
                            </td>
                            <td>
                                <span data-output="cpu_usage_total" data-output-colored>-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                CPU usage (core 0)
                            </td>
                            <td>
                                <span data-output="cpu_usage_core0" data-output-colored>-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                CPU usage (core 1)
                            </td>
                            <td>
                                <span data-output="cpu_usage_core1" data-output-colored>-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                CPU usage (core 2)
                            </td>
                            <td>
                                <span data-output="cpu_usage_core2" data-output-colored>-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                CPU usage (core 3)
                            </td>
                            <td>
                                <span data-output="cpu_usage_core3">-</span>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="detail_right">
                <h1>Total CPU usage (%)</h1>
                <div class="graph_container"
                     data-output-graph="cpu_usage_total">
                </div>
            </div>

        </div>
    </div>

</body>
</html>
