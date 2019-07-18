<?php

namespace App\Command;

use App\Service\PersonService;
use App\Entity\Person;
use App\Service\ValidatorService;

class VismaCli
{
    public $personService;
    public $personEntity;
    private $validator;

public function __construct()
    {
        $this->personService = new PersonService();
        $this->personEntity = new Person();
        $this->validator = new ValidatorService();
}
    
    public function getFromCliInput(string $name, string $type): ?string
    {
        echo 'Please enter ' . $name . ': ';
        $handle = fopen('php://stdin', 'rb');
        $input=  str_replace(array("\n", "\r"), '', fgets($handle));
        if(!$this->validator->validate($input, $type)) {    
            return $this->getFromCliInput($name, $type);
        }
        
        return $input;
    }
}