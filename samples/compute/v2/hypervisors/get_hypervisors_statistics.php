<?php

use DenLapaev\OpenStack\Compute\v2\Models\HypervisorStatistic;

require 'vendor/autoload.php';

$openstack = new DenLapaev\OpenStack\OpenStack([
    'authUrl' => '{authUrl}',
    'region'  => '{region}',
    'user'    => [
        'id'       => '{userId}',
        'password' => '{password}'
    ],
    'scope'   => ['project' => ['id' => '{projectId}']]
]);

$compute = $openstack->computeV2(['region' => '{region}']);

/** @var HypervisorStatistic $hypervisorStatistics */
$hypervisorStatistics = $compute->getHypervisorStatistics();
