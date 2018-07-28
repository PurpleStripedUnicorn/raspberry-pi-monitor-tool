<?php

$result = array();

$start_time = microtime(true);



### CPU USAGE ###
# first, check if this feature is supported
exec(
    "dpkg -s sysstat | grep 'install ok' | wc -l",
    $cpu_supported
);
if ($cpu_supported[sizeof($cpu_supported) - 1] == 1) {
    # feature is supported
    # one command to get all usage
    exec(
        "mpstat 1 1 -P ALL | awk '$12 ~ /[0-9.]+/ { print 100 - $12 }'",
        $cpu_usage
    );
    # all cores combined
    $result["cpu_usage"] = number_format( $cpu_usage[0], 2, ".", "," );
    # core 0
    $result["cpu_usage_core0"] = number_format( $cpu_usage[1], 2, ".", "," );
    # core 1
    $result["cpu_usage_core1"] = number_format( $cpu_usage[2], 2, ".", "," );
    # core 2
    $result["cpu_usage_core2"] = number_format( $cpu_usage[3], 2, ".", "," );
    # core 3
    $result["cpu_usage_core3"] = number_format( $cpu_usage[4], 2, ".", "," );
    $result["cpu_support"] = true;
} else {
    $result["cpu_support"] = false;
    sleep(1);
}



### CPU TEMPERATURE ###
exec(
    "cat /sys/class/thermal/thermal_zone0/temp",
    $cpu_temp
);
$cpu_temp = number_format((int)$cpu_temp[0] * 0.001, 1, ".", ",");
$result["cpu_temp"] = $cpu_temp . "°C";



### TOTAL DISK SPACE ###
exec(
    "df -h | awk '$2 { print $2 }' | sed -n '2 p'",
    $total_disk_space
);
$result["storage_total"] = $total_disk_space[0]."iB";



### FREE DISK SPACE ###
exec(
    "df -h | awk '$4 { print $4 }' | sed -n '2 p'",
    $free_disk_space
);
$result["storage_free"] = $free_disk_space[0]."iB";



### USED DISK SPACE ###
exec(
    "df -h | awk '$3 { print $3 }' | sed -n '2 p'",
    $used_disk_space
);
$result["storage_used"] = $used_disk_space[0]."iB";



### RAM USAGE/DISTRIBUTION ###
# one command for all info
exec(
    ("free -m | awk '$2 { print $2 }' | sed -n '2 p' && ".
     "free -m | awk '$3 { print $3 }' | sed -n '2 p' && ".
     "free -m | awk '$4 { print $4 }' | sed -n '2 p' && ".
     "free -m | awk '$5 { print $5 }' | sed -n '2 p' && ".
     "free -m | awk '$6 { print $6 }' | sed -n '2 p' && ".
     "free -m | awk '$7 { print $7 }' | sed -n '1 p'"),
    $ram_usage
);
$result["ram_total"] = $ram_usage[0]."M";
$result["ram_used"] = $ram_usage[1]."M";
$result["ram_free"] = $ram_usage[2]."M";
$result["ram_shared"] = $ram_usage[3]."M";
$result["ram_buff_cache"] = $ram_usage[4]."M";
$result["ram_available"] = $ram_usage[5]."M";



### TIME THIS SCRIPT TOOK ###
# time in microseconds
$result["query_time"] = number_format( (microtime(true) - $start_time), 3, ".", "," )."s";



# get the first result
echo json_encode($result);
