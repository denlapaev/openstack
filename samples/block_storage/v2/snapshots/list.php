<?php

require 'vendor/autoload.php';

$openstack = new DenLapaev\OpenStack\OpenStack([
    'authUrl' => '{authUrl}',
    'region'  => '{region}',
    'user'    => ['id' => '{userId}', 'password' => '{password}'],
    'scope'   => ['project' => ['id' => '{projectId}']]
]);

$service = $openstack->blockStorageV2();

$snapshots = $service->listSnapshots();

foreach ($snapshots as $snapshot) {
    /** @var $snapshot \DenLapaev\OpenStack\BlockStorage\v2\Models\Snapshot */
}
