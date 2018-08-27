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
                <div class="long_graph_bar mobile_long_graph_bar" data-output-graph="storage_total">

                </div>
                <table class="large_table">
                    <tbody>

                        <tr>
                            <td>
                                <div class="graph_indicator" style="background-color: transparent;"></div>
                                Total storage
                            </td>
                            <td>
                                <span data-output="storage_total" data-output-process>-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="graph_indicator" style="background-color: #41d887;"></div>
                                Used storage
                            </td>
                            <td>
                                <span data-output="storage_used" data-output-process>-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="graph_indicator" style="background-color: #eee;"></div>
                                Free storage
                            </td>
                            <td>
                                <span data-output="storage_free" data-output-process>-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="graph_indicator" style="background-color: #9a4ce8;"></div>
                                Reserved storage
                            </td>
                            <td>
                                <span data-output="storage_reserved" data-output-process>-</span>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <h2 class="small_table_title">details</h2>
                <table class="small_table">
                    <tbody>

                        <tr>
                            <td>
                                Total storage (bytes)
                            </td>
                            <td>
                                <span data-output="storage_total">-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Used storage (bytes)
                            </td>
                            <td>
                                <span data-output="storage_used">-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Free storage (bytes)
                            </td>
                            <td>
                                <span data-output="storage_free">-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Reserved storage (bytes)
                            </td>
                            <td>
                                <span data-output="storage_reserved">-</span>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <table class="small_table">
                    <tbody>

                        <tr>
                            <td>
                                Total storage (% of total)
                            </td>
                            <td>
                                <span data-output="storage_total" data-output-percent>-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Used storage (% of total)
                            </td>
                            <td>
                                <span data-output="storage_used" data-output-percent>-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Free storage (% of total)
                            </td>
                            <td>
                                <span data-output="storage_free" data-output-percent>-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Reserved storage (% of total)
                            </td>
                            <td>
                                <span data-output="storage_reserved" data-output-percent>-</span>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="detail_right">
                <h1>Storage usage</h1>
                <div class="long_graph_bar" data-output-graph="storage_total">

                </div>
            </div>

        </div>
    </div>

</body>
</html>
