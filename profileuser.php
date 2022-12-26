<?php
if (isset($_GET['id_user'])) {
    require_once __DIR__ . "/src/core.php";
    includeTemplate('/header.php', ['title' => 'Профиль пользователя']);
    $userProfile = new orders();
    $userProfileInfo = $userProfile->ShowUsersById(htmlspecialchars($_GET['id_user']));
    $userOrder = $userProfile->GetOrdersByIdUser(htmlspecialchars($_GET['id_user']));
    if ($userOrder == NULL) {
        $countorder = 0;
    }else {
        $countorder = count($userOrder);
    }
    $sum = 0;
    if ($countorder > 0) {
       foreach ($userOrder as $key => $orderSumm) {
            $sum  += $orderSumm['totalprice'];
       }
    }else {
        $sum = 0;
    }
}else {
    header("Location: index.php");
}
?>
<body>
<div class="container">
    <div class="row mt-5">
        <div class="col-md-6 offset-3">
            <h3>Профиль пользователя</h3>
                <ul class="list-group">
                        <?php foreach ($userProfileInfo as $key => $item) : ?>
                                <?php if ($key == 0) : ?>
                                        <li class="list-group-item active" aria-current="true">Профиль пользователя <?= $item['name']?></li>
                                 <?php endif;?>
                    <li class="list-group-item">Колличество заказов: <?= $countorder?></li>
                        <?php if ($countorder !== 0) : ?>
                             <?php foreach ($userOrder as $itemOrder) : ?>
                                 <a href="ordersfull.php?id=<?=$itemOrder['id']?>">
                                     <li class="list-group-item">Заказ №:<?= $itemOrder['id'] ?>
                                         <span class="<?=($itemOrder['status'] == "Оплачен") ? 'green' : 'red'?>"><?=$itemOrder['status']?></span>
                                         <span><?=$itemOrder['totalprice']?> &#8381;</span>
                                     </li>
                                 </a>
                        <?php endforeach; ?>
                </ul>
            <hr>
    <?php else : ?>
        <span class="text-center">У данного пользователя нет заказов</span>
    <?php endif;?>
            <div class="row text-center">
                <div class="col-md-6 offset-3">
                    <h5>Сумма стоимости</h5>
                        <div class="alert alert-info" role="alert">
                            <span><?= $sum?> &#8381;</span>
                        </div>
                </div>
                <div class="col-md-3"></div>
            </div>
<? endforeach;?>
<hr>
<div class="row">
    <div class="col-md-12">
        <a href="<?=$_SERVER['HTTP_REFERER']?>" class="btn btn-primary" role="button" data-bs-toggle="button">
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