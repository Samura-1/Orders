<?php
require_once '../src/orders.php';
    $order = new orders();
    $data = $_POST;
    $order->ShowAllOrders();

