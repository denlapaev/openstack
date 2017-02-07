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

$networking = $openstack->networkingV2ExtSecGroups();

/** @var \OpenStack\Networking\v2\Extensions\SecurityGroups\Models\SecurityGroup $secGroup */
$secGroup = $networking->getSecurityGroup('{id}');
$secGroup->retrieve();
