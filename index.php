<?php
require_once __DIR__ . "/src/core.php";
$order = new orders();
includeTemplate("/header.php", ['title' => 'Заказы']);
?>
<body class="bg-light">
<div class="container pt-3">
    <div class="row">
        <div class="col-md-12">
            <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalAddOrders">
                Добавить заказ
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                </svg>
            </a>

            <!-- Modal -->
            <div class="modal fade" id="ModalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Добавить пользователя</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <span class="text-center" id="success"></span>
                        <div class="modal-body">
                            <form action="/index.php" method="POST" id="addUser">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Имя</label>
                                    <input type="text" class="form-control" name="userName" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text"><span class="text-center" id="errors"></span></div>
                                </div>
                                <a type="submit" name="do_add_user" class="btn btn-primary add_user">Добавить</a>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="ModalAddOrders" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Добавить Заказ</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <span class="text-center" id="successOrder"></span>
                        <div class="modal-body">
                            <form id="addOrders">
                                <div class="mb-3">
                                    <select class="form-select" aria-label="Default select example" id="userSelect" name="userSelect">
                                        <option selected>Выбирете пользователя</option>
                                        <?php foreach ($order->GetUsers() as $itemUser) : ?>
                                             <option value="<?= $itemUser['id_user']?>"><?= $itemUser['name']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="textdescriptions" class="form-label">Описание</label>
                                    <textarea type="text" class="form-control" name="description" id="textdescriptions"></textarea>
                                    <label for="contact" class="form-label">Контактная информация</label>
                                    <input type="text" class="form-control" name="contact" id="contact">
                                    <label for="totalprice" class="form-label">Общая стоимость</label>
                                    <input type="text" class="form-control" name="totalprice" id="totalprice">
                                    <div id="" class="form-text"><span class="text-center" id="errors"></span></div>
                                </div>
                                <a type="submit" name="do_add_orders" class="btn btn-primary add_order">Добавить</a>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        </div>
                    </div>
                </div>
            </div>

            <a href="" type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalAdd">
                Добавить Пользователя
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                </svg>
            </a>
        </div>
    </div>
</div>
<div class="album py-5 bg-light" id="list">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php foreach ($order->ShowAllOrders()as $item) :?>
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <p class="card-text">Заказ №:<?= $item['id'] ?></p>
                            <p class="card-text"><?= $item['desctiption'] ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="/ordersfull.php?id=<?=$item['id']?>" class="btn btn-primary">
                                        Подробнее
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                        </svg>
                                       </a>
                                </div>
                                <small class="text-muted"><?= $item['dateadd']?></small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="src/js/jquery-3.6.1.min.js"></script>
<script>
    $(".add_user").click(function(e) {
        const erors = document.querySelector('#errors');
        const success = document.querySelector('#success');
        $.ajax({
            url: 'action/user.php',
            type: 'POST',
            data: {userName: $("#exampleInputEmail1").val(),do_add_user: ""},
            success: function(data)
            {
                if (data == "Пользователь добавлен!") {
                    erors.innerHTML = "";
                    success.innerHTML = '<span class="green">' + data + '</span>'
                } else {
                    success.innerHTML = "";
                    erors.innerHTML = '<span class="red">' + data + '</span>'
                }
            }
        });
    });
    $(".add_order").click(function(e) {
        let successorder = document.querySelector('#successOrder');
        $.ajax({
            url: 'action/orders.php',
            type: 'POST',
            cache: false,
            data: {
                do_add_orders: "",
                totalprice : $("#totalprice").val(),
                id_user : $("#userSelect").val(),
                desctiption : $("#textdescriptions").val(),
                conatcts : $("#contact").val()
            },
            success: function(data)
            {
                successorder.innerHTML = '<span class="green">' + data + '</span>'
                $("#list").load("index.php #list");
            }
        });
    });
</script>
</body>
</html>
