<?php

use App\Models\Project;
use Grimzy\LaravelMysqlSpatial\Types\Geometry;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Seeder;

class ProjectPointsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Using a Factory to seed data.
    // https://laravel.com/docs/5.8/database-testing#writing-factories

    $this->AddProjectPointFromJSON(
      51.53974257010371,
      5.503828525543213,
      'eten en drinken',
      "De Vresselse Hut",
      "Bij De Vresselse Hut kun je kegelen, maar ook diverse activiteiten, feesten, partijen en vergaderingen worden hier georganiseerd. Er is ook een terras waar je een drankje en een hapje van de kleine kaart kunt nuttigen.",
      '{
            "type": "Feature",
            "properties": {
              "marker-color": "#7e7e7e",
              "marker-size": "medium",
              "bezienswaardigheid_naam": "De Vresselse Hut",
              "beschrijving": "Bij De Vresselse Hut kun je kegelen,maar ook diverse activiteiten, feesten, partijen en vergaderingen worden hier georganiseerd. Er is ook een terras waar je een drankje en een hapje van de kleine kaart kunt nuttigen.",
              "frequentie": "altijd",
              "categorie": "Eten & Drinken",
              "stroke": ""
            },
            "geometry": {
              "type": "Point",
              "coordinates": [
                5.503828525543213,
                51.53974257010371
              ]
            }
          }'
    );
    $this->AddProjectPointFromJSON(
      51.5718,
      5.2389,
      'natuurgebied',
      "Oisterwijkse Bossen en Vennen",
      " ",
      '{
        "type": "Feature",
        "properties": {
          "stroke": "#008000",
                  "stroke-width": 2,
          "stroke-opacity": 1,
          "fill": "#0ea701",
          "fill-opacity": 0.5,
          "gebied_naam": "Oisterwijkse Bossen en Vennen",
          "categorie": "Natuurgebied",
          "frequentie": "altijd"
        },
        "geometry": {
          "type": "Polygon",
          "coordinates": [
            [
              [
                5.2349768534745325,
                51.57824557639225
              ],
              [
                5.231558733647413,
                51.579098424176195
              ],
              [
                5.227251902665242,
                51.57814323465817
              ],
              [
                5.227422808656598,
                51.57686396298225
              ],
              [
                5.225030124777614,
                51.57621579866645
              ],
              [
                5.221236011769512,
                51.576011115198305
              ],
              [
                5.217305173968325,
                51.577290386874225
              ],
              [
                5.213887054141205,
                51.57526060914843
              ],
              [
                5.212485625012087,
                51.57398133747251
              ],
              [
                5.211802001046662,
                51.57195155974672
              ],
              [
                5.209580223159035,
                51.5709963702287
              ],
              [
                5.207187539280051,
                51.56939301639488
              ],
              [
                5.203564332263304,
                51.56854016861094
              ],
              [
                5.202026178341101,
                51.5697000415971
              ],
              [
                5.197377535376218,
                51.56842076992118
              ],
              [
                5.193788509557743,
                51.56726089693501
              ],
              [
                5.192079449644183,
                51.56598162525909
              ],
              [
                5.190165302540996,
                51.56415653100145
              ],
              [
                5.189481678575572,
                51.562024411541586
              ],
              [
                5.190165302540996,
                51.560745139865666
              ],
              [
                5.1903703897306235,
                51.558613020405794
              ],
              [
                5.192592167618251,
                51.558613020405794
              ],
              [
                5.194472133523167,
                51.5569073248379
              ],
              [
                5.195155757488591,
                51.55392235759409
              ],
              [
                5.197377535376218,
                51.552950111120396
              ],
              [
                5.203222520280592,
                51.5518925798683
              ],
              [
                5.206503915314627,
                51.552421345494345
              ],
              [
                5.212485625012087,
                51.55317185154422
              ],
              [
                5.215596114054765,
                51.55434878148606
              ],
              [
                5.21833060991646,
                51.5562591605221
              ],
              [
                5.221782910941851,
                51.555303971004086
              ],
              [
                5.225201030768971,
                51.55412704106224
              ],
              [
                5.230362391707921,
                51.55487754711211
              ],
              [
                5.2354895714486,
                51.55562805316198
              ],
              [
                5.234293229509108,
                51.55648090094593
              ],
              [
                5.230875109681989,
                51.556685584414076
              ],
              [
                5.229507861751141,
                51.55839127998197
              ],
              [
                5.226568278699818,
                51.55967055165789
              ],
              [
                5.225201030768971,
                51.561495645915535
              ],
              [
                5.227593714647954,
                51.56181972807344
              ],
              [
                5.2322423576128365,
                51.562126753275656
              ],
              [
                5.234805947483176,
                51.56287725932553
              ],
              [
                5.236685913388092,
                51.564054189267374
              ],
              [
                5.238600060491279,
                51.56533346094329
              ],
              [
                5.241847274327042,
                51.56523111920922
              ],
              [
                5.242530898292466,
                51.56480469531725
              ],
              [
                5.245812293326501,
                51.56490703705132
              ],
              [
                5.248717695179552,
                51.56608396699317
              ],
              [
                5.248204977205484,
                51.56789200429513
              ],
              [
                5.252853620170367,
                51.56939301639488
              ],
              [
                5.253024526161723,
                51.57258266710684
              ],
              [
                5.255759022023418,
                51.57386193878276
              ],
              [
                5.267414810633896,
                51.57270206579659
              ],
              [
                5.277737532511797,
                51.57398133747251
              ],
              [
                5.282351994278407,
                51.57578937477448
              ],
              [
                5.283035618243831,
                51.57824557639225
              ],
              [
                5.282864712252476,
                51.58070177801001
              ],
              [
                5.280301122382136,
                51.582288074888154
              ],
              [
                5.277053908546372,
                51.58358440351975
              ],
              [
                5.274285231486406,
                51.58431785261394
              ],
              [
                5.2741143254950495,
                51.58529009908764
              ],
              [
                5.275139761443185,
                51.58656937076356
              ],
              [
                5.27496885545183,
                51.58805332590763
              ],
              [
                5.254904492066638,
                51.586995794655536
              ],
              [
                5.251281285049892,
                51.58559712428986
              ],
              [
                5.249914037119044,
                51.58677405423171
              ],
              [
                5.2480340712141285,
                51.58571652297962
              ],
              [
                5.24235999230111,
                51.5844372513037
              ],
              [
                5.2428727102751775,
                51.58315797962778
              ],
              [
                5.239112778465347,
                51.58058237932026
              ],
              [
                5.2349768534745325,
                51.57824557639225
              ]
            ]
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.49947637969359,
      5.43411523103714,
      'activiteit',
      'Familiepark DippieDoe',
      ' ',
      '{
        "type": "Feature",
        "properties": {
          "marker-color": "#7e7e7e",
          "marker-size": "medium",
          "bezienswaardigheid_naam": "Familiepark DippieDoe",
          "beschrijving": "geen",
          "frequentie": "altijd",
          "categorie": "Activiteit",
          "stroke-opacity": ""
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.43411523103714,
            51.49947637969359
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.50365386157651,
      5.310038924217224,
      'activiteit',
      'Oirschotse stoel Jan Appels',
      ' ',
      '{
        "type": "Feature",
        "properties": {
          "marker-color": "#7e7e7e",
          "marker-size": "medium",
          "bezienswaardigheid_naam": "Oirschotse stoel Jan Appels",
          "beschrijving": "geen",
          "frequentie": "altijd",
          "categorie": "Activiteit"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.310038924217224,
            51.50365386157651
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.5414,
      5.3589,
      'natuurgebied',
      'De Mortelen',
      ' ',
      '{
        "type": "Feature",
        "properties": {
          "stroke": "#008000",
          "stroke-width": 2,
          "stroke-opacity": 1,
          "fill": "#0ea701",
          "fill-opacity": 0.5,
          "gebied_naam": "De Mortelen",
          "frequentie": "altijd",
          "categorie": "Natuurgebied"
        },
        "geometry": {
          "type": "Polygon",
          "coordinates": [
            [
              [
                5.3852032198764315,
                51.52978676530841
              ],
              [
                5.383118166781888,
                51.53405100422814
              ],
              [
                5.387083185781346,
                51.53459682680987
              ],
              [
                5.390843117591178,
                51.53672894626973
              ],
              [
                5.395320854564704,
                51.5382129014138
              ],
              [
                5.396175384521484,
                51.539816255247615
              ],
              [
                5.3922103655220255,
                51.541965431663165
              ],
              [
                5.389304963668974,
                51.54377346896513
              ],
              [
                5.38431450872138,
                51.54600793015907
              ],
              [
                5.380896388894261,
                51.5455815062671
              ],
              [
                5.374709592007174,
                51.546980176632765
              ],
              [
                5.364421051327545,
                51.55081799166052
              ],
              [
                5.361857461457205,
                51.54996514387658
              ],
              [
                5.357550630475035,
                51.55028922603448
              ],
              [
                5.355841570561475,
                51.55284776938632
              ],
              [
                5.3527310815187965,
                51.553700617170264
              ],
              [
                5.342442540839167,
                51.556685584414076
              ],
              [
                5.339537138986115,
                51.556054477053955
              ],
              [
                5.336768461926149,
                51.55487754711211
              ],
              [
                5.335059402012589,
                51.55347887674644
              ],
              [
                5.334033966064453,
                51.55167083944447
              ],
              [
                5.329727135082282,
                51.55146615597633
              ],
              [
                5.3293853230995705,
                51.55039156776855
              ],
              [
                5.332324906150894,
                51.54846413177683
              ],
              [
                5.333692154081741,
                51.546980176632765
              ],
              [
                5.335913931969369,
                51.54633201231697
              ],
              [
                5.335230308003945,
                51.54430223459117
              ],
              [
                5.329727135082282,
                51.544523975015004
              ],
              [
                5.325967203272452,
                51.5435517285413
              ],
              [
                5.321831278281637,
                51.54184603297341
              ],
              [
                5.31619138056689,
                51.54184603297341
              ],
              [
                5.31533685061011,
                51.54302296291525
              ],
              [
                5.313251797515567,
                51.544421633280926
              ],
              [
                5.312568173550143,
                51.546434354051044
              ],
              [
                5.3108591136365835,
                51.546980176632765
              ],
              [
                5.309150053723024,
                51.54783302441671
              ],
              [
                5.307270087818108,
                51.54783302441671
              ],
              [
                5.305185034723565,
                51.54911229609263
              ],
              [
                5.303475974810006,
                51.551039732084355
              ],
              [
                5.300399666965598,
                51.55081799166052
              ],
              [
                5.300399666965598,
                51.54943637825053
              ],
              [
                5.299545137008818,
                51.546980176632765
              ],
              [
                5.299545137008818,
                51.544523975015004
              ],
              [
                5.29988694899153,
                51.54227245686538
              ],
              [
                5.3029632568359375,
                51.54227245686538
              ],
              [
                5.306381376663057,
                51.543244703339084
              ],
              [
                5.307953711783532,
                51.54227245686538
              ],
              [
                5.307270087818108,
                51.54003799567144
              ],
              [
                5.309150053723024,
                51.53961157177947
              ],
              [
                5.312909985532855,
                51.539713913513545
              ],
              [
                5.314995038627398,
                51.53938983135564
              ],
              [
                5.319096782419941,
                51.539816255247615
              ],
              [
                5.31619138056689,
                51.53811055967972
              ],
              [
                5.317558628497737,
                51.53705302842763
              ],
              [
                5.321831278281637,
                51.53544967459381
              ],
              [
                5.324599955341603,
                51.53459682680987
              ],
              [
                5.329727135082282,
                51.53459682680987
              ],
              [
                5.333521248090385,
                51.535654358061954
              ],
              [
                5.3381698910552675,
                51.5374794523196
              ],
              [
                5.341588010882387,
                51.537360053629854
              ],
              [
                5.343467976787303,
                51.536626604535655
              ],
              [
                5.346749371821337,
                51.53640486411183
              ],
              [
                5.348800243717609,
                51.5374794523196
              ],
              [
                5.351363833587949,
                51.5368312880038
              ],
              [
                5.354132510647916,
                51.53597844021986
              ],
              [
                5.355670664570119,
                51.534903852012086
              ],
              [
                5.359088784397239,
                51.534272744651965
              ],
              [
                5.361857461457205,
                51.53577375675171
              ],
              [
                5.3657882992583925,
                51.53544967459381
              ],
              [
                5.36715554718924,
                51.53341989686802
              ],
              [
                5.370095130240563,
                51.53341989686802
              ],
              [
                5.373000532093615,
                51.53394866249406
              ],
              [
                5.375222309981242,
                51.532993472976045
              ],
              [
                5.374709592007174,
                51.53106603698433
              ],
              [
                5.376247745929378,
                51.528183411474586
              ],
              [
                5.379700046954769,
                51.52850749363249
              ],
              [
                5.3852032198764315,
                51.52978676530841
              ]
            ]
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.618827585051214,
      5.43486088514328,
      'eten en drinken',
      'De Glazen Boerderij',
      ' ',
      '{
        "type": "Feature",
        "properties": {
          "marker-symbol": "",
          "marker-color": "#7e7e7e",
          "marker-size": "medium",
          "bezienswaardigheid_naam": "De Glazen Boerderij",
          "beschrijving": "geen",
          "frequentie": "altijd",
          "categorie": "Eten & Drinken"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.43486088514328,
            51.618827585051214
          ]
        }
      }'
      
    );
    $this->AddProjectPointFromJSON(
      51.59444853503294,
      5.233080983161926,
      'eten en drinken',
      'Pannekoekenhuis Belveren in Haaren',
      ' ',
      '{
        "type": "Feature",
        "properties": {
          "marker-color": "#7e7e7e",
          "marker-size": "medium",
          "bezienswaardigheid_naam": "Pannekoekenhuis Belveren in Haaren",
          "beschrijving": "geen",
          "frequentie": "altijd",
          "categorie": "Eten & Drinken"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.233080983161926,
            51.59444853503294
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.50537683608064,
      5.357208251953125,
      'activiteit',
      'De wijk Heikandt in Aarle',
      'Wandeling in het kader van 200 jaar Best.',
      '{
        "type": "Feature",
        "properties": {
          "marker-symbol": "",
          "marker-color": "#7e7e7e",
          "marker-size": "medium",
          "beschrijving": "Wandeling in het kader van 200 jaar Best.",
          "bezienswaardigheid_naam": "De wijk Heikandt in Aarle",
          "stroke-opacity": "",
          "frequentie": "Zaterdag 13 april",
          "gebied_naam": "",
          "categorie": "Activiteit"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.357208251953125,
            51.50537683608064
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.49944632447973,
      5.364031791687012,
      'activiteit',
      'Lentefeest bij Buurtvrij',
      'Vandaag vieren we de lente!  Dit doen we met veel bloemen, hutten bouwen, interieur styling, workshops, graffiti, BBQ en nog veel meer.',
      '{
        "type": "Feature",
        "properties": {
          "marker-symbol": "",
          "marker-size": "medium",
          "bezienswaardigheid_naam": "Lentefeest bij Buurtvrij",
          "beschrijving": "Vandaag vieren we de lente!  Dit doen we met veel bloemen, hutten bouwen, interieur styling, workshops, graffiti, BBQ en nog veel meer.",
          "marker-color": "#7e7e7e",
          "frequentie": "Zondag 14 april ",
          "categorie": "Activiteit"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.364031791687012,
            51.49944632447973
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.516728140021236,
      5.353946685791016,
      'activiteit',
      'Workshop paasstuk maken',
      'Op zaterdag 13 april a.s. organiseert Team De vlinder in samenwerking met Winterfestijn Best een workshop Paasstukjes maken voor het goede doel. De workshop vindt plaats in de werkplaats van Ad Raaijmakers Akkerbouw en Gewasverzorging in Best. Onder het genot van een kopje koffie of thee en wat lekkers wordt gewerkt aan de mooiste paasstukken.',
      '{
        "type": "Feature",
        "properties": {
          "marker-symbol": "",
          "bezienswaardigheid_naam": "Workshop paasstuk maken",
          "beschrijving": "Op zaterdag 13 april a.s. organiseert Team De vlinder in samenwerking met Winterfestijn Best een workshop Paasstukjes maken voor het goede doel. De workshop vindt plaats in de werkplaats van Ad Raaijmakers Akkerbouw en Gewasverzorging in Best. Onder het genot van een kopje koffie of thee en wat lekkers wordt gewerkt aan de mooiste paasstukken. ",
          "frequentie": "Zaterdag 13 april",
          "marker-color": "#7e7e7e",
          "marker-size": "medium",
          "categorie": "Activiteit"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.353946685791016,
            51.516728140021236
          ]
          }
        }'
    );
    $this->AddProjectPointFromJSON(
      51.55690237162714,
      5.2020263671875,
      'bezienswaardigheid',
      'Kolkven',
      'Maak een leuke korte wandeling door het Oisterwijkse bos langs enkele vennen, waaronder het Kolkven.',
      '{
        "type": "Feature",
        "properties": {
          "marker-symbol": "",
          "bezienswaardigheid_naam": "Kolkven",
          "beschrijving": "Maak een leuke korte wandeling door het Oisterwijkse bos langs enkele vennen, waaronder het Kolkven.",
          "categorie": "Bezienswaardigheid",
          "frequentie": "altijd",
          "marker-color": "#7e7e7e",
          "marker-size": "medium"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.2020263671875,
            51.55690237162714
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.5863548288564,
      5.177282989025116,
      'bezienswaardigheid',
      'Kerkhovense Molen',
      'De Kerkhovense Molen of Onvermoeid is een ronde stenen stellingmolen te Oisterwijk.',
      '{
        "type": "Feature",
        "properties": {
          "frequentie": "altijd",
          "bezienswaardigheid_naam": "Kerkhovense Molen",
          "beschrijving": "De Kerkhovense Molen of Onvermoeid is een ronde stenen stellingmolen te Oisterwijk.",
          "categorie": "Bezienswaardigheid",
          "marker-color": "#7e7e7e",
          "marker-size": "medium"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.177282989025116,
            51.5863548288564
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.589297858596424,
      5.231863260269165,
      'bezienswaardigheid',
      'Kasteel Nemerlaer',
      'Kasteel Nemerlaer is een 14e-eeuws kasteel, gelegen in Haaren, in de Nederlandse provincie Noord-Brabant',
      '{
        "type": "Feature",
        "properties": {
          "bezienswaardigheid_naam": "Kasteel Nemerlaer",
          "beschrijving": "Kasteel Nemerlaer is een 14e-eeuws kasteel, gelegen in Haaren, in de Nederlandse provincie Noord-Brabant",
          "categorie": "Bezienswaardigheid ",
          "frequentie": "altijd",
          "marker-color": "#7e7e7e",
          "marker-size": "medium"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.231863260269165,
            51.589297858596424
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.465130385364795,
      5.266613960266113,
      'bezienswaardigheid',
      'Oude Toren',
      'De Oude Toren is een middeleeuwse kerktoren bij Oostelbeers in de gemeente Oirschot in de Nederlandse provincie Noord-Brabant.',
      '{
        "type": "Feature",
        "properties": {
          "marker-symbol": "",
          "beschrijving": "De Oude Toren is een middeleeuwse kerktoren bij Oostelbeers in de gemeente Oirschot in de Nederlandse provincie Noord-Brabant.",
          "bezienswaardigheid_naam": "Oude Toren",
          "categorie": "Bezienwaardigheid",
          "frequentie": "altijd",
          "marker-color": "#7e7e7e",
          "marker-size": "medium"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.266613960266113,
            51.465130385364795
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.543132343985604,
      5.130336284637451,
      'eten en drinken',
      'Abdij Koningshoeven',
      'Het ligt vlakbij het Landschapspark Moerenburg waar je heerlijk kunt wandelen. Daarnaast zijn er fietsroutes beschikbaar die je vanaf het trappistenklooster door karakteristieke dorpjes als Oisterwijk en Oirschot leiden. Ideale sportlocatie. Binnen de muren van klooster Abdij Koningshoeven brouwen de Benedictijner monniken het ambachtelijke trappistenbier La Trappe.',
      '{
        "type": "Feature",
        "properties": {
          "marker-color": "#7e7e7e",
          "marker-size": "medium",
          "bezienswaardigheid_naam": "Abdij Koningshoeven",
          "beschrijving": "Het ligt vlakbij het Landschapspark Moerenburg waar je heerlijk kunt wandelen. Daarnaast zijn er fietsroutes beschikbaar die je vanaf het trappistenklooster door karakteristieke dorpjes als Oisterwijk en Oirschot leiden. Ideale sportlocatie. Binnen de muren van klooster Abdij Koningshoeven brouwen de Benedictijner monniken het ambachtelijke trappistenbier La Trappe.",
          "stroke": "",
          "stroke-width": "",
          "stroke-opacity": "",
          "fill": "",
          "fill-opacity": "",
          "gebied_naam": "",
          "frequentie": "altijd",
          "categorie": "Museum / Eten & Drinken"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.130336284637451,
            51.543132343985604
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.60757003871097,
      5.1901817321777335,
      'bezienswaardigheid',
      'Vogelkijkscherm Leemputten',
      'Hier huist een aalscholverkolonie',
      '{
        "type": "Feature",
        "properties": {
          "marker-color": "#7e7e7e",
          "marker-size": "medium",
          "marker-symbol": "",
          "bezienswaardigheid_naam": "Vogelkijkscherm Leemputten",
          "frequentie": "altijd",
          "categorie": "Bezienswaardigheid",
          "beschrijving": "Hier huist een aalscholverkolonie"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.1901817321777335,
            51.60757003871097
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.570881622953564,
      5.397806167602539,
      'bezienswaardigheid',
      'Uitkijktoren t Meulke',
      'De beemden aan de beek zijn als vanouds in gebruik als weiland.',
      '{
        "type": "Feature",
        "properties": {
          "bezienswaardigheid_naam": "Uitkijktoren t Meulke",
          "beschrijving": "De beemden aan de beek zijn als vanouds in gebruik als weiland.",
          "categorie": "Bezienswaardigheid",
          "frequentie": "altijd",
          "marker-color": "#7e7e7e",
          "marker-size": "medium"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.397806167602539,
            51.570881622953564
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.50356036497247,
      5.262365341186523,
      'bezienswaardigheid',
      'Vogelkijkscherm Kattenbergs Broek',
      'In 2007 en 2008 bracht Waterschap de Dommel hier iets groots tot stand. Over een lengte van 2 km werd de Beerze in zijn oorspronkelijke staat hersteld. Op basis van de topografische kaart van 1900 werden de bochten terug in de beek gebracht.',
      '{
        "type": "Feature",
        "properties": {
          "bezienswaardigheid_naam": "Vogelkijkscherm Kattenbergs Broek",
          "beschrijving": "In 2007 en 2008 bracht Waterschap de Dommel hier iets groots tot stand. Over een lengte van 2 km werd de Beerze in zijn oorspronkelijke staat hersteld. Op basis van de topografische kaart van 1900 werden de bochten terug in de beek gebracht.",
          "categorie": "Bezienswaardigheid",
          "frequentie": "altijd",
          "marker-color": "#7e7e7e",
          "marker-size": "medium"
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.262365341186523,
            51.50356036497247
          ]
        }
      }'
    );
    $this->AddProjectPointFromJSON(
      51.446143972759494,
      5.23747444152832,
      'bezienswaardigheid',
      'Observatiepost Landschotse Heide',
      'De venwitsnuitlibel: alleen al om die naam zou je dit gebied willen bezoeken. En dan vliegen er ook nog eens 28 andere soorten libellen rond boven de vennen.',
      '{
        "type": "Feature",
        "properties": {
          "bezienswaardigheid_naam": "Observatiepost Landschotse Heide",
          "beschrijving": "De venwitsnuitlibel: alleen al om die naam zou je dit gebied willen bezoeken. En dan vliegen er ook nog eens 28 andere soorten libellen rond boven de vennen.",
          "categorie": "Bezienswaardigheid",
          "frequentie": "altijd",
          "marker-color": "#7e7e7e",
          "marker-size": "medium",
          "stroke": ""
        },
        "geometry": {
          "type": "Point",
          "coordinates": [
            5.23747444152832,
            51.446143972759494
          ]
        }
      }'
    );
  } 

  public function AddProjectPoint($lat, $lng)
  {
    factory(App\Models\ProjectPoint::class)->create([
      'location' => new Point($lat, $lng),
      'area' => Geometry::fromJson('{
              "type": "FeatureCollection",
              "features": [
                {
                  "type": "Feature",
                  "properties": {},
                  "geometry": {
                    "type": "Point",
                    "coordinates": [
                      ' . $lat . ',
                      ' . $lng . '
                    ]
                  }
                }
              ]
            }')
    ]);
  }

  public function AddProjectPointFromJSON($lat, $lng, $category, $title, $description, $json)
  {
    factory(App\Models\ProjectPoint::class)->create([
      'location' => new Point($lat, $lng),
      'area' => Geometry::fromJson(
        '{
          "type": "FeatureCollection",
          "features": [' . $json . '] }'
      ),
      'category' => $category,
      'name' => $title,
      'information' => $description
    ]);
  }
}
