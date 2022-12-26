<?php

class orders
{
    private PDO $connect;
    public function __construct()
    {
        $this->connect = new PDO('mysql:host=localhost;dbname=order', 'root', '');
    }
    private function SetSelet(string $table, array $fields)
    {
        $field = implode(',', array_values($fields)); 
        $response = $this->connect->prepare("SELECT `$field` FROM `$table`");
        $response->execute();
        return $response->FETCHALL(PDO::FETCH_ASSOC);
    }
    public function ShowAllOrders()
    {
        return $this->SetSelet('orders',['*']);
    }
    protected function SelectOrdersById($id)
    {
        $id = htmlspecialchars($id);
        $response = $this->connect->prepare("SELECT * FROM `orders` WHERE `id` = :id");
        $response->bindParam(':id',$id);
        $response->execute();
        $count = $response->rowCount();
        if ($count > 0) {
            return $response->FETCHALL(PDO::FETCH_ASSOC);
        }else {
            return "Такой заказ не найден";
        }

    }
    public function ShowOrdersById($id)
    {
        return $this->SelectOrdersById($id);
    }
    protected function SelectUserById($id)
    {
        $id = htmlspecialchars($id);
        $response = $this->connect->prepare("SELECT * FROM `user` WHERE `id_user` = :id");
        $response->bindParam(':id',$id);
        $response->execute();
        $count = $response->rowCount();
        if ($count > 0) {
            return $response->FETCHALL(PDO::FETCH_ASSOC);
        }else {
            return NULL;
        }
    }
    public function ShowUsersById($id)
    {
        return $this->SelectUserById($id);
    }
    protected function SelectOrdersByIdUser($id)
    {
        $id = htmlspecialchars($id);
        $response = $this->connect->prepare("SELECT * FROM `orders` WHERE `id_user` = :id");
        $response->bindParam(':id',$id);
        $response->execute();
        $count = $response->rowCount();
        if ($count > 0) {
            return $response->FETCHALL(PDO::FETCH_ASSOC);
        }else {
            return NULL;
        }
    }
    public function GetOrdersByIdUser($id)
    {
        return $this->SelectOrdersByIdUser($id);
    }
    protected function SelectUserByName($name)
    {
        $name = htmlspecialchars($name);
        $response = $this->connect->prepare("SELECT `name` FROM `user` WHERE `name` = :name");
        $response->bindParam(':name',$name);
        $response->execute();
        return $response->rowCount();
    }
    protected function AddUser($data)
    {
        $name = htmlspecialchars($data);
        $errrors = [];
        if ($name === "") {
            $errrors[] = "Заполните имя";
        }
        if ($this->SelectUserByName($name)) {
            $errrors[] = "такой пользователь уже есть!";
        }
        if (!empty($errrors)) {
            echo array_shift($errrors);
        }else {
            $response = $this->connect->prepare("INSERT INTO `user` (`name`) VALUES (:name)");
            $response->bindParam(':name',$name);
            $response->execute();
            if ($response) {
                echo "Пользователь добавлен!";
            }else {
                echo "Ошибка добавления в базу данных";
            }
        }
    }
    public function setUser($data) {
        return $this->AddUser($data);
    }
    public function GetUsers()
    {
         return $this->SetSelet('user',['*']);
    }
    protected function OrdersAdd($data)
    {
            $response = $this->connect->prepare("INSERT INTO `orders`(`totalprice`, `id_user`,`desctiption`, `conatcts`) VALUES (:totalprice, :id_user, :desctiption, :conatcts)");
            $response->bindParam(':totalprice',$data['totalprice']);
            $response->bindParam(':id_user',$data['id_user']);
            $response->bindParam(':desctiption',$data['desctiption']);
            $response->bindParam(':conatcts',$data['conatcts']);
            $response->execute();
            if ($response) {
                echo "запись добавлена";
            }else {
                echo "Ошибка добавления в базу данных";
            }
    }
    public function setOrders($data) {
        return $this->OrdersAdd($data);
    }
}