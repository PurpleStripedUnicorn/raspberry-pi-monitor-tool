<?php include __DIR__."/init.php"; ?>
<?php

# start measuring processing time of the script
$start_time = microtime(true);

# function to convert all line endings to Linux line endings
function convert_lf ($string) {
    return preg_replace("/\r\n|\r|\n/", "\n", $string);
}

# function to get the content of a bash shell script inside the main folder
# output automatically converts all line endings to Linux line endings
function file_get ($file) {
    return convert_lf( file_get_contents( __DIR__ . "/" . $file ) );
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

# function to add a script to the JSON data that is loaded
# input is the filename of the script to add
function add_script ($filename) {
    # merge the already existing result array with the newly generated array
    $GLOBALS["result"] = array_merge(
        $GLOBALS["result"],
        assoc_from_script( $filename )
    );
}

# start with an empty result array to add results later
$GLOBALS["result"] = array();

# run the "get.sh" and add the JSON result to the result array
add_script( "get.sh" );

# calculate the time this script took in seconds (precision is microseconds)
# start time is from start of the script
$result["query_time"] = number_format( (microtime(true) - $start_time), 3, ".", "," )."s";

# echo the result encoded as JSON to be interpreted by javascript
echo json_encode($GLOBALS["result"]);
