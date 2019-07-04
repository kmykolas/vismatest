<?php

require_once('../Entity/Person.php');
require_once('../Repository/RepositoryInterface.php');

class PersonRepository implements Repository
{
    const DATA_FILE = 'data_file';
    
    public function persistEntity(Person $person): bool
    {
        $currentData = $this->read();
        $currentData[$person->getEmail()] = 
            $person->getFirstName() . ';' .
            $person->getLastName() . ';' .
            $person->getEmail(). ';' .
            $person->getPhone1() . ';' .
            $person->getPhone2() . ';' .
            $person->getComment()
        ;
        file_put_contents('../' . SELF::DATA_FILE, implode('---', $currentData));

        return true;
    }
    
    public function persistArray(array $persons): bool
    {
        $currentData = $this->read();
        foreach ($persons as $key => $person) {
            $currentData[$key] = $person[0] . ';' .
                $person[1] . ';' .
                $person[2] . ';' .
                $person[3] . ';' .
                $person[4] . ';' .
                $person[5]
            ;
        }
        file_put_contents('../' . SELF::DATA_FILE, implode('---', $currentData));
        return true;
    }

    public function delete(string $email): bool
    {
        $deleted = false;
        $currentData = $this->read();
        if (isset($currentData[$email])) {
            unset($currentData[$email]);
            file_put_contents('../' . SELF::DATA_FILE, implode('---', $currentData));
            $deleted = true;
        }

        return $deleted;
    }

    public function find (string $email): Person
    {
        $person = new Person();
        $currentData = $this->read();
        if (isset($currentData[$email])) {
            $item = explode(';', $currentData[$email]);
            $person->setFirstName($item[0]);
            $person->setLastName($item[1]);
            $person->setEmail($item[2]);
            $person->setPhone1($item[3]);
            $person->setPhone2($item[4]);
            $person->setComment($item[5]);
        }
        
        return $person;
}

    public function read(): ?array
    {
        $content = file_get_contents('../' . SELF::DATA_FILE);
        //for such action need to use factory or smth like that
        if (empty($content)) {
            return [];
        }
        $result = [];
        foreach (explode('---', $content) as $row) {
            $item = explode(';', $row);
            if (empty($item[2])) {
                continue;
            }            
            $result[$item[2]] = $row;
        };
        
        return $result;
    }
}
