<?php

require 'vendor/autoload.php';

$openstack = new DenLapaev\OpenStack\OpenStack([
    'authUrl' => '{authUrl}',
    'region'  => '{region}',
    'user'    => ['id' => '{userId}', 'password' => '{password}'],
    'scope'   => ['project' => ['id' => '{projectId}']]
]);

$service = $openstack->blockStorageV2();

$volume = $service->createVolume([
    'description' => '{description}',
    'size'        => '{size}',
    'name'        => '{name}',
    'imageId'     => '{snapshotId}',
]);
