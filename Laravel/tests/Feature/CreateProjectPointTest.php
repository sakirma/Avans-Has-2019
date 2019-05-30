<?php

namespace Tests\Feature;

use Grimzy\LaravelMysqlSpatial\Types\Point;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateProjectPointTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateProjectPoint()
    {
        $this->post('admin/projectpoint/create', [
            'project_id' => 1,
            'markerLat' => 5.287020206451416,
            'markerLong' => 51.68828138589033,
            'area' => null,
            'name' => 'TestCaseProjectPoint',
            'information' => 'This is a automated test ProjectPoint, please delete this point!',
            'category' => 'bezienswaardigheid'
        ]);

        $this->assertDatabaseHas('interest_point', [
            'project_id' => 1,
            'location' => new Point(5.287020206451416, 51.68828138589033),
            'area' => null,
            'name' => 'TestCaseProjectPoint',
            'information' => 'This is a automated test ProjectPoint, please delete this point!',
            'category' => 'bezienswaardigheid'
        ]);

        /*
        $test = factory(ProjectPoint::class)->create();

        $this->post('admin/projectpoint/create', $test);

        $this->assertDatabaseHas('interest_point', $test);
        */
    }
}
