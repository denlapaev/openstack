<?php

require 'vendor/autoload.php';

use DenLapaev\OpenStack\Images\v2\Models\Member;

$openstack = new DenLapaev\OpenStack\OpenStack([
    'authUrl' => '{authUrl}',
    'region'  => '{region}',
    'user'    => ['id' => '{userId}', 'password' => '{password}'],
    'scope'   => ['project' => ['id' => '{projectId}']]
]);

$openstack->imagesV2()
    ->getImage('{imageId}')
    ->getMember('{tenantId}')
    ->updateStatus(Member::STATUS_ACCEPTED);
