<?php include __DIR__."/init.php"; ?>
<?php

# start measuring processing time of the script
$start_time = microtime(true);

# start session if it hasn't already started
if (!isset($_SESSION)) {
    session_start();
}

# start with an empty result array to add results later
$GLOBALS["result"] = array();

# get the contents of the script that needs to be executed
# check if this content was already loaded at the first connection try and
#   cached into global variables
$GLOBALS["cache_allowed"] = ($_POST["cache"] == "true");
if ($GLOBALS["cache_allowed"] && isset($_SESSION["cached_command"])) {
    # don't reload the command because caching is on and it was already loaded
    $GLOBALS["result"]["cache"] = "true";
} else {
    # reload the command by accessing the file contents of "get.sh"
    # also measure the time it takes to get this file's contents
    $file_get_start_time = microtime(true);
    $_SESSION["cached_command"]["get.sh"] = file_get( "get.sh" );
    $GLOBALS["result"]["cache"] = "false";
    # add timing to result array
    $result["cache_refresh_time"] = number_format(
        (microtime(true) - $file_get_start_time), 6, ".", ","
    )."s";
}

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
    # get the content of the file first, this should already have been loaded at
    #   the start of the script
    $content = $_SESSION["cached_command"][$file];
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

# run the "get.sh" and add the JSON result to the result array
add_script( "get.sh" );

# calculate the time this script took in seconds (precision is microseconds)
# start time is from start of the script
$result["query_time"] = number_format( (microtime(true) - $start_time), 6, ".", "," )."s";

# echo the result encoded as JSON to be interpreted by javascript
echo json_encode($GLOBALS["result"]);
