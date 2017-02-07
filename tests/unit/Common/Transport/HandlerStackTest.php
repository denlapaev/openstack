<?php

namespace DenLapaev\OpenStack\Test\Common\Transport;

use GuzzleHttp\Handler\MockHandler;
use DenLapaev\OpenStack\Common\Transport\HandlerStack;
use DenLapaev\OpenStack\Test\TestCase;

class HandlerStackTest extends TestCase
{
    public function test_it_is_created()
    {
        $this->assertInstanceOf(HandlerStack::class, HandlerStack::create(new MockHandler()));
    }
}
