#!/bin/bash

# start JSON output
echo "{"


# total storage
echo "\"storage_total\":\""
df --block-size 1 | awk '$2 { print $2 }' | sed -n '2 p'
echo "\","

# used storage
echo "\"storage_used\":\""
df --block-size 1 | awk '$3 { print $3 }' | sed -n '2 p'
echo "\","

# free storage
echo "\"storage_free\":\""
df --block-size 1 | awk '$4 { print $4 }' | sed -n '2 p'
echo "\","

# reserved storage
# reserved = total - used - free
echo "\"storage_reserved\":\""
df --block-size 1 | awk '{ print ($2 - $3 - $4) }' | sed -n '2 p'
echo "\","


# end JSON output
echo "\"NULL\":\"NULL\"}"
