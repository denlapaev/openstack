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

$group = $identity->getGroup('{groupId}');

$group->description = 'foo';
$group->name = 'bar';

$group->update();
