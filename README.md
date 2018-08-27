# Raspberry Pi Monitoring Tool

With this tool you can easily monitor many of your raspberry pi's parts. Please
read the following document before using the software on your website or server.

## How it works
You add the [server-monitor](../master/server-monitor/) folder to the root directory of
your website. Now go to your-website.com/server-monitor and see the results.
(You do not need a domain name, an IP address is enough)

## Requirements
The following things are or may be required for the monitoring tool to work properly:
* A raspberry pi 3 Model B (not tested on other devices)
* Apache is installed on your raspberry pi
* PHP is ready on your apache server
* All scripts have permission to use the "exec()" function in PHP (setting the folder's
permission to 777 is enough most of the time)
* Have the latest version of Raspbian installed

## Troubleshooting
It may be possible that you are experiencing bugs or other abnormalities. Please
make sure you have read the list included above and have confirmed all the
criteria are met, before reporting any bugs.

## How do I protect my server monitor?
By default, the server monitor isn't protected in any way from people looking
into your data. You can protect your data in several ways. A couple examples
are:
* Add a ".htaccess" file to the "server-monitor" folder. Add some rules to the
file to restrict access from the outside
* Add code to the "init.php" file, which runs on every page before the page is
shown to the user. You can use the "exit" command in PHP to prevent the page
from loading if necessary

## Other info
### Programming languages
The following programming languages and libraries were used for this tool:
* HTML
* JavaScript & jQuery
* CSS
* PHP
* Linux shell

### Fonts used
Fonts are from [Google Fonts](https://fonts.google.com/).
* Open Sans (by Steve Matteson)
* Maven Pro (by Joe Prince)
