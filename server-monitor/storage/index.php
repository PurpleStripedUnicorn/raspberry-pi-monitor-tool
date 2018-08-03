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
                                Total storage
                            </td>
                            <td>
                                <span data-output="storage_total" data-output-process>-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Used storage
                            </td>
                            <td>
                                <span data-output="storage_used" data-output-process>-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Free storage
                            </td>
                            <td>
                                <span data-output="storage_free" data-output-process>-</span>
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

                    </tbody>
                </table>
            </div>
            <div class="detail_right">

            </div>

        </div>
    </div>

</body>
</html>
