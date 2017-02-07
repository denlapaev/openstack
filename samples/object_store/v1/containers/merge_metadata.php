<?php

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

$service = $openstack->objectStoreV1();

$container = $service->getContainer('{containerName}');

$container->mergeMetadata([
    '{key_1}' => '{val_1}',
    '{key_2}' => '{val_2}',
]);
