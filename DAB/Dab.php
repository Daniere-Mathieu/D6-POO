<?php
require_once("./IBank.php");
require_once("./Account.php");
require_once("./BankCheck.php");

class Dab implements IBank
{
    private int $moneyLeft;
    private Dab $instance;
    private array $bankChecks = [];

    private function __construct($moneyLeft){
        $this->moneyLeft = $moneyLeft;
    }

    public static function getInstance(): Dab
    {
        if(self::$instance == null){
            self::$instance = new Dab();
        }
        return self::$instance;
    }

    public function withdrawMoney(int $amount,Account $account){
        if ($amount > $this->moneyLeft) {
            throw new Exception("Not enough money");
        }
        $this->moneyLeft -= $amount;
        $account->addMoney($amount);
    }

    public function depositMoney(int $amount,Account $account) {
        if ($amount > $account->getMoney()) {
            throw new Exception("Not enough money");
        }
        $this->moneyLeft += $amount;
        $account->removeMoney($amount);
    }

    public function consultBalance(Account $account) {
        return $account->getMoney();
    }

    public function depositBankCheck(BankCheck $bankCheck) {
        array_push($this->bankChecks, $bankCheck);
    }

    public function activeBankChecks() {
        foreach($this->bankChecks as $bankCheck) {
            if ($bankCheck->isValid()) {
                $this->depositMoney($bankCheck->getAmount(), $bankCheck->getAccount());
            }
        }
    }

};