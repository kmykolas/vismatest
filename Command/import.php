#!php
<?php
require_once './cli.php';

class CliImport extends VismaCli
{

    public function execute()
    {
        $path = $this->getFromCliInput('csv file path', 'file'); 
        $result = $this->personService->importPersons($path);
        echo $result;
    }
}

$cli = new CliImport();
$cli->execute();
