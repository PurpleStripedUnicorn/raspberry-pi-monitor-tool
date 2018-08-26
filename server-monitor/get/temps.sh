#!/bin/bash

# start JSON output
echo "{"


# CPU temperature in 'C
echo "\"temp_cpu\":\""
cat /sys/class/thermal/thermal_zone0/temp | awk '{ print ($1*0.001) }'
echo "\","


# end JSON output
echo "\"NULL\":\"NULL\"}"
