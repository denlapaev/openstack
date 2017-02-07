<?php declare(strict_types=1);

namespace DenLapaev\OpenStack\Identity\v3\Models;

use DenLapaev\OpenStack\Common\Resource\OperatorResource;
use DenLapaev\OpenStack\Common\Resource\Listable;

class Assignment extends OperatorResource implements Listable
{
    /** @var Role */
    public $role;

    /** @var \stdClass */
    public $scope;

    /** @var Group */
    public $group;

    /** @var User */
    public $user;
}
