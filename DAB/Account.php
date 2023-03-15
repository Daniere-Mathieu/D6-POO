<?php
class Account {
    private string $id;
    private string $name;
    private string $email;
    private string $password;
    private int $money;
    private int $age;

    public function addMoney($amount){
        $this->money += $amount;
    }
    public function removeMoney($amount){
        $this->money -= $amount;
    }
    public function getMoney(){
        return $this->money;
    }
}