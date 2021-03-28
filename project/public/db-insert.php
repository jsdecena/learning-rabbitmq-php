<?php

$sqlite = new SQLite3('../database/db.sqlite');

$sqlite->query("INSERT INTO inventory_items (id, name, count) VALUES (2, 'iPhone12', 0)");
$sqlite->query("INSERT INTO deliveries (id, item_name, qty) VALUES (3, 'iPhone12', 5)");
$sqlite->query("INSERT INTO sale (id, item_name, qty) VALUES (4, 'iPhone12', 3)");