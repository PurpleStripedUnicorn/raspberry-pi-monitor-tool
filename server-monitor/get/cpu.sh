#!/bin/bash

# start JSON output
echo "{"


# get the current cpu usage since startup
usage_start="$(cat /proc/stat | awk '{ print ($2";"$4";"$5) }')"

# sleep for 0.5 seconds to measure difference
sleep 0.5

# measure again
usage_end="$(cat /proc/stat | awk '{ print ($2";"$4";"$5) }')"

# process results
total_vals="$(echo "$(echo "${usage_start}" | awk "NR==1 {print $1}");$(echo "${usage_end}" | awk "NR==1 {print $1}")")"
total_usage="$(echo "${total_vals}" | awk '{ split($1,b,";"); print ((b[4]-b[1]+b[5]-b[2])/(b[4]-b[1]+b[5]-b[2]+b[6]-b[3])*100) }' | awk '{ printf("%.2f\n", $1); }')"

core0_vals="$(echo "$(echo "${usage_start}" | awk "NR==2 {print $1}");$(echo "${usage_end}" | awk "NR==2 {print $1}")")"
core0_usage="$(echo "${core0_vals}" | awk '{ split($1,b,";"); print ((b[4]-b[1]+b[5]-b[2])/(b[4]-b[1]+b[5]-b[2]+b[6]-b[3])*100) }' | awk '{ printf("%.2f\n", $1); }')"

core1_vals="$(echo "$(echo "${usage_start}" | awk "NR==3 {print $1}");$(echo "${usage_end}" | awk "NR==3 {print $1}")")"
core1_usage="$(echo "${core1_vals}" | awk '{ split($1,b,";"); print ((b[4]-b[1]+b[5]-b[2])/(b[4]-b[1]+b[5]-b[2]+b[6]-b[3])*100) }' | awk '{ printf("%.2f\n", $1); }')"

core2_vals="$(echo "$(echo "${usage_start}" | awk "NR==4 {print $1}");$(echo "${usage_end}" | awk "NR==4 {print $1}")")"
core2_usage="$(echo "${core2_vals}" | awk '{ split($1,b,";"); print ((b[4]-b[1]+b[5]-b[2])/(b[4]-b[1]+b[5]-b[2]+b[6]-b[3])*100) }' | awk '{ printf("%.2f\n", $1); }')"

core3_vals="$(echo "$(echo "${usage_start}" | awk "NR==5 {print $1}");$(echo "${usage_end}" | awk "NR==5 {print $1}")")"
core3_usage="$(echo "${core3_vals}" | awk '{ split($1,b,";"); print ((b[4]-b[1]+b[5]-b[2])/(b[4]-b[1]+b[5]-b[2]+b[6]-b[3])*100) }' | awk '{ printf("%.2f\n", $1); }')"

# echo the results
echo "\"cpu_usage_total\":\""
echo ${total_usage}
echo "\","

echo "\"cpu_usage_core0\":\""
echo ${core0_usage}
echo "\","

echo "\"cpu_usage_core1\":\""
echo ${core1_usage}
echo "\","

echo "\"cpu_usage_core2\":\""
echo ${core2_usage}
echo "\","

echo "\"cpu_usage_core3\":\""
echo ${core3_usage}
echo "\","


# end JSON output
echo "\"NULL\":\"NULL\"}"
