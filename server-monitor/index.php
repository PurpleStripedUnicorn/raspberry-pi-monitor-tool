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
            <?php

            # list all of the filenames of the files containing the tile
            # list is in order of appearence
            $tile_list = array(
                "cpu",
                "ram",
                "storage",
                "temps",
                "leds",
                "network",
                "raw"
            );

            foreach ($tile_list as $tilename) {
                # display tile with tile file included
                echo "<div class='tile'>";
                include "tile/$tilename.php";
                echo "</div>";
            }

            ?>

        </div>
    </div>

</body>
</html>
