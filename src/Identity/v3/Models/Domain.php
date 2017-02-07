<?php declare(strict_types=1);

namespace DenLapaev\OpenStack\Identity\v3\Models;

use DenLapaev\OpenStack\Common\Error\BadResponseError;
use DenLapaev\OpenStack\Common\Resource\OperatorResource;
use DenLapaev\OpenStack\Common\Resource\Creatable;
use DenLapaev\OpenStack\Common\Resource\Deletable;
use DenLapaev\OpenStack\Common\Resource\Listable;
use DenLapaev\OpenStack\Common\Resource\Retrievable;
use DenLapaev\OpenStack\Common\Resource\Updateable;

/**
 * @property \DenLapaev\OpenStack\Identity\v3\Api $api
 */
class Domain extends OperatorResource implements Creatable, Listable, Retrievable, Updateable, Deletable
{
    /** @var string */
    public $id;

    /** @var string */
    public $name;

    /** @var array */
    public $links;

    /** @var bool */
    public $enabled;

    /** @var string */
    public $description;

    protected $resourceKey = 'domain';
    protected $resourcesKey = 'domains';

    /**
     * {@inheritDoc}
     *
     * @param array $data {@see \DenLapaev\OpenStack\Identity\v3\Api::postDomains}
     */
    public function create(array $data): Creatable
    {
        $response = $this->execute($this->api->postDomains(), $data);
        return $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function retrieve()
    {
        $response = $this->executeWithState($this->api->getDomain());
        $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function update()
    {
        $response = $this->executeWithState($this->api->patchDomain());
        $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function delete()
    {
        $this->executeWithState($this->api->deleteDomain());
    }

    /**
     * @param array $options {@see \DenLapaev\OpenStack\Identity\v3\Api::getUserRoles}
     *
     * @return \Generator
     */
    public function listUserRoles(array $options = []): \Generator
    {
        $options['domainId'] = $this->id;
        return $this->model(Role::class)->enumerate($this->api->getUserRoles(), $options);
    }

    /**
     * @param array $options {@see \DenLapaev\OpenStack\Identity\v3\Api::putUserRoles}
     */
    public function grantUserRole(array $options = [])
    {
        $this->execute($this->api->putUserRoles(), ['domainId' => $this->id] + $options);
    }

    /**
     * @param array $options {@see \DenLapaev\OpenStack\Identity\v3\Api::headUserRole}
     *
     * @return bool
     */
    public function checkUserRole(array $options = []): bool
    {
        try {
            $this->execute($this->api->headUserRole(), ['domainId' => $this->id] + $options);
            return true;
        } catch (BadResponseError $e) {
            return false;
        }
    }

    /**
     * @param array $options {@see \DenLapaev\OpenStack\Identity\v3\Api::deleteUserRole}
     */
    public function revokeUserRole(array $options = [])
    {
        $this->execute($this->api->deleteUserRole(), ['domainId' => $this->id] + $options);
    }

    /**
     * @param array $options {@see \DenLapaev\OpenStack\Identity\v3\Api::getGroupRoles}
     *
     * @return \Generator
     */
    public function listGroupRoles(array $options = []): \Generator
    {
        $options['domainId'] = $this->id;
        return $this->model(Role::class)->enumerate($this->api->getGroupRoles(), $options);
    }

    /**
     * @param array $options {@see \DenLapaev\OpenStack\Identity\v3\Api::putGroupRole}
     */
    public function grantGroupRole(array $options = [])
    {
        $this->execute($this->api->putGroupRole(), ['domainId' => $this->id] + $options);
    }

    /**
     * @param array $options {@see \DenLapaev\OpenStack\Identity\v3\Api::headGroupRole}
     *
     * @return bool
     */
    public function checkGroupRole(array $options = []): bool
    {
        try {
            $this->execute($this->api->headGroupRole(), ['domainId' => $this->id] + $options);
            return true;
        } catch (BadResponseError $e) {
            return false;
        }
    }

    /**
     * @param array $options {@see \DenLapaev\OpenStack\Identity\v3\Api::deleteGroupRole}
     */
    public function revokeGroupRole(array $options = [])
    {
        $this->execute($this->api->deleteGroupRole(), ['domainId' => $this->id] + $options);
    }
}
