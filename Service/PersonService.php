<?php

namespace App\Service;

use App\Repository\FileDatabase\PersonRepository;
use App\Service\CsvService;
use App\Entity\Person;


class PersonService
{

    private $em;
    private $csv;

    public function __construct()
    {
        $this->em = new PersonRepository();
        $this->csv = new CsvService();
    }

    public function insertPerson(Person $person): string
    {
        $this->em->persistEntity($person);

        return "\nPerson inserted\n";
    }
    
    public function removePerson(Person $person): string
    {
        $result = $this->em->delete($person->getEmail());
        $message = ($result) ? "\nPerson removed\n" : "\nPerson not found\n";

        return $message;
    }
    
    public function findPerson(Person $person): string
    {
        $result = $this->em->find($person->getEmail());
        $message = (!empty($result->getEmail())) ? 
                $result->getFirstName() . ' ' . 
                $result->getLastName() . ' ' .
                $result->getEmail() . ' ' .
                $result->getPhone1() . ' ' .
                $result->getPhone2() . ' ' .
                $result->getComment() . ' '
            : "\nPerson not found\n";

        return $message;
    }
    
    public function importPersons(string $path): string
    {
        $data = $this->csv->getData($path);
        $this->em->persistArray($data);

        return "\nPerson inserted\n";
    }
}
