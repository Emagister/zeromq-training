<?php

$ctx = new ZMQContext();

$server = $ctx->getSocket(ZMQ::SOCKET_REP);
$server->bind('tcp://*:8000');

while(true) {
    $message = $server->recv();
    echo "Sending $message World", PHP_EOL;
    $server->send($message . " World");
}