#!/bin/bash

# start JSON output
echo "{"


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
echo "\"network_wlan_state\":\""${wlan_state}"\","
echo "\"network_eth_state\":\""${eth_state}"\","
echo "\"network_connection_type\":\""${connection_type}"\","

# end JSON output
echo "\"NULL\":\"NULL\"}"
