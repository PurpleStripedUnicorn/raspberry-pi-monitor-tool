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
                                Ethernet state
                            </td>
                            <td>
                                <span data-output="network_eth_state" data-output-colored>-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                WLAN state
                            </td>
                            <td>
                                <span data-output="network_wlan_state" data-output-colored>-</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Connection type
                            </td>
                            <td>
                                <span data-output="network_connection_type">-</span>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>
</html>
