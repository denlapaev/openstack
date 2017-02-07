<?php declare(strict_types=1);

namespace DenLapaev\OpenStack\Common\Resource;

/**
 * A resource that supports a GET or HEAD operation to retrieve more details.
 *
 * @package DenLapaev\OpenStack\Common\Resource
 */
interface Retrievable
{
    /**
     * Retrieve details of the current resource from the remote API.
     *
     * @return void
     */
    public function retrieve();
}