<?php

require_once __DIR__ . '/../vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
$channel = $connection->channel();

$inventoryExchange = 'INVENTORY';

$channel->exchange_declare($inventoryExchange, 'topic', false, false, false);

list($queue_name, ,) = $channel->queue_declare("", false, false, true, false);

$channel->queue_bind($queue_name, $inventoryExchange, 'INVENTORY.MOVEMENT');

echo " [*] Waiting for inventory movements. To exit press CTRL+C\n";

$callback = function ($msg) {
    $sqlite = new SQLite3('../database/db.sqlite');
    $inventory = json_decode($msg->body, true);
    if ($inventory['type'] == 'down') {
        $inventory['qty'] = '-' . $inventory['qty'];
    }
    $sqlite->query("INSERT INTO inventory_items (id, name, count) VALUES (". rand(999, 999999).", 'iPhone12', ". $inventory['qty'] .")");

    echo "Updated inventory";
};

$channel->basic_consume($queue_name, '', false, true, false, false, $callback);

while ($channel->is_open()) {
    $channel->wait();
}

$channel->close();
$connection->close();