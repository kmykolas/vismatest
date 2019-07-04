<?php

namespace App\Service;

class ValidatorService
{
    public function validate($value, $type): string
    {
        switch ($type) {
            case "not_empty":
                return $this->isNotEmpty($value);
                break;
            case "email":
                return $this->isEmail($value);
                break;
            case "phone":
                return $this->isPhone($value);
                break;
            case "file":
                return $this->isFile($value);
                break;
            default:
                return true;;
        }
    }
    
    private function isNotEmpty(string $value): bool
    {
        return (!empty($value));
    }
    
    private function isEmail(string $value): bool
    {
        return (filter_var($value, FILTER_VALIDATE_EMAIL));
    }
    
    private function isPhone(string $value): bool
    {
        return (filter_var($value, FILTER_SANITIZE_NUMBER_INT) || empty($value));
    }
    
    private function isFile(string $value): bool
    {
        return (file_exists($value) && !empty($value));
    }
}
