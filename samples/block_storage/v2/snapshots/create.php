<?php

require 'vendor/autoload.php';

$openstack = new DenLapaev\OpenStack\OpenStack([
    'authUrl' => '{authUrl}',
    'region'  => '{region}',
    'user'    => ['id' => '{userId}', 'password' => '{password}'],
    'scope'   => ['project' => ['id' => '{projectId}']]
]);

$service = $openstack->blockStorageV2();

$snapshot = $service->createSnapshot([
    'volumeId'    => '{volumeId}',
    'name'        => '{name}',
    'description' => '{description}',
]);
