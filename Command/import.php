#!php
<?php

namespace App\Command;

require_once 'vendor/autoload.php';

use App\Command\VismaCli;

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
