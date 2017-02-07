<?php

require 'vendor/autoload.php';

$openstack = new DenLapaev\OpenStack\OpenStack([
    'authUrl' => '{authUrl}',
    'region'  => '{region}',
    'user'    => ['id' => '{userId}', 'password' => '{password}'],
    'scope'   => ['project' => ['id' => '{projectId}']]
]);

$service = $openstack->imagesV2();

$image = $service->createImage([
    'name'            => '{name}',
    'tags'            => ['{tag1}', '{tag2}'],
    'containerFormat' => '{containerFormat}',
    'diskFormat'      => '{diskFormat}',
    'visibility'      => '{visibility}',
    'minDisk'         => 10,
    'protected'       => true,
    'minRam'          => 10,
]);
