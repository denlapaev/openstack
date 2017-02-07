<?php declare(strict_types=1);

namespace DenLapaev\OpenStack\Common\Service;

use DenLapaev\OpenStack\Common\Api\OperatorInterface;
use DenLapaev\OpenStack\Common\Api\OperatorTrait;

/**
 * Represents the top-level abstraction of a service.
 *
 * @package DenLapaev\OpenStack\Common\Service
 */
abstract class AbstractService implements ServiceInterface
{
    use OperatorTrait;
}
