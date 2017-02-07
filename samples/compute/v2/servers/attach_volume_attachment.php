<?php

use DenLapaev\OpenStack\BlockStorage\v2\Models\VolumeAttachment;
use DenLapaev\OpenStack\Networking\v2\Extensions\SecurityGroups\Models\SecurityGroup;
use DenLapaev\OpenStack\Networking\v2\Extensions\SecurityGroups\Models\SecurityGroupRule;

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
$server = $compute->getServer(['id' => '{serverId}']);

/**@var VolumeAttachment $volumeAttachment*/
$volumeAttachment = $server->attachVolume('{volumeId}');
