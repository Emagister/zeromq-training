<?php

$ctx = new ZMQContext();

$pub = $ctx->getSocket(ZMQ::SOCKET_PUB);
$pub->bind('tcp://*:8001');

$pull = $ctx->getSocket(ZMQ::SOCKET_PULL);
$pull->bind('tcp://*:8000');

while (true) {
    $event = $pull->recv();
    echo "Sending a new event!" . PHP_EOL;
    $pub->send($event);
}