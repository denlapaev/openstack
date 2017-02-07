<?php

require 'vendor/autoload.php';

$openstack = new DenLapaev\OpenStack\OpenStack([
    'authUrl' => '{authUrl}',
    'region'  => '{region}',
    'user'    => [
        'id'       => '{userId}',
        'password' => '{password}'
    ],
    'scope' => ['project' => ['id' => '{projectId}']]
]);

$floatingIps = $openstack->networkingV2ExtLayer3()
                         ->listFloatingIps();

foreach ($floatingIps as $floatingIp) {
    /** @var \DenLapaev\OpenStack\Networking\v2\Extensions\Layer3\Models\FloatingIp $floatingIp */
}
