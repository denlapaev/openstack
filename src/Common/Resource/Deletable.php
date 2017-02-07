<?php declare(strict_types=1);

namespace DenLapaev\OpenStack\Common\Resource;

/**
 * Represents a resource that can be deleted.
 *
 * @package DenLapaev\OpenStack\Common\Resource
 */
interface Deletable
{
    /**
     * Permanently delete this resource.
     *
     * @return void
     */
    public function delete();
}
