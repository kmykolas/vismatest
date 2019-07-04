#!php
<?php
require_once './cli.php';

class CliDelete extends VismaCli
{

    public function execute()
    {
        $this->personEntity->setEmail($this->getFromCliInput('email', 'email'));

        $result = $this->personService->removePerson($this->personEntity);
        echo $result;
    }
}

$cli = new CliDelete();
$cli->execute();
