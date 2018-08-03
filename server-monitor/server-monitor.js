// function for adding thousands separators
function thousand_sep (x) {
    // devide into parts before and after dot
    var parts = x.toString().split(".");
    // use a space as thousands separator
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    // join parts back together and join
    return parts.join(".");
}

// function for making large number human readable by adding a suffix to
//   indicate size
function process_size (input) {
    input = String(input)
    // check the length of the number
    num_len = input.length;
    if (num_len > 9) {
        // add G suffix
        cut_point = num_len - 9;
        suffix = "G";
    } else if (num_len > 6) {
        // add M suffix
        cut_point = num_len - 6;
        suffix = "M";
    } else if (num_len > 3) {
        // add k suffix
        cut_point = num_len - 3;
        suffix = "k";
    } else {
        // return original number
        return input;
    }
    // preserve certain amount of decimals:
    // - preserve no decimals when whole number is 3 long or longer
    // - preserve 1 decimal when whole number is 2 long
    // - preserve 2 decimals when whole number is 1 long
    // calculate the length before the dot (whole number length)
    newnum_len = input.substr(0, cut_point).length;
    // create new number from given info
    if (newnum_len == 1) {
        after_decimal_length = 2;
    } else if (newnum_len == 2) {
        after_decimal_length = 1;
    } else {
        after_decimal_length = 0;
    }
    return input.substr(0, cut_point) +
           (after_decimal_length > 0 ? "." : "") +
           input.substr(cut_point, after_decimal_length) +
           suffix;
}

// function to get all data
function g () {
    // send an ajax request to the get.php page
    $.ajax({
        url: "get.php",
        type: "post", // send post request
        dataType: "json", // returned data type is JSON
        // function for if data is retrieved successfully
        success: function (data) {
            // log all of the data to the console
            console.log(data);
            // retrieve all data points and fill them into
            //   the document
            // get all elements where data needs to be filled in
            $( "[data-output],[data-output-graph]" ).each(function () {
                // get the current object and define it as variable
                var $obj = $( this );
                // get the output type requested
                var output_type = $obj.is("[data-output]") ?
                                  $obj.attr("data-output") :
                                  $obj.attr("data-output-graph");
                // check if the output type is given in the data
                // if not, set the HTML to be "N/A"
                if (!(output_type in data)) {
                    // the requested output is not available
                    $( this ).html( "N/A" );
                } else {
                    // the requested output is available
                    // process the returned value per output type
                    switch (output_type) {


                        // total cpu usage percentage
                        case "cpu_usage_total":
                        case "cpu_usage_core0":
                        case "cpu_usage_core1":
                        case "cpu_usage_core2":
                        case "cpu_usage_core3":
                        // get the value returned as number and string
                        var val_num = Number(data[output_type]);
                        var val_str = String(data[output_type]);
                        if ($obj.is("[data-output-graph]")) {
                            // insert graph entry into the graph
                            $obj.append( "<div class='graph_entry'>"+
                                "<div style='height: "+val_num+"%'></div>"+
                                "</div>");
                        } else {
                            // check if the background of the element needs to be
                            //   colored
                            if ($obj.is("[data-output-colored]")) {
                                // work in progress
                                // ...
                            }
                            // set the HTML of the object
                            // add percent sign to the value
                            $obj.html( val_num.toFixed(2) + "%" );
                        }
                        break;


                        // measured temperatures
                        case "temp_cpu":
                        // get the value returned as number and string
                        var val_num = Number(data[output_type]);
                        var val_str = String(data[output_type]);
                        // check if the object is a graph
                        if ($obj.is("[data-output-graph]")) {
                            // convert value to percetage with 0'C->0% and
                            //   100'C->100%
                            $obj.append("<div class='graph_entry'>"+
                                "<div style='height: "+val_num+"%'></div>"+
                                "</div>");
                        } else {
                            // set the HTML of the object with degrees attached
                            $obj.html( val_num.toFixed(1) + "°C" );
                        }
                        break;


                        // all types of requests for RAM usage
                        case "ram_total":
                        case "ram_used":
                        case "ram_free":
                        case "ram_shared":
                        case "ram_buff_cache":
                        case "ram_available":
                        // Number is too high to be coverted to number type
                        //   accurately, don't use directly in display!
                        var val_num = Number(data[output_type]);
                        var val_str = String(data[output_type]);
                        // check if a suffix should be added or a percentage
                        //   should be shown
                        if ($obj.is("[data-output-process]")) {
                            // add a suffix to the values when including it in the
                            //   html (when indicated)
                            // do this by letting the evaluation function for sizes
                            //   process the string
                            val_str = process_size(val_str);
                        } else if ($obj.is("[data-output-percent]")) {
                            total = Number(data["ram_total"]);
                            val_str = (val_num / total * 100).toFixed(2)+"%";
                        } else {
                            // add thousand separators to large number
                            val_str = thousand_sep(val_str);
                        }
                        $obj.html( val_str );
                        break;


                        // all types of storage requests
                        case "storage_total":
                        case "storage_used":
                        case "storage_free":
                        // Number is too high to be coverted to number type and
                        //   be used accurately, be careful when using this!
                        var val_num = Number(data[output_type]);
                        var val_str = String(data[output_type]);
                        // check if suffixes should be added
                        // also check if a percentage should be shown
                        if ($obj.is("[data-output-process]")) {
                            val_str = process_size(val_str);
                        } else if ($obj.is("[data-output-percent]")) {
                            // output percentage of total storage
                            total = Number(data["storage_total"]);
                            val_str = (val_num / total * 100).toFixed(2)+"%";
                        } else {
                            val_str = thousand_sep(val_str);
                        }
                        // output html processed to add optional suffixes or
                        //   thousand separators
                        $obj.html( val_str );
                        break;


                        default:
                        // the default is to just set the HTML to the data
                        //   that was returned
                        $obj.html( data[output_type] );
                        break;


                    }
                }
            });
            // set a timer to request an update again in 100ms
            setTimeout(g, 100);
        },
        error: function () {
            // set value of all elements that need to receive output to be an
            //   error message
            $( "[data-ouput]" ).html( "ERR" );
            // try again in 5 seconds
            setTimeout(g, 5000);
        }
    })
}

// initiate the updating when the document is loaded
$(function () {
    g();
});
