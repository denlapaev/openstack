<?php

namespace DenLapaev\OpenStack\Networking\v2\Extensions\Layer3\Models;

use DenLapaev\OpenStack\Common\Resource\HasWaiterTrait;
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
class Router extends OperatorResource implements Listable, Creatable, Retrievable, Updateable, Deletable
{
    use HasWaiterTrait;

    /** @var string */
    public $status;

    /** @var GatewayInfo */
    public $externalGatewayInfo;

    /** @var string */
    public $name;

    /** @var string */
    public $adminStateUp;

    /** @var string */
    public $tenantId;

    /** @var array */
    public $routes;

    /** @var string */
    public $id;

    protected $resourceKey = 'router';

    protected $aliases = [
        'external_gateway_info' => 'externalGatewayInfo',
        'admin_state_up'        => 'adminStateUp',
        'tenant_id'             => 'tenantId',
    ];

    public function create(array $userOptions): Creatable
    {
        $response = $this->execute($this->api->postRouters(), $userOptions);
        return $this->populateFromResponse($response);
    }

    public function update()
    {
        $response = $this->executeWithState($this->api->putRouter());
        $this->populateFromResponse($response);
    }

    public function retrieve()
    {
        $response = $this->executeWithState($this->api->getRouter());
        $this->populateFromResponse($response);
    }

    public function delete()
    {
        $this->executeWithState($this->api->deleteRouter());
    }

    /**
     * @param array $userOptions {@see \DenLapaev\OpenStack\Networking\v2\Extensions\Layer3\Api::putAddInterface}
     */
    public function addInterface(array $userOptions)
    {
        $userOptions['id'] = $this->id;
        $this->execute($this->api->putAddInterface(), $userOptions);
    }

    /**
     * @param array $userOptions {@see \DenLapaev\OpenStack\Networking\v2\Extensions\Layer3\Api::putRemoveInterface}
     */
    public function removeInterface(array $userOptions)
    {
        $userOptions['id'] = $this->id;
        $this->execute($this->api->putRemoveInterface(), $userOptions);
    }
}
