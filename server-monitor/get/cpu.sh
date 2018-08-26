#!/bin/bash

# start JSON output
echo "{"


# CPU temperature in 'C
echo "\"temp_cpu\":\""
cat /sys/class/thermal/thermal_zone0/temp | awk '{ print ($1*0.001) }'
echo "\","


# check if the CPU usage can also be shown
# do this by checking if the sysstat package is installed
INSTA="$(dpkg -s sysstat | grep 'install ok' | wc -l)"
echo "\"sysstat_installed\":\"${INSTA}\","
# include sysstat installation status in the return JSON
if [ ${INSTA} = "1" ]; then

    # the package is installed
    # run test and get results

    # first run the test and save the results as a string
    # get the usage of all processing cores
    test_result="$(mpstat 1 1 -P ALL | awk '$12 ~ /[0-9.]+/ { print 100 - $12 }')"

    # total CPU usage
    echo "\"cpu_usage_total\":\""
    echo $test_result | awk '{ print $1 }'
    echo "\","

    # Core 0 CPU usage
    echo "\"cpu_usage_core0\":\""
    echo $test_result | awk '{ print $2 }'
    echo "\","

    # Core 1 CPU usage
    echo "\"cpu_usage_core1\":\""
    echo $test_result | awk '{ print $3 }'
    echo "\","

    # Core 2 CPU usage
    echo "\"cpu_usage_core2\":\""
    echo $test_result | awk '{ print $4 }'
    echo "\","

    # Core 3 CPU usage
    echo "\"cpu_usage_core3\":\""
    echo $test_result | awk '{ print $5 }'
    echo "\","

else

    # the package is not installed
    # wait 1 extra second (what the test would have taken)
    sleep 1

fi


# end JSON output
echo "\"NULL\":\"NULL\"}"
