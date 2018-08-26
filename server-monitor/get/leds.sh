#!/bin/bash

# start JSON output
echo "{"


# Get status of LED 0
echo "\"led_led0_status\":\""
brightness=$(cat /sys/class/leds/led0/brightness)
if [ ${brightness} -ge 1 ]; then
    echo "1"
else
    echo "0"
fi
echo "\","


# Get status of LED 1
echo "\"led_led1_status\":\""
brightness=$(cat /sys/class/leds/led1/brightness)
if [ ${brightness} -ge 1 ]; then
    echo "1"
else
    echo "0"
fi
echo "\","


# end JSON output
echo "\"NULL\":\"NULL\"}"
