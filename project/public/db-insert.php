<?php

$sqlite = new SQLite3('../database/db.sqlite');

$sqlite->query("INSERT INTO inventory_items (id, name, count) VALUES (2, 'iPhone12', 0)");