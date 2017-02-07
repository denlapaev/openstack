<?php declare(strict_types=1);

namespace DenLapaev\OpenStack\Networking\v2\Models;

use DenLapaev\OpenStack\Common\Resource\OperatorResource;
use DenLapaev\OpenStack\Common\Resource\HasWaiterTrait;
use DenLapaev\OpenStack\Common\Resource\Listable;
use DenLapaev\OpenStack\Common\Resource\Creatable;
use DenLapaev\OpenStack\Common\Resource\Deletable;
use DenLapaev\OpenStack\Common\Resource\Retrievable;

/**
 * Represents a Networking v2 Network.
 *
 * @property \DenLapaev\OpenStack\Networking\v2\Api $api
 */
class Network extends OperatorResource implements Listable, Retrievable, Creatable, Deletable
{
    use HasWaiterTrait;

    /** @var string */
    public $id;

    /** @var string */
    public $name;

    /** @var bool */
    public $shared;

    /** @var string */
    public $status;

    /** @var array */
    public $subnets;

    /** @var string */
    public $adminStateUp;

    /** @var string */
    public $tenantId;

    protected $aliases = [
        'admin_state_up' => 'adminStateUp',
        'tenant_id'      => 'tenantId',
    ];

    protected $resourceKey = 'network';
    protected $resourcesKey = 'networks';

    /**
     * {@inheritDoc}
     */
    public function retrieve()
    {
        $response = $this->execute($this->api->getNetwork(), ['id' => (string)$this->id]);
        $this->populateFromResponse($response);
    }

    /**
     * Creates multiple networks in a single request.
     *
     * @param array $data {@see \DenLapaev\OpenStack\Networking\v2\Api::postNetworks}
     *
     * @return Network[]
     */
    public function bulkCreate(array $data): array
    {
        $response = $this->execute($this->api->postNetworks(), ['networks' => $data]);
        return $this->extractMultipleInstances($response);
    }

    /**
     * {@inheritDoc}
     *
     * @param array $data {@see \DenLapaev\OpenStack\Networking\v2\Api::postNetwork}
     */
    public function create(array $data): Creatable
    {
        $response = $this->execute($this->api->postNetwork(), $data);
        return $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function update()
    {
        $response = $this->executeWithState($this->api->putNetwork());
        $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function delete()
    {
        $this->executeWithState($this->api->deleteNetwork());
    }
}
