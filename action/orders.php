<?php
require_once '../src/orders.php';
if (isset($_POST['do_add_orders'])) {
    $order = new orders();
    $data = $_POST;
    $order->setOrders($data);
}else {
    header("Location: index.php");
}
