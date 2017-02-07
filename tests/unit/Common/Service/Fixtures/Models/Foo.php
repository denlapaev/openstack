<?php

namespace DenLapaev\OpenStack\Test\Common\Service\Fixtures\Models;

use DenLapaev\OpenStack\Common\Resource\OperatorResource;

class Foo extends OperatorResource
{
    public function testGetService()
    {
        return $this->getService();
    }
}
