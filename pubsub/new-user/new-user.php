<?php

$user = new stdClass();
$user->email = 'php@emagister.com';
$user->active = true;

$ctx = new ZMQContext();
$send = $ctx->getSocket(ZMQ::SOCKET_PUSH);
$send->connect('tcp://localhost:8000');

$event = array(
    'name' => 'user.new',
    'user' => $user
);

echo "Adding new user ..." . PHP_EOL;
$send->send(serialize($event));