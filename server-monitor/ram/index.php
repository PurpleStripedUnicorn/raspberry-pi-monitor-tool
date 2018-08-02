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
                                Total RAM
                            </td>
                            <td>
                                <span data-output="ram_total">-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                RAM used
                            </td>
                            <td>
                                <span data-output="ram_used">-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                RAM free
                            </td>
                            <td>
                                <span data-output="ram_free">-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                RAM shared
                            </td>
                            <td>
                                <span data-output="ram_shared">-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                RAM buff/cache
                            </td>
                            <td>
                                <span data-output="ram_buff_cache">-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                RAM available
                            </td>
                            <td>
                                <span data-output="ram_available">-</span>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="detail_right">

            </div>

        </div>
    </div>

    <!-- script for updating the statistics
         also set the location of the get.php file relative to this file -->
    <script>var get_loc; get_loc = "../get.php";</script>
    <script type="text/javascript" src="../server-monitor.js"></script>

</body>
</html>
