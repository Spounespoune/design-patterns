<?php

namespace App\Builder;

class SqlQueryBuilder implements QueryBuilderInterface
{
    private array $select = ['*'];
    private string $from = '';
    private array $where = [];

    public function select(array $fields): self
    {
        $this->select = $fields;

        return $this;
    }

    public function from(string $table): self
    {
        $this->from = $table;

        return $this;
    }

    public function where(array $condition): self
    {
        $this->where = $condition;

        return $this;
    }

    public function getQuery(): string
    {
        if ('' === $this->from) {
            throw new \InvalidArgumentException('From is not set');
        }

        $select = 'SELECT ' . implode(',', $this->select);
        $from = ' FROM ' . $this->from;
        $where = [] === $this->where ? '' : ' WHERE ' . implode('AND ', $this->where);

        return $select . $from . $where . ';';
    }
}