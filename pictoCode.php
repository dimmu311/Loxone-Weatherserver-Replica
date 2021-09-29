<?php
function getIconId($typeNr) {
    $typeNr = (int) filter_var($typeNr, FILTER_SANITIZE_NUMBER_INT);  
    switch ($typeNr) {
        case 43:
            return 1;
        case 27:
        case 29:
            return 2;
        case 42:
            return 3;
        case 28:
            return 4;
        case 41:
            return 5;
        case 8:
        case 12:
        case 19:
            return 6;
        case -1:
            return 7;
        case 1:
        case 7:
        case 15:
        case 30:
        case 36:
            return 8;

        case 26:
            return 10;
        case 20:
        case 21:
            return 11;
        case 25:
            return 12;
        case 2:
        case 3:
        case 4:
        case 5:
        case 6:
            return 13;
        case 11:
        case 14:
            return 14;
        case 13:
        case 16:
        case 40:
            return 15;
        case -1:
            return 16;
        case 24:
            return 17;
        case 18:
        case 37:
        case 38:
            return 18;
        case -1:
            return 19;
        case 35:
            return 20;
        case 17:
        case 31:
        case 39:
            return 21;
        case 34:
            return 22;
        case -1:
            return 23;
        case 33:
            return 24;
        case 23:
            return 25;
        case -1:
            return 26;
        case 22:
            return 27;
        case -1:
            return 28;
        case 32:
            return 29;
        default:
            return 9;
    }
}

/*
"1":"wolkenlos",                        type_43	klar
"2":"heiter",                           type_27	Abnehmende Bedeckung    type_29	Unverändert	Sky
"3":"wolkig",                           type_42	Teilweise bewölkt
"4":"stark bewölkt",                    type_28	Zuhnemende Bedeckung
"5":"bedeckt",                          type_41	Bedeckt
"6":"Nebel",                            type_8	Nebel                   type_19	Dunst       type_12	Gefrierender Nebel
"7":"Hochnebel",
"8":"nicht verwendet",                  type_1	Schneeverwehungen	    type_7	Staubsturm  type_15	Wolkenschlauch/Tornado  type_30	Rauch oder Hitzeflimmern    type_36	Sturmbö
"9":"nicht verwendet",
"10":"leichter Regen",                  type_26	Leichter Regen
"11":"Regen",                           type_21	Regen	                type_20	Niederschlag
"12":"starker Regen",                   type_25	Starker Regen
"13":"Nieseln",                         type_2	Niesleregen	            type_4	Leichter Niesleregen    type_5	Starker Niesleregen/Regen   type_6	Leichter Niesleregen/Regen  type_3	Starker Niesleregen
"14":"leichter gefrierender Regen",     type_14	Leichter Gefrierender Regen	type_11	Leichter gefrierender Niesleregen/gefrierender Regen
"15":"starker gefrierender Regen",      type_13	Starker Gefrierender Regen  type_40	Hagel   type_16	Hagelschauer	Hail Showers    type_9	gefrierende Niederschläge   type_10	Starker gefrierender Niesleregen/gefrierender Regen
"16":"leichter Regenschauer",
"17":"kräftiger Regenschauer",          type_24	Regenschauer	Rain Showers
"18":"Gewitter",                        type_37	Gewitter    type_38	Gewitter ohne Niederschlag  type_18	Blitze ohne Donner
"19":"kräftiges Gewitter",
"20":"leichter Schneefall",             type_35	Leichter Schneefall
"21":"Schneefall",                      type_31	Schnee  type_39	Polarschnee type_17	Eis
"22":"starker Schneefall",              type_34	Starker Schneefall
"23":"leichter Schneeschauer",
"24":"starker Schneeschauer",           type_33	Schnee Schauer
"25":"leichter Schneeregen",            type_23	Leichter Regen und Schnee
"26":"Schneeregen",                     
"27":"starker Schneeregen",             type_22	Starker Regen und Schnee
"28":"leichter Schneeregenschauer",
"29":"kräftiger Schneeregenschauer"     type_32	Schnee und Regen Schauer

"1":"wolkenlos",
"2":"heiter",
"3":"wolkig",
"4":"stark bewölkt",
"5":"bedeckt",
"6":"Nebel",
"7":"Hochnebel",
"8":"nicht verwendet",
"9":"nicht verwendet",
"10":"leichter Regen",
"11":"Regen",
"12":"starker Regen",
"13":"Nieseln",
"14":"leichter gefrierender Regen",
"15":"starker gefrierender Regen",
"16":"leichter Regenschauer",
"17":"kräftiger Regenschauer",
"18":"Gewitter",
"19":"kräftiges Gewitter",
"20":"leichter Schneefall",
"21":"Schneefall",
"22":"starker Schneefall",
"23":"leichter Schneeschauer",
"24":"starker Schneeschauer",
"25":"leichter Schneeregen",
"26":"Schneeregen",
"27":"starker Schneeregen",
"28":"leichter Schneeregenschauer",
"29":"kräftiger Schneeregenschauer"

icon=
snow	Amount of snow is greater than zero
snow-showers-day	Periods of snow during the day
snow-showers-night	Periods of snow during the night
thunder-rain	Thunderstorms throughout the day or night
thunder-showers-day	Possible thunderstorms throughout the day
thunder-showers-night	Possible thunderstorms throughout the night
rain	Amount of rainfall is greater than zero
showers-day	Rain showers during the day
showers-night	Rain showers during the night
fog	Visibility is low (lower than one kilometer or mile)
wind	Wind speed is high (greater than 30 kph or mph)
cloudy	Cloud cover is greater than 90% cover
partly-cloudy-day	Cloud cover is greater than 20% cover during day time.
partly-cloudy-night	Cloud cover is greater than 20% cover during night time.
clear-day	Cloud cover is less than 20% cover during day time
clear-night	Cloud cover is less than 20% cover during day time

conditions=
type_1	Schneeverwehungen	Blowing Or Drifting Snow
type_2	Niesleregen	Drizzle
type_3	Starker Niesleregen	Heavy Drizzle
type_4	Leichter Niesleregen	Light Drizzle
type_5	Starker Niesleregen/Regen	Heavy Drizzle/Rain
type_6	Leichter Niesleregen/Regen	Light Drizzle/Rain
type_7	Staubsturm	Duststorm
type_8	Nebel	Fog
type_9	gefrierende Niederschläge	Freezing Drizzle/Freezing Rain
type_10	Starker gefrierender Niesleregen/gefrierender Regen	Heavy Freezing Drizzle/Freezing Rain
type_11	Leichter gefrierender Niesleregen/gefrierender Regen	Light Freezing Drizzle/Freezing Rain
type_12	Gefrierender Nebel	Freezing Fog
type_13	Starker Gefrierender Regen	Heavy Freezing Rain
type_14	Leichter Gefrierender Regen	Light Freezing Rain
type_15	Wolkenschlauch/Tornado	Funnel Cloud/Tornado
type_16	Hagelschauer	Hail Showers
type_17	Eis 	Ice
type_18	Blitze ohne Donner	Lightning Without Thunder
type_19	Dunst	Mist
type_20	Niederschlag 	Precipitation In Vicinity
type_21	Regen	Rain
type_22	Starker Regen und Schnee	Heavy Rain And Snow
type_23	Leichter Regen und Schnee	Light Rain And Snow
type_24	Regenschauer	Rain Showers
type_25	Starker Regen	Heavy Rain
type_26	Leichter Regen	Light Rain
type_27	Abnehmende Bedeckung	Sky Coverage Decreasing
type_28	Zuhnemende Bedeckung	Sky Coverage Increasing
type_29	Unverändert	Sky Unchanged
type_30	Rauch oder Hitzeflimmern	Smoke Or Haze
type_31	Schnee	Snow
type_32	Schnee und Regen Schauer 	Snow And Rain Showers
type_33	Schnee Schauer	Snow Showers
type_34	Starker Schneefall	Heavy Snow
type_35	Leichter Schneefall	Light Snow
type_36	Sturmbö	Squalls
type_37	Gewitter	Thunderstorm
type_38	Gewitter ohne Niederschlag	Thunderstorm Without Precipitation
type_39	Polarschnee	Diamond Dust
type_40	Hagel	Hail
type_41	Bedeckt	Overcast
type_42	Teilweise bewölkt	Partially cloudy
type_43	klar	Clear