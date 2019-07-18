<?php

namespace App\Service;

use App\Service\ValidatorService;

class CsvService
{
    public function getData(string $path): array
    {
        $csv = array();
        $file = fopen($path, 'r');
        while (($result = fgetcsv($file)) !== false) {
            $csv[] = explode(';', $result[0]);
        }
        fclose($file);
        if (!empty($csv)) {
            $csv = $this->validate($csv);
        }

        return $csv;
    }
    
    private function validate(array $data): array
    {
        $validator = new ValidatorService();
        $validData = [];
        foreach ($data as $key => $item) {
			$invalidData = [];
            if (!$validator->validate($item[0], 'not_empty')) {
				$invalidData[] = $item[0];
            }
            if (!$validator->validate($item[1], 'not_empty')) {
				$invalidData[] = $item[1];
            }
            if (!$validator->validate($item[2], 'email')) {
				$invalidData[] = $item[2];
            }
            if (!$validator->validate($item[3], 'phone')) {
				$invalidData[] = $item[3];
            }
            if (!$validator->validate($item[4], 'phone')) {
				$invalidData[] = $item[4];
            }
			if (!empty($invalidData)) {
				unset($data[$key]);
				echo "\nInvalid data " . implode(', ', $invalidData) . " in csv line {$key}\n";
            } else {
                $validData[$item[2]] = $item;
            }
        }
        
        return $validData;
    }
}
