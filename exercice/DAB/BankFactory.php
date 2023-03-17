<?php
require_once("./IBank.php");
require_once("./DAB.php");
require_once("./Banker.php");
require_once("./Verification.php");

class BankFactory {
    public static function createIBank(string $type,int $moneyLeft,$name = "",$age = 18): IBank {
        if(!Verification::functionParamExistAndIsNotEmpty(func_get_args())){
            throw new Exception("Invalid parameters");
        }
        $type = strtolower($type);
        switch($type){
            case "dab":
                return DAB::getInstance($moneyLeft);
            case "banker":
                if(strlen($name) > 0 && $age > 18){
                    return new Banker($moneyLeft,$name,$age);
                }
                else{
                    throw new Exception("Invalid name or age");
                }
            default:
                throw new Exception("Invalid bank type");
        }
    }
}