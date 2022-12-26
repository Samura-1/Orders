<?php
require_once '../src/orders.php';
if (isset($_POST['do_add_user'])) {
    $order = new orders();
    $name = $_POST['userName'];
    $order->setUser($name);
}else {
    header("Location: index.php");
}