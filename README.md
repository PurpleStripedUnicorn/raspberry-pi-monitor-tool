# Raspberry Pi Monitoring Tool

With this tool you can easily monitor many of your raspberry pi's parts. Please
read the following document before using the software on your website or server.

## How it works
You add the [server-monitor folder](../master/server-monitor/) folder to the root directory of
your website. Now go to http://your-website.com/server-monitor and see the results.
(You do not need a domain name, an IP address is enough)

## Requirements
The following things are or may be required for the monitoring tool to work properly:
* A raspberry pi 3 Model B (not tested on other devices)
* Apache installed on your raspberry pi
* PHP ready on your apache server
* All scripts have permission to use the "exec()" function in PHP (setting the folder's
permission to 777 is enough most of the time)
* Have "sysstat" installed on your raspberry pi (for all features)
* Have the latest version of raspbian installed

## Troubleshooting
It may be possible that you are experiencing bugs or other abnormalities. Please
make sure you have read the list included above and have confirmed all the
criteria are met, before reporting any bugs.

## Other info
### Programming languages
The following programming languages and libraries were used for this tool:
* HTML
* JavaScript & jQuery
* CSS
* PHP
* Linux shell
