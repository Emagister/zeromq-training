<?php

$name = htmlspecialchars($_POST['name']);
$message = htmlspecialchars($_POST['message']);

$context = new ZMQContext();
$send = new ZMQSocket($context, ZMQ::SOCKET_PUSH);
$send->connect('tcp://localhost:5567');
if($message == 'm:joined') {
    $send->send('<em>' . $name . '</em> has <span class="label label-info">joined</span></em>');
} else {
    $send->send('<strong>' . $name . '</strong>: ' . $message);
}
exit();