<?php

namespace DenLapaev\OpenStack\Test\Identity\v2\Models;

use DenLapaev\OpenStack\Identity\v2\Api;
use DenLapaev\OpenStack\Identity\v2\Models\Entry;
use DenLapaev\OpenStack\Test\TestCase;

class EntryTest extends TestCase
{
    private $entry;

    public function setUp()
    {
        parent::setUp();

        $this->entry = new Entry($this->client->reveal(), new Api());
    }

    public function test_null_is_returned_when_no_endpoints_are_found()
    {
        $this->assertEmpty($this->entry->getEndpointUrl('foo', 'bar'));
    }
}
