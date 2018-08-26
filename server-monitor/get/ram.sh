#!/bin/bash

# start JSON output
echo "{"


# total ram
echo "\"ram_total\":\""
free -b | awk '$2 { print $2 }' | sed -n '2 p'
echo "\","

# ram used
echo "\"ram_used\":\""
free -b | awk '$3 { print $3 }' | sed -n '2 p'
echo "\","

# ram free
echo "\"ram_free\":\""
free -b | awk '$4 { print $4 }' | sed -n '2 p'
echo "\","

# ram shared
echo "\"ram_shared\":\""
free -b | awk '$5 { print $5 }' | sed -n '2 p'
echo "\","

# ram buff/cache
echo "\"ram_buff_cache\":\""
free -b | awk '$6 { print $6 }' | sed -n '2 p'
echo "\","

# ram available
echo "\"ram_available\":\""
free -b | awk '$7 { print $7 }' | sed -n '1 p'
echo "\","


# end JSON output
echo "\"NULL\":\"NULL\"}"
