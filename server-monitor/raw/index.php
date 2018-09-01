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
                <h2 class="small_table_title">raw data</h2>
                <table class="small_table">
                    <tbody>

                        <!-- generate table in PHP -->
                        <?php

                        # generate the table by loading "get.php" once to get
                        #   all keys and values out of the associative array
                        # this associative array is generated from the JSON
                        #   output of the file

                        # first, get the file's result JSON
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

                            # insert key into the left column and value into the
                            #   right
                            echo "<tr><td>$key</td><td data-output='$key'>-</td></tr>";

                        }

                        ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>
</html>
