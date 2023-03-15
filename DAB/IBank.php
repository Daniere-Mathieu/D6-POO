<?php
require_once("./Account.php");
Interface Ibank {
    public function withdrawMoney(int $amount,Account $account);
    public function depositMoney(int $amount,Account $account);
    public function consultBalance(Account $account);
    public function depositBankCheck($bankCheck);
    public function activeBankChecks();
}