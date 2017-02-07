<?php declare(strict_types=1);
namespace DenLapaev\OpenStack\BlockStorage\v2\Models;

use DenLapaev\OpenStack\Common\Resource\OperatorResource;
use DenLapaev\OpenStack\Common\Resource\Creatable;
use DenLapaev\OpenStack\Common\Resource\Deletable;
use DenLapaev\OpenStack\Common\Resource\HasMetadata;
use DenLapaev\OpenStack\Common\Resource\HasWaiterTrait;
use DenLapaev\OpenStack\Common\Resource\Listable;
use DenLapaev\OpenStack\Common\Resource\Retrievable;
use DenLapaev\OpenStack\Common\Resource\Updateable;
use DenLapaev\OpenStack\Common\Transport\Utils;
use Psr\Http\Message\ResponseInterface;

/**
 * @property \DenLapaev\OpenStack\BlockStorage\v2\Api $api
 */
class Volume extends OperatorResource implements Creatable, Listable, Updateable, Deletable, Retrievable, HasMetadata
{
    use HasWaiterTrait;

    /** @var string */
    public $id;

    /** @var int */
    public $size;

    /** @var string */
    public $status;

    /** @var string */
    public $name;

    /** @var array */
    public $attachments;

    /** @var string */
    public $availabilityZone;

    /** @var \DateTimeImmutable */
    public $createdAt;

    /** @var string */
    public $description;

    /** @var string */
    public $volumeTypeName;

    /** @var string */
    public $snapshotId;

    /** @var string */
    public $sourceVolumeId;

    /** @var array */
    public $metadata = [];

    protected $resourceKey = 'volume';
    protected $resourcesKey = 'volumes';
    protected $markerKey = 'id';

    protected $aliases = [
        'availability_zone' => 'availabilityZone',
        'source_volid'      => 'sourceVolumeId',
        'snapshot_id'       => 'snapshotId',
        'created_at'        => 'createdAt',
        'volume_type'       => 'volumeTypeName',
    ];

    public function populateFromResponse(ResponseInterface $response): self
    {
        parent::populateFromResponse($response);
        $this->metadata = $this->parseMetadata($response);
        return $this;
    }

    public function retrieve()
    {
        $response = $this->executeWithState($this->api->getVolume());
        $this->populateFromResponse($response);
    }

    /**
     * @param array $userOptions {@see \DenLapaev\OpenStack\BlockStorage\v2\Api::postVolumes}
     *
     * @return Creatable
     */
    public function create(array $userOptions): Creatable
    {
        $response = $this->execute($this->api->postVolumes(), $userOptions);
        return $this->populateFromResponse($response);
    }

    public function update()
    {
        $response = $this->executeWithState($this->api->putVolume());
        $this->populateFromResponse($response);
    }

    public function delete()
    {
        $this->executeWithState($this->api->deleteVolume());
    }

    public function getMetadata(): array
    {
        $response = $this->executeWithState($this->api->getVolumeMetadata());
        $this->metadata = $this->parseMetadata($response);
        return $this->metadata;
    }

    public function mergeMetadata(array $metadata)
    {
        $this->getMetadata();
        $this->metadata = array_merge($this->metadata, $metadata);
        $this->executeWithState($this->api->putVolumeMetadata());
    }

    public function resetMetadata(array $metadata)
    {
        $this->metadata = $metadata;
        $this->executeWithState($this->api->putVolumeMetadata());
    }

    public function parseMetadata(ResponseInterface $response): array
    {
        $json = Utils::jsonDecode($response);
        return isset($json['metadata']) ? $json['metadata'] : [];
    }
}
