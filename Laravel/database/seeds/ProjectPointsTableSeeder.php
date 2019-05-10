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

        $this->AddProjectPoint(51.7142669290121, 5.3173828125);
        $this->AddProjectPoint(51.68958500811337, 5.08941650390625);
        $this->AddProjectPoint(51.65211086156918, 5.43548583984375);
    }

    public function AddProjectPoint($lat, $lng)
    {
        factory(App\Models\ProjectPoint::class)->create([
            'location' => new Point($lat, $lng),
            'geo_json' => Geometry::fromJson('{
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
}
