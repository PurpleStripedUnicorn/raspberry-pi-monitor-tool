<?php include dirname(__DIR__)."/init.php"; ?>
<?php include "../head_message.php"; ?>
<!DOCTYPE html>
<html lang="en-gb">
<head>

    <!-- title at the top of the screen -->
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
                <table class="large_table">
                    <tbody>

                        <tr>
                            <td>
                                LED 0 status
                            </td>
                            <td>
                                <span data-output="led_led0_status">-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                LED 1 status
                            </td>
                            <td>
                                <span data-output="led_led1_status">-</span>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            

        </div>
    </div>

</body>
</html>
