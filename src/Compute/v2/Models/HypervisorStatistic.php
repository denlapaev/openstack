<?php declare(strict_types=1);

namespace DenLapaev\OpenStack\Compute\v2\Models;

use DenLapaev\OpenStack\Common\Resource\Creatable;
use DenLapaev\OpenStack\Common\Resource\OperatorResource;
use DenLapaev\OpenStack\Common\Resource\Retrievable;
use DenLapaev\OpenStack\Common\Transport\Utils;

/**
 * Represents a Compute v2 Quota
 *
 * @property \OpenStack\Compute\v2\Api $api
 */
class HypervisorStatistic extends OperatorResource
{
    public $count;
    public $vcpus_used;
    public $local_gb_used;
    public $memory_mb;
    public $current_workload;
    public $vcpus;
    public $running_vms;
    public $free_disk_gb;
    public $disk_available_least;
    public $local_gb;
    public $free_ram_mb;
    public $memory_mb_used;
    protected $resourceKey = 'hypervisor_statistics';
}
