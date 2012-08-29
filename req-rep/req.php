<?php

$ctx = new ZMQContext();

$rep = $ctx->getSocket(ZMQ::SOCKET_REP);
$rep->bind('tcp://*:8000');
$message = $rep->recv();

$req = $ctx->getSocket(ZMQ::SOCKET_REQ);
$req->connect('tcp://localhost:8000');
$req->send($message);