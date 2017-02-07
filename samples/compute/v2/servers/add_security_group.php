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

/**@var DenLapaev\OpenStack\Compute\v2\Models\Server $server */
$server = $compute->getServer([
    'id' => '{serverId}',
]);

$server->addSecurityGroup(['name' => '{secGroupName}']);
