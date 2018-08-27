
// function for getting a value on a grdient, input are objects of start and end
//   of gradient and the progress (0-1) through the gradient from start to end
function get_gradient (start, end, progress) {
    // scale progress differently
    // make low values a lot higher and high values a little bit higher
    progress = Math.sqrt(progress);
    // take the value of the progress on red, green and blue
    g_r = (end.r - start.r) * progress + start.r;
    g_g = (end.g - start.g) * progress + start.g;
    g_b = (end.b - start.b) * progress + start.b;
    obj = { r: g_r, g: g_g, b: g_b }
    // return the values as object
    return obj;
}

// function to return "get_gradient()" result as a string directly
// same inputs as "get_gradient()" function
function get_gradient_string (start, end, progress) {
    // get the gradient object
    gradient = get_gradient(start, end, progress);
    // convert to string
    s = "rgb(" + gradient.r + "," + gradient.g + "," + gradient.b + ")";
    // return the generated string
    return s;
}

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
    // get current number (without suffix)
    cur = input.substr(0, cut_point) +
          (after_decimal_length > 0 ? "." : "") +
          input.substr(cut_point, after_decimal_length);
    return cur + suffix;
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
            // set the alarm box to be empty at first
            alarm_box_text = [];

            // check all alarm triggers for the alarm box
            // check for high CPU usage (more than 80% avg.)
            if (Number(data["cpu_usage_total"]) >= 80) {
                alarm_box_text.push( "High CPU usage (" +
                    data["cpu_usage_total"] + "%)" );
            }
            // check for high RAM usage (lower than 100 MB free)
            if (Number(data["ram_free"]) <= 100000000) {
                alarm_box_text.push( "High RAM usage (" +
                    process_size(data["ram_free"]) + " free)" );
            }
            // check for high temps
            // above 80'C means thermal throtteling
            // above 65'C means high temp
            if (Number(data["temp_cpu"]) >= 80) {
                alarm_box_text.push( "CPU is thermal throtteling! (" +
                    Number(data["temp_cpu"]).toFixed(1) + "°C)" );
            } else if (Number(data["temp_cpu"]) >= 65) {
                alarm_box_text.push( "CPU is hot (" +
                    Number(data["temp_cpu"]).toFixed(1) + "°C)" );
            }

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
                                // change the background color based on a point
                                //   on a gradient
                                c_gradient_start = { r: 238, g: 238, b: 238 }
                                c_gradient_end = { r: 90, g: 150, b: 230 }
                                // get gradient string based on output value
                                // (devided by 100 for real value)
                                bg_color = get_gradient_string(
                                    c_gradient_start,
                                    c_gradient_end,
                                    val_num / 100
                                );
                                // make text white if over value 40%
                                color = (val_num > 40) ? "white" : "#666";
                                $obj.parent().css( "background-color", bg_color );
                                $obj.css( "color", color );
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
                        if ($obj.is("[data-output-graph]")) {
                            // make graph with color coded parts
                            // first, get the maximum of the graph from total
                            //   ram value
                            total = Number(data["ram_total"]);
                            // get all values as percentages of total (except for
                            //   free memory)
                            used = (Number(data["ram_used"]) / total * 100).toFixed(3);
                            shared = (Number(data["ram_shared"]) / total * 100).toFixed(3);
                            buff_cache = (Number(data["ram_buff_cache"]) / total * 100).toFixed(3);
                            // insert the entries into the graph
                            $obj.append("<div class='graph_entry'>" +
                                "<div style='height: " + shared + "%; background-color: #41d887;'></div>" +
                                "<div style='height: " + buff_cache + "%; background-color: #9a4ce8;'></div>" +
                                "<div style='height: " + used + "%; background-color: #ea8e54;'></div>" +
                                "</div>");
                        } else {
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
                        }
                        break;


                        // all types of storage requests
                        case "storage_total":
                        case "storage_used":
                        case "storage_free":
                        case "storage_reserved":
                        // Number is too high to be coverted to number type and
                        //   be used accurately, be careful when using this!
                        var val_num = Number(data[output_type]);
                        var val_str = String(data[output_type]);
                        // check if the output is a graph or not
                        if ($obj.is("[data-output-graph]")) {
                            // gather all info if object is a graph
                            total = Number(data["storage_total"]);
                            // get info as percentages
                            used = Number(data["storage_used"]) / total * 100;
                            reserved = Number(data["storage_reserved"]) / total * 100;
                            // insert the new data into the graph (override)
                            $obj.html("<div style='width: " + used + "%; background-color: #41d887;'></div>" +
                                "<div style='width: " + reserved + "%; background-color: #9a4ce8;'></div>");
                        } else {
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
                        }
                        break;


                        // status of indicator LEDs
                        case "led_led0_status":
                        case "led_led1_status":
                        var val_state = String(data[output_type]) == "1" ? true : false;
                        // check if the output box container should be colored
                        // use green for "on" and red for "off"
                        if ($obj.is("[data-output-colored]")) {
                            // always show white color
                            $obj.parent().css( "color", "white" );
                            if (val_state) {
                                // LED is on, turn green
                                $obj.parent().css( "background-color", "#41d887" );
                            } else {
                                // LED is off, turn red
                                $obj.parent().css( "background-color", "#d84841" );
                            }
                        }
                        // generate output html
                        out = val_state ? "on" : "off";
                        // output html
                        $obj.html( out );
                        break;


                        default:
                        // the default is to just set the HTML to the data
                        //   that was returned
                        $obj.html( data[output_type] );
                        break;


                    }
                }
            });

            // update the alarm box
            // check if there should be one first
            if (alarm_box_text.length == 0) {
                // no text was found, remove existing alarm box
                $( ".alarm_box" ).fadeOut();
            } else {
                // text was found, add alarm if it doesn't exist yet
                if ($( ".alarm_box" ).length == 0) {
                    $( "body" ).append("<div class='alarm_box'></div>");
                }
                // set the new text of the alarm box
                // leave line breaks between array items
                t = "";
                for (i = 0; i < alarm_box_text.length; i++) {
                    t += "<div>" + alarm_box_text[i] + "</div>";
                }
                $( ".alarm_box" ).html( t );
            }

            // set a timer to request an update again in 100ms
            setTimeout(g, 0);
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
