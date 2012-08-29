<?php

$ctx = new ZMQContext();

$results = $ctx->getSocket(ZMQ::SOCKET_PULL);
$results->setSockOpt(ZMQ::SOCKOPT_HWM, 1);
$results->bind('tcp://*:8002');

$control = $ctx->getSocket(ZMQ::SOCKET_PULL);
$control->setSockOpt(ZMQ::SOCKOPT_HWM, 1);
$control->connect('tcp://localhost:8001');

$poll = new ZMQPoll();
$poll->add($results, ZMQ::POLL_IN);
$read = $write = array();

$imageString = '';

while (true) {
    $events = $poll->poll($read, $write, 5000);

    if ($events) {
        echo "Receiving image result ... " . PHP_EOL;
        file_put_contents('./image.png', $results->recv());
    } else {
        if ($control->recv(ZMQ::MODE_NOBLOCK)) {
            exit;
        }
    }
}