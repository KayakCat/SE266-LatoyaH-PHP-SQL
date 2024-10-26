<?php

class Person
{
    private $first;

    private $last;

    private $ID;

    private static $objectCount = 0;

    public function __construct ($firstArg, $lastArg){
        $this->first = $firstArg;
        $this->last = $lastArg
        $this-> self ::$objectCount;
        self::$objectCount++;

    }

    public function setFirst ($firstArg): void{
        $this->first = $firstArg;
    }

    public function setLast ($lastArg): void{
        $this->first = $firstArg;
    }
}

// Instantiate the account objects
$checking = new CheckingAccount('C123', 1000, '12-20-2019');
$savings = new SavingsAccount('S123', 5000, '03-20-2020');
