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
                <table class="large_table">
                    <tbody>

                        <tr>
                            <td>
                                LED 0 status
                            </td>
                            <td>
                                <span data-output="led_led0_status" data-output-colored>-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                LED 1 status
                            </td>
                            <td>
                                <span data-output="led_led1_status" data-output-colored>-</span>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>


        </div>
    </div>

</body>
</html>
