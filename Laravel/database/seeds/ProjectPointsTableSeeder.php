<?php

use Grimzy\LaravelMysqlSpatial\Types\Point;
use Grimzy\LaravelMysqlSpatial\Types\Geometry;
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

        $this->AddProjectPoint(51.7142669290121, 5.3173828125);
        $this->AddProjectPoint(51.68958500811337, 5.08941650390625);
        $this->AddProjectPoint(51.65211086156918, 5.43548583984375);

        $this->AddProjectFromJSON(
          51.53974257010371,
          5.503828525543213,
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
          }');
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

    public function AddProjectFromJSON($lat, $lng, $title, $description, $json) {
      factory(App\Models\ProjectPoint::class)->create([
        'location' => new Point($lat, $lng),
        'area' => Geometry::fromJson('{
          "type": "FeatureCollection",
          "features": ['. $json . '] }'
        ),
        'name' => $title,
        'information' => $description
      ]);
    }
}
