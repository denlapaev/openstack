<?php declare(strict_types=1);

namespace DenLapaev\OpenStack\Identity\v3\Models;

use DenLapaev\OpenStack\Common\Resource\OperatorResource;
use DenLapaev\OpenStack\Common\Resource\Creatable;
use DenLapaev\OpenStack\Common\Resource\Deletable;
use DenLapaev\OpenStack\Common\Resource\Listable;

/**
 * @property \OpenStack\Identity\v3\Api $api
 */
class Role extends OperatorResource implements Creatable, Listable, Deletable
{
    /** @var string */
    public $id;

    /** @var string */
    public $name;

    /** @var array */
    public $links;

    protected $resourceKey = 'role';
    protected $resourcesKey = 'roles';

    /**
     * {@inheritDoc}
     *
     * @param array $data {@see \OpenStack\Identity\v3\Api::postRoles}
     */
    public function create(array $data): Creatable
    {
        $response = $this->execute($this->api->postRoles(), $data);
        return $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function delete()
    {
        $this->executeWithState($this->api->deleteRole());
    }
}
