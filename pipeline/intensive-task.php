<?php

$ctx = new ZMQContext();

$worker = $ctx->getSocket(ZMQ::SOCKET_PUSH);
$worker->setSockOpt(ZMQ::SOCKOPT_HWM, 1);
$worker->connect('tcp://localhost:8000');

$control = $ctx->getSocket(ZMQ::SOCKET_PUSH);
$control->setSockOpt(ZMQ::SOCKOPT_HWM, 1);
$control->bind('tcp://*:8001');

echo "Sending data to worker ... " . PHP_EOL;
$worker->send(file_get_contents('./image.jpg'));

sleep(5);
$control->send('END');