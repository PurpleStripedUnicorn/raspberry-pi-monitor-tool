<!DOCTYPE html>
<html lang="en-gb">
<head>

    <!-- title at the top of the screen -->
    <title>Server monitor</title>

    <!-- jQuery is required for script at the end of the document -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- main styling -->
    <link rel="stylesheet" type="text/css" href="server-monitor.css" />

</head>
<body>

    <div class="main_container">
        <div>
            <h1><span>server status</span></h1>

            <?php include "doc_table.php"; ?>

            <p class="tiny_bottom">
                <!-- time it took to process the last query -->
                Query processing time: <span data-output="query_time">0.000s</span>
            </p>
        </div>
    </div>

    <!-- script for updating the statistics -->
    <script type="text/javascript" src="server-monitor.js"></script>

</body>
</html>
