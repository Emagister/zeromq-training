<?php

$ctx = new ZMQContext();

$sub = $ctx->getSocket(ZMQ::SOCKET_SUB);
$sub->setSockOpt(ZMQ::SOCKOPT_SUBSCRIBE, '');
$sub->connect('tcp://localhost:8001');

$poll = new ZMQPoll();
$poll->add($sub, ZMQ::POLL_IN);
$read = $write = array();

while (true) {
    $events = $poll->poll($read, $write, 5000);

    if ($events) {
        echo "Received a new event!";
        $event = unserialize($sub->recv());

        if ('user.new' == $event['name']) {
            $user = $event['user'];
            if (!$user->active) {
                echo "Sending confirmation e-mail!" . PHP_EOL;
                // send_confirmation_email($user->email);
            }
        }
    }
}