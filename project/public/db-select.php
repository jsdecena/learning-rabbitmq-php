<?php

$sqlite = new SQLite3('../database/db.sqlite');

$inventoryItems = $sqlite->query('SELECT * FROM inventory_items');

$inventories = [];
while ($row = $inventoryItems->fetchArray()) {
    $inventories[] = $row;
}

$total = $sqlite->query('SELECT SUM(count) AS total FROM inventory_items');
$totals = [];
while ($row = $total->fetchArray()) {
    $totals['total'] = $row['total'];
}

$delivery = $sqlite->query('SELECT * FROM deliveries');

$deliveries = [];
while ($row = $delivery->fetchArray()) {
    $deliveries[] = $row;
}

$sale = $sqlite->query('SELECT * FROM sale');

$sales = [];
while ($row = $sale->fetchArray()) {
    $sales[] = $row;
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
        <br> <br>
        <section class="card">
            <div class="col-12">
                <h1>Inventory</h1>
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
                <h1>Deliveries</h1>
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
                <h1>Sales</h1>
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