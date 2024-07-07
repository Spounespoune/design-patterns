<?php

namespace App\Tests\Builder;

use App\Builder\FrenchQueryBuilder;
use App\Builder\SqlQueryBuilder;
use PHPUnit\Framework\TestCase;

class QueryBuilderTest extends TestCase
{
    public function testQueryBuilderWithSelectAndFrom()
    {
        $queryBuilder = new SqlQueryBuilder();
        $query = $queryBuilder
            ->select([
                'id',
                'price',
                'color',
            ])
            ->from('car')
            ->getQuery();

        self::assertSame('SELECT id,price,color FROM car;', $query);
    }

    public function testQueryBuilderChangeFrom()
    {
        $queryBuilder = new SqlQueryBuilder();
        $query = $queryBuilder
            ->select([
                'id',
                'price',
                'color',
            ])
            ->from('car')
            ->from('bike')
            ->getQuery();

        self::assertSame('SELECT id,price,color FROM bike;', $query);
    }

    public function testQueryBuilderWithoutFrom()
    {
        $queryBuilder = new SqlQueryBuilder();
        self::expectException(\InvalidArgumentException::class);
        $queryBuilder
            ->select([
                'id',
                'price',
                'color',
            ])
            ->getQuery();

    }

    public function testQueryBuilderWithSelectAndFromAndWhere()
    {
        $queryBuilder = new SqlQueryBuilder();
        $query = $queryBuilder
            ->select([
                'id',
                'price',
                'color',
            ])
            ->from('car')
            ->where(
                [
                    'id > 4 ',
                    'price < 10000'
                ]
            )
            ->getQuery();

        self::assertSame('SELECT id,price,color FROM car WHERE id > 4 AND price < 10000;', $query);
    }

    public function testQueryBuilderMoreUnderstandLanguage()
    {
        $frenchQueryBuidler = new FrenchQueryBuilder();
        $query = $frenchQueryBuidler->select([
            'id',
            'price',
            'color',
        ])
            ->from('car')
            ->where(
                [
                    'id > 4 ',
                    'price < 10000'
                ]
            )
            ->getQuery();

        self::assertSame('Je selection les champs suivants : id,price,color Sur la table car Avec les conditions : id > 4 AND price < 10000;', $query);
    }
}