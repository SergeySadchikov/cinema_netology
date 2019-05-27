<?php

namespace App\Services;

abstract class Service
{
    protected $repository;

    abstract public function build(): array;
}