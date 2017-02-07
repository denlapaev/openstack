<?php

namespace DenLapaev\OpenStack\Networking\v2\Extensions\Layer3\Models;

use DenLapaev\OpenStack\Common\Resource\OperatorResource;
use DenLapaev\OpenStack\Common\Resource\Creatable;
use DenLapaev\OpenStack\Common\Resource\Deletable;
use DenLapaev\OpenStack\Common\Resource\Listable;
use DenLapaev\OpenStack\Common\Resource\Retrievable;
use DenLapaev\OpenStack\Common\Resource\Updateable;
use DenLapaev\OpenStack\Networking\v2\Extensions\Layer3\Api;

/**
 * @property Api $api
 */
class FloatingIp extends OperatorResource implements Listable, Creatable, Retrievable, Updateable, Deletable
{
    /** @var string */
    public $id;

    /** @var string */
    public $status;

    /** @var string */
    public $floatingNetworkId;

    /** @var string */
    public $routerId;

    /** @var string */
    public $fixedIpAddress;

    /** @var string */
    public $floatingIpAddress;

    /** @var string */
    public $tenantId;

    /** @var string */
    public $portId;

    protected $aliases = [
        'floating_network_id' => 'floatingNetworkId',
        'router_id'           => 'routerId',
        'fixed_ip_address'    => 'fixedIpAddress',
        'floating_ip_address' => 'floatingIpAddress',
        'tenant_id'           => 'tenantId',
        'port_id'             => 'portId',
    ];

    protected $resourceKey = 'floatingip';
    protected $resourcesKey = 'floatingips';

    public function create(array $userOptions): Creatable
    {
        $response = $this->execute($this->api->postFloatingIps(), $userOptions);
        return $this->populateFromResponse($response);
    }

    public function update()
    {
        $response = $this->executeWithState($this->api->putFloatingIp());
        $this->populateFromResponse($response);
    }

    public function delete()
    {
        $this->executeWithState($this->api->deleteFloatingIp());
    }

    public function retrieve()
    {
        $this->executeWithState($this->api->getFloatingIp());
    }
}
