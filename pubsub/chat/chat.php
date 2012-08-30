<?php

$ctx = new ZMQContext();

$sub = $ctx->getSocket(ZMQ::SOCKET_SUB);
$sub->setSockOpt(ZMQ::SOCKOPT_SUBSCRIBE, '');
$sub->connect('tcp://localhost:8001');

$poll = new ZMQPoll();
$poll->add($sub, ZMQ::POLL_IN);
$read = $write = array();

// Hack for chrome etc. to start polling
echo str_repeat("<span></span>", 100);
ob_flush();
flush();

while (true) {
    $events = $poll->poll($read, $write, 500);

    if ($events) {
        echo PHP_EOL . PHP_EOL;
        echo sprintf('<script type="text/javascript">parent.updateChat("%s")</script>', str_replace("'", "\'", $sub->recv()));
        echo PHP_EOL . PHP_EOL;
    } else {
        echo '.';
    }
    ob_flush();
    flush();
}