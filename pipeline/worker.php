<?php

$ctx = new ZMQContext();

$worker = $ctx->getSocket(ZMQ::SOCKET_PULL);
$worker->setSockOpt(ZMQ::SOCKOPT_HWM, 1);
$worker->bind('tcp://*:8000');

$control = $ctx->getSocket(ZMQ::SOCKET_PULL);
$control->setSockOpt(ZMQ::SOCKOPT_HWM, 1);
$control->connect('tcp://localhost:8001');

$results = $ctx->getSocket(ZMQ::SOCKET_PUSH);
$results->setSockOpt(ZMQ::SOCKOPT_HWM, 1);
$results->connect('tcp://localhost:8002');

$poll = new ZMQPoll();
$poll->add($worker, ZMQ::POLL_IN);
$read = $write = array();

$imageString = '';

while (true) {
    $events = $poll->poll($read, $write, 5000);

    if ($events) {
        echo "Receiving image ... " . PHP_EOL;
        $imageString = $worker->recv();
        echo "Processing image ... " . PHP_EOL;
        $im = imagecreatefromstring($imageString);
        @imagepng($im, './tmp.png');
        imagedestroy($im);

        echo "Sending data to result process ... " . PHP_EOL;
        $results->send(file_get_contents('./tmp.png'));

        unlink('./tmp.png');
    } else {
        if ($control->recv(ZMQ::MODE_NOBLOCK)) {
            exit;
        }
    }
}