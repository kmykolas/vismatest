<?php

namespace App\Tests\Unit\Service;

use App\Service\ValidatorService;
use PHPUnit\Framework\TestCase;

class FlightsPairMatcherTest extends TestCase
{
    private $validator;
    public function __construct()
    {
        parent::__construct();
        $this->validator = new ValidatorService();
    }

    public function testValidateWhenEmailIsInvalid()
    {
        $result = $this->validator->validate('test', 'email');
        $expectedResult = false;

        $this->assertEquals($result, $expectedResult);
    }
    
    public function testValidateWhenEmailIsValid()
    {
        $result = $this->validator->validate('test@test.lt', 'email');
        $expectedResult = true;

        $this->assertEquals($result, $expectedResult);
    }
}
