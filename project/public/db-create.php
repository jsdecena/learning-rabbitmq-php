<?php

$sqlite = new SQLite3('../database/db.sqlite');

$inventoryTable = '
    CREATE TABLE IF NOT EXISTS inventory_items (
        id INTEGER PRIMARY KEY,
        name TEXT NOT NULL
    );
';

$sqlite->exec($inventoryTable);

$saleTable = '
    CREATE TABLE IF NOT EXISTS sale (
        id INTEGER PRIMARY KEY,
        item_name TEXT NOT NULL
    );
';

$sqlite->exec($saleTable);

$deliveries = '
    CREATE TABLE IF NOT EXISTS deliveries (
        id INTEGER PRIMARY KEY,
        item_name TEXT NOT NULL
    );
';

$sqlite->exec($deliveries);