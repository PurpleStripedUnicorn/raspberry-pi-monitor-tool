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
        <?php include dirname(__DIR__)."/top_title.php"; ?>
        <div class="content detail_content">

            <div class="detail_left">
                <div class="graph_container mobile_graph_container"
                     data-output-graph="cpu_usage_total">
                </div>
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

                        <?php

                        # get the amount of cores in the system

                        # first, get the result JSON of the "get.php" file
                        ob_start();
                        include dirname(__DIR__)."/get.php";
                        $json = ob_get_contents();
                        ob_end_clean();

                        # convert the JSON to an associative array
                        $assoc = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);

                        # order the array in alphabetic order by key
                        ksort($assoc);

                        # go through every key and value in the array and put
                        #   it into the table
                        foreach ($assoc as $key => $val) {

                            # if the key starts with "cpu_usage_core", add item
                            if (substr($key, 0, 14) === "cpu_usage_core") {
                                # add core to list
                                $core_num = substr($key, 14);
                                echo "<tr><td>CPU usage (core $core_num)</td><td><span data-output='$key' data-output-colored>-</span></td></tr>";
                            }

                        }

                        ?>

                    </tbody>
                </table>
            </div>
            <div class="detail_right">
                <h1>CPU usage - total (%)</h1>
                <div class="graph_container"
                     data-output-graph="cpu_usage_total">
                </div>

                <?php

                # go through every key and value in the array and show a graph
                #   for it
                foreach ($assoc as $key => $val) {

                    # if the key starts with "cpu_usage_core", add item
                    if (substr($key, 0, 14) === "cpu_usage_core") {
                        # add core to list
                        $core_num = substr($key, 14);
                        echo "<h1>CPU usage - core $core_num (%)</h1>
                        <div class='graph_container'
                             data-output-graph='$key'>
                        </div>";
                    }

                }

                ?>

            </div>

        </div>
    </div>

</body>
</html>
