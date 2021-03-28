<?php

require_once __DIR__ . '/../vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
$sqlite = new SQLite3('../database/db.sqlite');

$connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
$channel = $connection->channel();

$inventoryExchange = 'INVENTORY';

$channel->exchange_declare($inventoryExchange, 'topic', false, false, false);

$routing = 'INVENTORY.MOVEMENT';

$data = [
    'item_name' => 'iPhone12',
    'qty' => rand(1, 100)
];

$sqlite->query("INSERT INTO deliveries (id, item_name, qty) VALUES (". rand(999, 999999) .", '". $data['item_name'] ."', ". $data['qty'] .")");

$data['type'] = 'up';

$msg = new AMQPMessage(json_encode($data));

$channel->basic_publish($msg, $inventoryExchange, $routing);

echo ' [x] Delivered :', json_encode($data), "\n";

$channel->close();
$connection->close();