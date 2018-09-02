#!/bin/bash


# start JSON string
echo "{"


# function to get CPU results
# directly add them to the result by using echo
cpu()
{

    start_time=`date +%s%3N`

    # prepare CPU result string
    result=""

    # get the current cpu usage since startup
    usage_start="$(cat /proc/stat | awk '{ print ($2";"$4";"$5) }')"

    # sleep for 0.5 seconds to measure difference
    sleep 0.5

    # measure again
    usage_end="$(cat /proc/stat | awk '{ print ($2";"$4";"$5) }')"

    # process total usage
    total_vals="$(echo "$(echo "${usage_start}" | awk "NR==1 {print $1}");$(echo "${usage_end}" | awk "NR==1 {print $1}")")"
    total_usage="$(echo "${total_vals}" | awk '{ split($1,b,";"); print ((b[4]-b[1]+b[5]-b[2])/(b[4]-b[1]+b[5]-b[2]+b[6]-b[3])*100) }' | awk '{ printf("%.2f\n", $1); }')"

    # add total usage to result json
    result="${result}\"cpu_usage_total\":\""${total_usage}"\","

    # process per core usage

    # get the amount of cores in the system
    core_count="$(cat /proc/stat | grep '^cpu[0-9]' | wc -l)"

    # go through every numbered core
    n=0
    while [ ${n} -lt ${core_count} ]; do

        # get the row of /proc/stat to analyze for cpu usage
        core_row="$((${n} + 2))"
        # get the values of current core
        core_vals="$(echo "$(echo "${usage_start}" | awk "NR==${core_row} {print $1}");$(echo "${usage_end}" | awk "NR==${core_row} {print $1}")")"
        # calculate usage of the current core (rouded to 2 digits)
        core_usage="$(echo "${core_vals}" | awk '{ split($1,b,";"); print ((b[4]-b[1]+b[5]-b[2])/(b[4]-b[1]+b[5]-b[2]+b[6]-b[3])*100) }' | awk '{ printf("%.2f\n", $1); }')"
        # add core usage to result
        result="${result}\"cpu_usage_core${n}\":\""${core_usage}"\","

        n=$((${n} + 1))

    done

    # echo the results
    echo "${result}"

    # also echo the processing time of this part
    end_time=`date +%s%3N`
    process_time="$((end_time - start_time))"
    echo "\"process_time_cpu\":\""${process_time}"ms\","

}


# function to get LEDs results
# directly add them to the result by using echo
leds()
{

    start_time=`date +%s%3N`

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

    # also echo the processing time of this part
    end_time=`date +%s%3N`
    process_time="$((end_time - start_time))"
    echo "\"process_time_led\":\""${process_time}"ms\","

}


# function to get network results
# directly add them to the result by using echo
network()
{

    start_time=`date +%s%3N`

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

    # also echo the processing time of this part
    end_time=`date +%s%3N`
    process_time="$((end_time - start_time))"
    echo "\"process_time_network\":\""${process_time}"ms\","

}


# function to get RAM results
# directly add them to the result by using echo
ram()
{

    start_time=`date +%s%3N`

    # prepare result string
    result=""

    # get all ram information
    ram_info="$(free -b)"

    # add all RAM information to result
    result="${result}\"ram_total\":\"$(echo "${ram_info}" | awk '$2 { print $2 }' | sed -n '2 p')\","
    result="${result}\"ram_used\":\"$(echo "${ram_info}" | awk '$3 { print $3 }' | sed -n '2 p')\","
    result="${result}\"ram_free\":\"$(echo "${ram_info}" | awk '$4 { print $4 }' | sed -n '2 p')\","
    result="${result}\"ram_shared\":\"$(echo "${ram_info}" | awk '$5 { print $5 }' | sed -n '2 p')\","
    result="${result}\"ram_buff_cache\":\"$(echo "${ram_info}" | awk '$6 { print $6 }' | sed -n '2 p')\","
    result="${result}\"ram_available\":\"$(echo "${ram_info}" | awk '$7 { print $7 }' | sed -n '1 p')\","

    # echo result string
    echo ${result}

    # also echo the processing time of this part
    end_time=`date +%s%3N`
    process_time="$((end_time - start_time))"
    echo "\"process_time_ram\":\""${process_time}"ms\","

}


# function to get storage results
# directly add them to the result by using echo
storage()
{

    start_time=`date +%s%3N`

    # prepare result string
    result=""

    # get all info about storage
    storage_info="$(df --block-size 1 | sed -n '2 p')"

    # get all storage information
    # reserved = total - used - free
    result="${result}\"storage_total\":\"$(echo "${storage_info}" | awk '$2 { print $2 }')\","
    result="${result}\"storage_used\":\"$(echo "${storage_info}" | awk '$3 { print $3 }')\","
    result="${result}\"storage_free\":\"$(echo "${storage_info}" | awk '$4 { print $4 }')\","
    result="${result}\"storage_reserved\":\"$(echo "${storage_info}" | awk '{ print ($2 - $3 - $4) }')\","

    # echo result string
    echo ${result}

    # also echo the processing time of this part
    end_time=`date +%s%3N`
    process_time="$((end_time - start_time))"
    echo "\"process_time_storage\":\""${process_time}"ms\","

}


# function to get temperatures results
# directly add them to the result by using echo
temps()
{

    start_time=`date +%s%3N`

    # prepare result string
    result=""

    # CPU temperature in 'C
    result="${result}\"temp_cpu\":\"$(cat /sys/class/thermal/thermal_zone0/temp | awk '{ print ($1*0.001) }')\","

    # echo result string
    echo ${result}

    # also echo the processing time of this part
    end_time=`date +%s%3N`
    process_time="$((end_time - start_time))"
    echo "\"process_time_temps\":\""${process_time}"ms\","

}



# get all the results by running functions asynchronously
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
