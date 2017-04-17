# plex-status
php Plex status using Plex server

Usage:


install shell-execute plugin

nano ~/plex-status.php

paste this: https://github.com/defser/plex-status/blob/master/plex-status.php

ctrl + X

enter

create a new device in pimatic:
{
“id”: “plex-samsung-tv”,
“name”: “Samsung TV”,
“class”: “ShellSensor”,
“attributeName”: “plex-samsung-tv”,
“attributeType”: “string”,
“command”: “php /home/pi/plex-status.php SERVER_IP SERVER_PORT DEVICE_ID”,
“interval”: 500
}

replace:
SERVER_IP: your local Plex server ip
SERVER_PORT: your local Plex server port
DEVICE_ID: the desired device from: http://SERVER_IP:SERVER_PORT/status/sessions
(if you get a 401 Unauthorized: add your ip and your rpi ip to the list of devices that can access the service without auth… make the ip of the rpi static in your router. don’t know how to do that? search it on google.)

DONE
