<?php

namespace DenLapaev\OpenStack\Test\BlockStorage\v2\Models;

use GuzzleHttp\Psr7\Response;
use DenLapaev\OpenStack\BlockStorage\v2\Api;
use DenLapaev\OpenStack\BlockStorage\v2\Models\VolumeType;
use DenLapaev\OpenStack\Test\TestCase;

class VolumeTypeTest extends TestCase
{
    /** @var VolumeType */
    private $volumeType;

    public function setUp()
    {
        parent::setUp();

        $this->rootFixturesDir = dirname(__DIR__);

        $this->volumeType = new VolumeType($this->client->reveal(), new Api());
        $this->volumeType->id = '1';
    }

    public function test_it_updates()
    {
        $expectedJson = ['volume_type' => ['name' => 'foo']];

        $this->setupMock('PUT', 'types/1', $expectedJson, [], 'GET_type');

        $this->volumeType->name = 'foo';
        $this->volumeType->update();
    }

    public function test_it_deletes()
    {
        $this->setupMock('DELETE', 'types/1', null, [], new Response(204));

        $this->volumeType->delete();
    }
}
