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
                                <div class="graph_indicator" style="background-color: transparent;"></div>
                                Total RAM
                            </td>
                            <td>
                                <span data-output="ram_total" data-output-process>-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="graph_indicator" style="background-color: #ea8e54;"></div>
                                RAM used
                            </td>
                            <td>
                                <span data-output="ram_used" data-output-process>-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="graph_indicator" style="background-color: #eee;"></div>
                                RAM free
                            </td>
                            <td>
                                <span data-output="ram_free" data-output-process>-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="graph_indicator" style="background-color: #41d887;"></div>
                                RAM shared
                            </td>
                            <td>
                                <span data-output="ram_shared" data-output-process>-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="graph_indicator" style="background-color: #9a4ce8;"></div>
                                RAM buff/cache
                            </td>
                            <td>
                                <span data-output="ram_buff_cache" data-output-process>-</span>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <h2 class="small_table_title">details</h2>
                <table class="small_table">
                    <tbody>

                        <tr>
                            <td>
                                Total RAM (bytes)
                            </td>
                            <td>
                                <span data-output="ram_total">-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                RAM used (bytes)
                            </td>
                            <td>
                                <span data-output="ram_used">-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                RAM free (bytes)
                            </td>
                            <td>
                                <span data-output="ram_free">-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                RAM shared (bytes)
                            </td>
                            <td>
                                <span data-output="ram_shared">-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                RAM buff/cache (bytes)
                            </td>
                            <td>
                                <span data-output="ram_buff_cache">-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                RAM available (bytes)
                            </td>
                            <td>
                                <span data-output="ram_available">-</span>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <table class="small_table">
                    <tbody>

                        <tr>
                            <td>
                                RAM total (% of total)
                            </td>
                            <td>
                                <span data-output="ram_total" data-output-percent>-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                RAM used (% of total)
                            </td>
                            <td>
                                <span data-output="ram_used" data-output-percent>-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                RAM free (% of total)
                            </td>
                            <td>
                                <span data-output="ram_free" data-output-percent>-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                RAM shared (% of total)
                            </td>
                            <td>
                                <span data-output="ram_shared" data-output-percent>-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                RAM buff/cache (% of total)
                            </td>
                            <td>
                                <span data-output="ram_buff_cache" data-output-percent>-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                RAM available (% of total)
                            </td>
                            <td>
                                <span data-output="ram_available" data-output-percent>-</span>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="detail_right">
                <h1>RAM usage</h1>
                <div class="graph_container"
                     data-output-graph="ram_total">
                </div>
            </div>

        </div>
    </div>

</body>
</html>
