#!/bin/bash


# start JSON string
echo "{"


# function to get CPU results
# directly add them to the result by using echo
cpu()
{

    # prepare CPU result string
    result=""

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

    # add test results to result string
    result="${result}\"cpu_usage_total\":\""${total_usage}"\","
    result="${result}\"cpu_usage_core0\":\""${core0_usage}"\","
    result="${result}\"cpu_usage_core1\":\""${core1_usage}"\","
    result="${result}\"cpu_usage_core2\":\""${core2_usage}"\","
    result="${result}\"cpu_usage_core3\":\""${core3_usage}"\","

    # echo the results
    echo "${result}"

}


# function to get LEDs results
# directly add them to the result by using echo
leds()
{

    # prepare result string
    result=""

    # Get status of LED 0
    result="${result}\"led_led0_status\":\""
    brightness=$(cat /sys/class/leds/led0/brightness)
    if [ ${brightness} -ge 1 ]; then
        result="${result}1"
    else
        result="${result}0"
    fi
    result="${result}\","


    # Get status of LED 1
    result="${result}\"led_led1_status\":\""
    brightness=$(cat /sys/class/leds/led1/brightness)
    if [ ${brightness} -ge 1 ]; then
        result="${result}1"
    else
        result="${result}0"
    fi
    result="${result}\","

    # echo the result string
    echo ${result}

}


# function to get network results
# directly add them to the result by using echo
network()
{

    # prepare result string
    result=""

    # get the status of the wifi connection (up or down)
    wlan_state="$(cat /sys/class/net/wlan0/operstate | awk '{ if ($0=="up") print "1"; else print "0" }')"

    # get the status of the ethernet connection (up or down)
    eth_state="$(cat /sys/class/net/eth0/operstate | awk '{ if ($0=="up") print "1"; else print "0" }')"

    # get the connection type, if both are on, set to ethernet
    connection_type="none"
    if [ ${eth_state} -eq 1 ]; then
        connection_type="eth"
    elif [ ${wlan_state} -eq 1 ]; then
        connection_type="wlan"
    fi

    # echo all data
    result="${result}\"network_wlan_state\":\""${wlan_state}"\","
    result="${result}\"network_eth_state\":\""${eth_state}"\","
    result="${result}\"network_connection_type\":\""${connection_type}"\","

    # echo result string
    echo ${result}

}


# function to get RAM results
# directly add them to the result by using echo
ram()
{

    # prepare result string
    result=""

    # add all RAM information to result
    result="${result}\"ram_total\":\"$(free -b | awk '$2 { print $2 }' | sed -n '2 p')\","
    result="${result}\"ram_used\":\"$(free -b | awk '$3 { print $3 }' | sed -n '2 p')\","
    result="${result}\"ram_free\":\"$(free -b | awk '$4 { print $4 }' | sed -n '2 p')\","
    result="${result}\"ram_shared\":\"$(free -b | awk '$5 { print $5 }' | sed -n '2 p')\","
    result="${result}\"ram_buff_cache\":\"$(free -b | awk '$6 { print $6 }' | sed -n '2 p')\","
    result="${result}\"ram_available\":\"$(free -b | awk '$7 { print $7 }' | sed -n '1 p')\","

    # echo result string
    echo ${result}

}


# function to get storage results
# directly add them to the result by using echo
storage()
{

    # prepare result string
    result=""

    # get all storage information
    # reserved = total - used - free
    result="${result}\"storage_total\":\"$(df --block-size 1 | awk '$2 { print $2 }' | sed -n '2 p')\","
    result="${result}\"storage_used\":\"$(df --block-size 1 | awk '$3 { print $3 }' | sed -n '2 p')\","
    result="${result}\"storage_free\":\"$(df --block-size 1 | awk '$4 { print $4 }' | sed -n '2 p')\","
    result="${result}\"storage_reserved\":\"$(df --block-size 1 | awk '{ print ($2 - $3 - $4) }' | sed -n '2 p')\","

    # echo result string
    echo ${result}

}


# function to get temperatures results
# directly add them to the result by using echo
temps()
{

    # prepare result string
    result=""

    # CPU temperature in 'C
    result="${result}\"temp_cpu\":\"$(cat /sys/class/thermal/thermal_zone0/temp | awk '{ print ($1*0.001) }')\","

    # echo result string
    echo ${result}

}



# get all the results by running functions asynchonously
leds &
leds_pid=$!
network &
network_pid=$!
ram &
ram_pid=$!
storage &
storage_pid=$!
temps &
temps_pid=$!

# wait for all results to come in
wait ${leds_pid} ${network_pid} ${ram_pid} ${storage_pid} ${temps_pid}

# measure CPU usage afterwards for more accurate results
cpu &
cpu_pid=$!

# wait for CPU results to come in
wait ${cpu_pid}

# end the JSON result
echo "\"NULL\":\"NULL\"}"
