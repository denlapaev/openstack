<?php declare(strict_types=1);

namespace DenLapaev\OpenStack\Networking\v2\Extensions\SecurityGroups\Models;

use DenLapaev\OpenStack\Common\Resource\OperatorResource;
use DenLapaev\OpenStack\Common\Resource\Creatable;
use DenLapaev\OpenStack\Common\Resource\Deletable;
use DenLapaev\OpenStack\Common\Resource\Listable;
use DenLapaev\OpenStack\Common\Resource\Retrievable;

/**
 * Represents a SecurityGroupRule resource in the Network v2 service
 *
 * @property \DenLapaev\OpenStack\Networking\v2\Extensions\SecurityGroups\Api $api
 */
class SecurityGroupRule extends OperatorResource implements Creatable, Listable, Deletable, Retrievable
{
    /**
     * @var string
     */
    public $direction;

    /**
     * @var string
     */
    public $ethertype;

    /**
     * @var string
     */
    public $id;

    /**
     * @var integer
     */
    public $portRangeMax;

    /**
     * @var integer
     */
    public $portRangeMin;

    /**
     * @var string
     */
    public $protocol;

    /**
     * @var string
     */
    public $remoteGroupId;

    /**
     * @var string
     */
    public $remoteIpPrefix;

    /**
     * @var string
     */
    public $securityGroupId;

    /**
     * @var string
     */
    public $tenantId;

    protected $aliases = [
        'port_range_max'    => 'portRangeMax',
        'port_range_min'    => 'portRangeMin',
        'remote_group_id'   => 'remoteGroupId',
        'remote_ip_prefix'  => 'remoteIpPrefix',
        'security_group_id' => 'securityGroupId',
        'tenant_id'         => 'tenantId',
    ];

    protected $resourceKey = 'security_group_rule';

    protected $resourcesKey = 'security_group_rules';

    /**
     * {@inheritDoc}
     */
    public function create(array $userOptions): Creatable
    {
        $response = $this->execute($this->api->postSecurityRules(), $userOptions);
        return $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function delete()
    {
        $this->executeWithState($this->api->deleteSecurityRule());
    }

    /**
     * {@inheritDoc}
     */
    public function retrieve()
    {
        $response = $this->executeWithState($this->api->getSecurityRule());
        $this->populateFromResponse($response);
    }
}
