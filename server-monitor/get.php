<?php include __DIR__."/init.php"; ?>
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
    $result["cpu_usage_total"] = (string)$cpu_usage[0];
    # core 0
    $result["cpu_usage_core0"] = (string)$cpu_usage[1];
    # core 1
    $result["cpu_usage_core1"] = (string)$cpu_usage[2];
    # core 2
    $result["cpu_usage_core2"] = (string)$cpu_usage[3];
    # core 3
    $result["cpu_usage_core3"] = (string)$cpu_usage[4];
} else {
    sleep(1);
}



### CPU TEMPERATURE ###
exec(
    "cat /sys/class/thermal/thermal_zone0/temp",
    $cpu_temp
);
$cpu_temp = (string)((int)$cpu_temp[0] * 0.001);
$result["temp_cpu"] = $cpu_temp;



### DISK SPACE ###
# use 1 command to get all info
exec(
    ("df --block-size 1 | awk '$2 { print $2 }' | sed -n '2 p' && ".
     "df --block-size 1 | awk '$3 { print $3 }' | sed -n '2 p' && ".
     "df --block-size 1 | awk '$4 { print $4 }' | sed -n '2 p' && ".
     "df --block-size 1 | awk '{ print ($2 - $3 - $4) }' | sed -n '2 p'"),
    $disk_space
);
$result["storage_total"] = (string)$disk_space[0];
$result["storage_used"] = (string)$disk_space[1];
$result["storage_free"] = (string)$disk_space[2];
$result["storage_reserved"] = (string)$disk_space[3];



### RAM USAGE/DISTRIBUTION ###
# one command for all info
# all returned values are in megabytes
exec(
    ("free -b | awk '$2 { print $2 }' | sed -n '2 p' && ".
     "free -b | awk '$3 { print $3 }' | sed -n '2 p' && ".
     "free -b | awk '$4 { print $4 }' | sed -n '2 p' && ".
     "free -b | awk '$5 { print $5 }' | sed -n '2 p' && ".
     "free -b | awk '$6 { print $6 }' | sed -n '2 p' && ".
     "free -b | awk '$7 { print $7 }' | sed -n '1 p'"),
    $ram_usage
);
$result["ram_total"] = (string)$ram_usage[0];
$result["ram_used"] = (string)$ram_usage[1];
$result["ram_free"] = (string)$ram_usage[2];
$result["ram_shared"] = (string)$ram_usage[3];
$result["ram_buff_cache"] = (string)$ram_usage[4];
$result["ram_available"] = (string)$ram_usage[5];



### TIME THIS SCRIPT TOOK ###
# time in microseconds
$result["query_time"] = number_format( (microtime(true) - $start_time), 3, ".", "," )."s";



# get the first result
echo json_encode($result);
