<?php
require_once("./Account.php");

class BankCheck {

    private int $amount;
    private Account $account;

    private function getAmount(){
        return $this->amount;
    }

    public function getAccount(){
        return $this->account;
    }

    public function isValid(){
        return $this->account->getMoney() >= $this->amount;
    }

}