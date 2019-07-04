<?php
require_once('../Service/PersonService.php');
require_once '../Entity/Person.php';
require_once('../Service/ValidatorService.php');

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