<?php declare(strict_types=1);

namespace DenLapaev\OpenStack\Common\Resource;

/**
 * Represents a resource that can be created.
 *
 * @package DenLapaev\OpenStack\Common\Resource
 */
interface Creatable
{
    /**
     * Create a new resource according to the configuration set in the options.
     *
     * @param array $userOptions
     * @return self
     */
    public function create(array $userOptions): Creatable;
}
