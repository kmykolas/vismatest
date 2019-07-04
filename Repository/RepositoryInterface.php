<?php

interface Repository
{
    public function persistEntity(Person $person): bool;
    
    public function persistArray(array $person): bool;

    public function delete(string $email): bool;

    public function find(string $email): Person;

    public function read(): ?array;
}
