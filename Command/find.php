#!php
<?php
require_once './cli.php';

class CliFind extends VismaCli
{

    public function execute()
    {
        $this->personEntity->setEmail($this->getFromCliInput('email', 'email'));

        $result = $this->personService->findPerson($this->personEntity);
        echo $result;
    }
}

$cli = new CliFind();
$cli->execute();
