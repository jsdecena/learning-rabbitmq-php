<?php
error_reporting(E_ALL ^ E_WARNING);

try {
    $sqlite = new SQLite3('../database/db.sqlite');

    $inventoryTable = '
    CREATE TABLE IF NOT EXISTS inventory_items (
        id INTEGER PRIMARY KEY,
        name TEXT NOT NULL,
        count INTEGER NOT NULL
    );
';

    $sqlite->exec($inventoryTable);

    $saleTable = '
    CREATE TABLE IF NOT EXISTS sale (
        id INTEGER PRIMARY KEY,
        item_name TEXT NOT NULL,
        qty INTEGER NOT NULL
    );
';

    $sqlite->exec($saleTable);

    $deliveries = '
    CREATE TABLE IF NOT EXISTS deliveries (
        id INTEGER PRIMARY KEY,
        item_name TEXT NOT NULL,
        qty INTEGER NOT NULL
    );
';

    $sqlite->exec($deliveries);

    $sqlite->query("INSERT INTO inventory_items (id, name, count) VALUES (2, 'iPhone12', 0)");
} catch (\Exception $e) {
    die('Make the database folder writable -- `chmod -R 777 database`');
}

try {
    $inventoryItems = $sqlite->query('SELECT * FROM inventory_items');
    $inventories = [];
    $totals = [];
    $deliveries = [];
    $sales = [];
    if ($inventoryItems) {
        while ($row = $inventoryItems->fetchArray()) {
            $inventories[] = $row;
        }

        $total = $sqlite->query('SELECT SUM(count) AS total FROM inventory_items');
        while ($row = $total->fetchArray()) {
            $totals['total'] = $row['total'];
        }

        $delivery = $sqlite->query('SELECT * FROM deliveries');
        while ($row = $delivery->fetchArray()) {
            $deliveries[] = $row;
        }

        $sale = $sqlite->query('SELECT * FROM sale');
        while ($row = $sale->fetchArray()) {
            $sales[] = $row;
        }
    }
} catch (\Exception $e) {
    die('Create the db.sqlite in /database');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Select</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Learning RabbitMQ</h1>
    <br> <br>
    <section class="card">
        <div class="col-12">
            <h3>Inventory</h3>
            <table class="table">
                <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Qty</th>
                </thead>
                <tbody>
                <?php foreach ($inventories as $row) { ?>
                    <tr>
                        <td><?php echo $row['id']  ?></td>
                        <td><?php echo $row['name']  ?></td>
                        <td><?php echo $row['count']  ?></td>
                    </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                    <td>Total</td>
                    <td></td>
                    <td><?php echo $totals['total']  ?></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </section>
    <br>
    <section class="card">
        <div class="col-12">
            <h3>Deliveries</h3>
            <table class="table">
                <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Qty</th>
                </thead>
                <tbody>
                <?php foreach ($deliveries as $row) { ?>
                    <tr>
                        <td><?php echo $row['id']  ?></td>
                        <td><?php echo $row['item_name']  ?></td>
                        <td><?php echo $row['qty']  ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
    <br>
    <section class="card">
        <div class="col-12">
            <h3>Sales</h3>
            <table class="table">
                <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Qty</th>
                </thead>
                <tbody>
                <?php foreach ($sales as $row) { ?>
                    <tr>
                        <td><?php echo $row['id']  ?></td>
                        <td><?php echo $row['item_name']  ?></td>
                        <td><?php echo $row['qty']  ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</div>
</body>
</html>