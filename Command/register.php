#!php
<?php

namespace App\Command;

require_once 'vendor/autoload.php';

use App\Command\VismaCli;

class Cli extends VismaCli
{
    public function execute()
    {
        $this->personEntity->setFirstName($this->getFromCliInput('first name', 'not_empty'));
        $this->personEntity->setLastName($this->getFromCliInput('last name', 'not_empty'));
        $this->personEntity->setEmail($this->getFromCliInput('email', 'email'));
        $this->personEntity->setPhone1($this->getFromCliInput('phone1', 'phone'));
        $this->personEntity->setPhone2($this->getFromCliInput('phone2', 'phone'));
        $this->personEntity->setComment($this->getFromCliInput('comment', 'empty'));
        
        $result = $this->personService->insertPerson($this->personEntity);
        echo $result;
        
    }
}

$cli = new Cli();
$cli->execute();
