<?php include "./head_message.html"; ?>
<!DOCTYPE html>
<html lang="en-gb">
<head>

    <!-- title at the top of the screen -->
    <title>Server monitor</title>

    <base href="./" />
    <?php include "./top.html"; ?>

</head>
<body>

    <div class="main_container">
        <div class="top_title">
            <h1>server monitor</h1>
        </div>
        <div class="content tile_container">

            <!-- all tiles with information -->
            <div class="tile">
                <?php include "tile/cpu.html"; ?>
            </div>
            <div class="tile">
                <?php include "tile/ram.html"; ?>
            </div>
            <div class="tile">
                <?php include "tile/storage.html"; ?>
            </div>
            <div class="tile">
                <?php include "tile/temps.html"; ?>
            </div>

        </div>
    </div>

</body>
</html>
