<?php
require_once __DIR__ . "/src/core.php";
includeTemplate("/header.php", ['title' => "Заказ №'". $_GET['id']]);
if (isset($_GET['id'])) {
    $orderFull = new orders();
    $orderByIdArray = $orderFull->ShowOrdersById($_GET['id']);
}else {
    header("Location: index.php");
}
?>
<body>
<div class="container">
    <div class="row mt-5">
        <div class="col-md-6 offset-3">
            <h3>Подбробная информация по заказазу № <?= $_GET['id']?></h3>
            <ul class="list-group">
                <?php foreach ($orderByIdArray as $key => $item) : ?>
                      <?php if ($key == 0) : ?>
                        <li class="list-group-item active" aria-current="true">Идентификатор заказа<?= $item['id']?></li>
                      <?php endif;?>
                        <li class="list-group-item">Описание: <?= $item['desctiption']?></li>
                        <li class="list-group-item">Контакты: <?= $item['conatcts']?></li>
                        <li class="list-group-item">Дата оформления: <?= $item['dateadd']?></li>
                        <li class="list-group-item">Пользователь: <a href="/profileuser.php?id_user=<?=$item['id_user'];?>"><?= $orderFull->ShowUsersById($item['id_user'])[0]['name'];?></a></li>
            </ul>
            <hr>
            <div class="row text-center">
                <div class="col-md-6">
                    <h5>общая стоимость</h5>
                    <div class="alert alert-info" role="alert">
                        <span><?=$item['totalprice'];?> &#8381;</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <h5>Статус</h5>
                    <?php if($item['status'] === 'Не оплачен') : ?>
                       <div class="alert alert-danger">
                           <?= $item['status']?>
                       </div>
                    <?php else :?>
                        <div class="alert alert-success">
                            <?= $item['status']?>
                        </div>
                    <?php endif;?>
                </div>
            </div>
            <? endforeach;?>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <a href="/index.php" class="btn btn-primary" role="button" data-bs-toggle="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                        </svg>
                        Назад</a>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
</body>
</html>
