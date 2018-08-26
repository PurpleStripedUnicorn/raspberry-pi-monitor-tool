<?php include __DIR__."/init.php"; ?>
<?php

# start measuring processing time of the script
$start_time = microtime(true);

# function to convert all line endings to Linux line endings
function convert_lf ($string) {
    return preg_replace("/\r\n|\r|\n/", "\n", $string);
}

# function to get the content of a bash shell script inside the "get" folder
# output automatically converts all line endings to Linux line endings
function file_get ($file) {
    return convert_lf( file_get_contents( __DIR__ . "/get" . "/" . $file ) );
}

# function to get the result of a script file as an associative array
function assoc_from_script ($file) {
    # get the content of the file first
    $content = file_get( $file );
    # get the result output of the script
    exec( $content, $output );
    # combine the output lines with a comma for JSON support
    $output = join("", $output);
    # output is in JSON, convert it to an associative array and return it
    return json_decode($output, true, 512, JSON_BIGINT_AS_STRING);
}

# start with an empty result array to add results later
$result = array();



### CPU ###
# get the CPU usage (if available)
$result = array_merge( $result, assoc_from_script( "cpu.sh" ) );

### DISK SPACE ###
# get used and reserved disk space
$result = array_merge( $result, assoc_from_script( "storage.sh" ) );

### RAM USAGE/DISTRIBUTION ###
# get free and used ram distribution
$result = array_merge( $result, assoc_from_script( "ram.sh" ) );

### TEMPERATURES ###
# get the temperature of the CPU
$result = array_merge( $result, assoc_from_script( "temps.sh" ) );

### LED LIGHTS STATUS ###
# check if LEDs 0 and 1 are on or off
$result = array_merge( $result, assoc_from_script( "leds.sh" ) );

### TIME THIS SCRIPT TOOK ###
# time in microseconds
# start time is from start of the script
$result["query_time"] = number_format( (microtime(true) - $start_time), 3, ".", "," )."s";



# get the first result
echo json_encode($result);
