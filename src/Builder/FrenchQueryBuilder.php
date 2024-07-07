<?php

namespace App\Builder;

class FrenchQueryBuilder implements QueryBuilderInterface
{
    private array $select = [];
    private string $table = '';
    private array $condition = [];

    public function select(array $fields): QueryBuilderInterface
    {
        $this->select = $fields;

        return $this;
    }

    public function from(string $table): QueryBuilderInterface
    {
        $this->table = $table;

        return $this;
    }

    public function where(array $condition): QueryBuilderInterface
    {
        $this->condition = $condition;

        return $this;
    }

    public function getQuery(): string
    {
        return 'Je selection les champs suivants : ' . implode(',', $this->select) . ' Sur la table ' . $this->table . ' Avec les conditions : ' . implode('AND ', $this->condition) . ';';
    }
}