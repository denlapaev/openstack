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

$container = $openstack->objectStoreV1()
                       ->getContainer('{containerName}');

foreach ($container->listObjects() as $object) {
    /** @var \OpenStack\ObjectStore\v1\Models\Object $object */
}
