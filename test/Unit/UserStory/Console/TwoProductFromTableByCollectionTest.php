<?php

declare(strict_types=1);

namespace Adv\UserStory\Console;

use PHPUnit\Framework\TestCase;
use Yii;
use yii\console\Application;
use yii\db\Connection;

class TwoProductFromTableByCollectionTest extends TestCase
{
    private Connection $db;

    public function testName()
    {
        $this->seed();

        $result = (new TwoProductFromTableByCollection())
            ->rows();

        $this->assertIsArray($result);

        $this->assertCount(
            count($this->productFreshRows()),
            $result
        );

        foreach ($this->productFreshRows() as $productFreshRow) {
            $this->assertEquals(
                array_filter($this->productFreshRows(), fn(array $row) => $row['id'] === $productFreshRow['id']),
                array_filter($result, fn(array $row) => $row['id'] === $productFreshRow['id'])
            );
        }
    }

    private function seed(): void
    {
        foreach (
            array_merge(
                $this->productRows(),
                $this->productFreshRows()
            )
            as $productRow
        ) {
            Yii::$app->db->createCommand()->insert(
                'product',
                $productRow
            )
                ->execute();
        }
    }

    private function productRows(): array
    {
        return [
            ['id' => 1, 'name' => 'Товар 1', 'id_collection' => 2, 'price' => 10, 'date' => '2017-02-22 11:04:16'],
            ['id' => 2, 'name' => 'Товар 2', 'id_collection' => 1, 'price' => 100, 'date' => '2017-02-22 11:04:16'],
            ['id' => 3, 'name' => 'Товар 3', 'id_collection' => 3, 'price' => 101, 'date' => '2017-02-22 11:04:16'],
            ['id' => 4, 'name' => 'Товар 4', 'id_collection' => 2, 'price' => 120, 'date' => '2017-02-02 11:04:16'],
            ['id' => 5, 'name' => 'Товар 5', 'id_collection' => 2, 'price' => 130, 'date' => '2017-02-03 11:04:16'],
            ['id' => 6, 'name' => 'Товар 6', 'id_collection' => 3, 'price' => 140, 'date' => '2017-02-03 11:04:16'],
            ['id' => 7, 'name' => 'Товар 7', 'id_collection' => 1, 'price' => 150, 'date' => '2017-02-03 11:04:16'],
            ['id' => 8, 'name' => 'Товар 8', 'id_collection' => 2, 'price' => 610, 'date' => '2017-02-03 11:04:16'],
        ];
    }

    private function productFreshRows(): array
    {
        return [
            [
                'id' => 10,
                'name' => 'Товар 10',
                'id_collection' => 1,
                'price' => 10,
                'date' => '2022-02-22 11:04:16'
            ],
            [
                'id' => 20,
                'name' => 'Товар 20',
                'id_collection' => 2,
                'price' => 20,
                'date' => '2022-02-22 11:04:16'
            ],
            [
                'id' => 30,
                'name' => 'Товар 30',
                'id_collection' => 3,
                'price' => 30,
                'date' => '2022-02-22 11:04:16'
            ],
            [
                'id' => 40,
                'name' => 'Товар 40',
                'id_collection' => 1,
                'price' => 100,
                'date' => '2022-02-02 11:04:16'
            ],
            [
                'id' => 50,
                'name' => 'Товар 50',
                'id_collection' => 2,
                'price' => 200,
                'date' => '2022-02-03 11:04:16'
            ],
            [
                'id' => 60,
                'name' => 'Товар 60',
                'id_collection' => 3,
                'price' => 12,
                'date' => '2022-02-03 11:04:16'
            ],
        ];
    }

    protected function setUp(): void
    {
        new Application(require __DIR__ . '/../../../test-config.php');

        Yii::$app->db->createCommand('Truncate product')->execute();
    }
}
