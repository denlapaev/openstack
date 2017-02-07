<?php declare(strict_types=1);

namespace DenLapaev\OpenStack\BlockStorage\v2\Models;

use DenLapaev\OpenStack\Common\Resource\OperatorResource;
use DenLapaev\OpenStack\Common\Resource\Creatable;
use DenLapaev\OpenStack\Common\Resource\Deletable;
use DenLapaev\OpenStack\Common\Resource\Listable;
use DenLapaev\OpenStack\Common\Resource\Updateable;

/**
 * @property \DenLapaev\OpenStack\BlockStorage\v2\Api $api
 */
class VolumeType extends OperatorResource implements Listable, Creatable, Updateable, Deletable
{
    /** @var string */
    public $id;

    /** @var string */
    public $name;

    protected $resourceKey  = 'volume_type';
    protected $resourcesKey = 'volume_types';

    /**
     * @param array $userOptions {@see \DenLapaev\OpenStack\BlockStorage\v2\Api::postTypes}
     *
     * @return Creatable
     */
    public function create(array $userOptions): Creatable
    {
        $response = $this->execute($this->api->postTypes(), $userOptions);
        return $this->populateFromResponse($response);
    }

    public function update()
    {
        $this->executeWithState($this->api->putType());
    }

    public function delete()
    {
        $this->executeWithState($this->api->deleteType());
    }
}
