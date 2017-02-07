<?php declare(strict_types=1);

namespace DenLapaev\OpenStack\Identity\v2\Models;

use DenLapaev\OpenStack\Common\Resource\OperatorResource;
use DenLapaev\OpenStack\Common\Transport\Utils;
use Psr\Http\Message\ResponseInterface;

/**
 * Represents an Identity v2 service catalog.
 *
 * @package DenLapaev\OpenStack\Identity\v2\Models
 */
class Catalog extends OperatorResource implements \DenLapaev\OpenStack\Common\Auth\Catalog
{
    const DEFAULT_URL_TYPE = 'publicURL';

    /**
     * The catalog entries
     *
     * @var []Entry
     */
    public $entries = [];

    /**
     * {@inheritDoc}
     */
    public function populateFromResponse(ResponseInterface $response): self
    {
        $entries = Utils::jsonDecode($response)['access']['serviceCatalog'];

        foreach ($entries as $entry) {
            $this->entries[] = $this->model(Entry::class, $entry);
        }

        return $this;
    }

    public function getServiceUrl(
        string $serviceName,
        string $serviceType,
        string $region,
        string $urlType = self::DEFAULT_URL_TYPE
    ): string {
        foreach ($this->entries as $entry) {
            if ($entry->matches($serviceName, $serviceType) && ($url = $entry->getEndpointUrl($region, $urlType))) {
                return $url;
            }
        }

        throw new \RuntimeException(sprintf(
            "Endpoint URL could not be found in the catalog for this service.\nName: %s\nType: %s\nRegion: %s\nURL type: %s",
            $serviceName, $serviceType, $region, $urlType
        ));
    }
}
