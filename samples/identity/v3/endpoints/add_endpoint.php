<?php

require 'vendor/autoload.php';

$openstack = new DenLapaev\OpenStack\OpenStack([
    'authUrl' => '{authUrl}',
    'region'  => '{region}',
    'user'    => [
        'id'       => '{userId}',
        'password' => '{password}'
    ],
    'scope' => [
        'project' => [
            'id' => '{projectId}'
        ]
    ]
]);

$identity = $openstack->identityV3(['region' => '{region}']);

$endpoint = $identity->createEndpoint([
    'interface' => \DenLapaev\OpenStack\Identity\v3\Enum::INTERFACE_INTERNAL,
    'name'      => '{endpointName}',
    'region'    => '{region}',
    'url'       => '{endpointUrl}',
    'serviceId' => '{serviceId}'
]);
