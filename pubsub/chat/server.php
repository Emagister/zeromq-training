<?php

$ctx = new ZMQContext();
$pub = $ctx->getSocket(ZMQ::SOCKET_PUB);
$pub->setSockOpt(ZMQ::SOCKOPT_HWM, 20);
$pub->bind('tcp://*:5566');
$pull = $ctx->getSocket(ZMQ::SOCKET_PULL);
$pull->setSockOpt(ZMQ::SOCKOPT_HWM, 20);
$pull->bind('tcp://*:5567');

while(true) {
    $message = $pull->recv();
    echo "Got ", $message, PHP_EOL;
    $pub->send($message);
}