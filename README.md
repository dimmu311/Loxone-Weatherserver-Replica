# Loxone-Weatherserver-Replica
This is a replica of the Loxone Cloud Weather Service based on a free weather api

As you know, you can by diffrent licences of Loxone Cloud Wether Server.
during my work with the Loxone Miniserver Websocket Api i coincidentally found out how this cloud Service Works.

## Behind the Scenes
It is a realy simple thing:
The Miniserver asks after Reboot/Prog Upload and then every Hour at the Loxone Cloud Weather Server for the actual and forcast data.
This is done by a simple HTTP/Get request.
See this request:

```code
http://weather.loxone.com:6066/forecast/?user=loxone_<MINISERVER_MAC_ADDRESS>&coord=<LONGITUDE>,<LATITUDE>&asl=<SEEHIGHT>&format=1
```

You don't need the enable anything in the Miniserver. The Miniserver makes all automaticly. The whole magic is in the Cloud Service.

If you have enabled Cloud Weather Server in your Loxone Account (or your partner has done for you) the cloud will answer the request with a mix of xml and csv with all the availible weather data. If you not have enabled the cloud answer with a fault.

## How to enable free Weather Server
So the first thing to do is to redirect the HTTP request to your own Server.
You have two options:

- if you can edit DNS Records in your Internet Router then redirect ``http://weather.loxone.com`` to your own web server.
- setup your own DNS Server, e.g. dnsmasq and redirect ``http://weather.loxone.com`` to your own web server. At this point you need tho change also the entry in Loxone Minserver Ethernet settings to your local DNS Server.

The next Step is to setup a Webserver that taks the request from the Minserver, requests weather data from a diffrent wetter api, format this that it looks like the original Loxone Weather Server response and response this back to the Miniserver.

You can use this soruce code. As Weather Api it uses ``www.visualcrossing.com``. Go there and get a api key and put it in the ``config.php``.

Next have fun with free Weather Server.


## Known issus
- not all fileds are available at free weather api. i have testet diffrent ons, but no one of them deliver all needed values. In this one there are all fields you can see in the App available, but not all that you can use in Config.
- picto names needs to be mapped to numbers
- there is one fild i don't know the meaning.

if you find any other issu feel free to post them.


