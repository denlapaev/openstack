<?php declare(strict_types=1);

namespace DenLapaev\OpenStack\Compute\v2\Models;

use DenLapaev\OpenStack\Common\Resource\Creatable;
use DenLapaev\OpenStack\Common\Resource\OperatorResource;
use DenLapaev\OpenStack\Common\Resource\Deletable;
use DenLapaev\OpenStack\Common\Resource\Listable;
use DenLapaev\OpenStack\Common\Resource\Retrievable;
use DenLapaev\OpenStack\Common\Transport\Utils;

/**
 * Represents a Compute v2 Keypair
 *
 * @property \DenLapaev\OpenStack\Compute\v2\Api $api
 */
class Keypair extends OperatorResource implements Listable, Retrievable, Deletable, Creatable
{
    /** @var string */
    public $fingerprint;

    /** @var string */
    public $name;

    /** @var string */
    public $publicKey;

    /** @var  boolean */
    public $deleted;

    /** @var  string */
    public $userId;

    /** @var  string */
    public $id;

    /** @var \DateTimeImmutable */
    public $createdAt;

    protected $aliases = [
        'public_key' => 'publicKey',
        'user_id'    => 'userId',
        'created_at' => 'createdAt',
    ];

    protected $resourceKey = 'keypair';
    protected $resourcesKey = 'keypairs';

    /**
     * {@inheritDoc}
     */
    public function retrieve()
    {
        $response = $this->execute($this->api->getKeypair(), ['name' => (string) $this->name]);
        $this->populateFromResponse($response);
    }

    public function create(array $userOptions): Creatable
    {
        $response = $this->execute($this->api->postKeypair(), $userOptions);
        return $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function populateFromArray(array $array): self
    {
        return parent::populateFromArray(Utils::flattenJson($array, $this->resourceKey));
    }

    /**
     * {@inheritDoc}
     */
    public function delete()
    {
        $this->execute($this->api->deleteKeypair(), ['name' => (string) $this->name]);
    }
}
