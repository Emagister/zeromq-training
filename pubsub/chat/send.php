<?php

$name = htmlspecialchars($_POST['name']);
$message = htmlspecialchars($_POST['message']);

$ctx = new ZMQContext();

$send = $ctx->getSocket(ZMQ::SOCKET_PUSH);
$send->connect('tcp://localhost:8000');

if ('m:joined' == $message) {
    $send->send("<em>$name has joined</em>");
} else {
    $send->send("$name: $message");
}
exit;