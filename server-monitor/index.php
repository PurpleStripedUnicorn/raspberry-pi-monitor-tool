<?php include __DIR__."/init.php"; ?>
<?php include "./head_message.php"; ?>
<!DOCTYPE html>
<html lang="en-gb">
<head>

    <title>Server monitor</title>

    <base href="./" />
    <?php include "./top.php"; ?>

</head>
<body>

    <div class="main_container">
        <?php include "top_title.php"; ?>
        <div class="content tile_container">

            <!-- all tiles with information -->
            <div class="tile">
                <?php include "tile/cpu.php"; ?>
            </div>
            <div class="tile">
                <?php include "tile/ram.php"; ?>
            </div>
            <div class="tile">
                <?php include "tile/storage.php"; ?>
            </div>
            <div class="tile">
                <?php include "tile/temps.php"; ?>
            </div>
            <div class="tile">
                <?php include "tile/leds.php"; ?>
            </div>
            <div class="tile">
                <?php include "tile/network.php"; ?>
            </div>

        </div>
    </div>

</body>
</html>
