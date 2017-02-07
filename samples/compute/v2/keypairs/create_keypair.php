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

$compute = $openstack->computeV2(['region' => '{region}']);

$data = [
    'name'      => '{name}',
    'publicKey' => '{publicKey}'
];

/** @var \DenLapaev\OpenStack\Compute\v2\Models\Keypair $keypair */
$keypair = $compute->createKeypair($data);
