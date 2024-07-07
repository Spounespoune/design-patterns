<?php

namespace App\Builder;

interface QueryBuilderInterface
{
    public function select(array $fields): self;

    public function from(string $table): self;

    public function where(array $condition): self;

    public function getQuery(): string;
}