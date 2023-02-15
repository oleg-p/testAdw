<?php

declare(strict_types=1);

namespace Adv\UserStory\Console;

use Yii;

class TwoProductFromTableByCollection
{
    public function rows(): array
    {
        $rows = Yii::$app->db->createCommand($this->sql())
            ->queryAll();

        return $rows;
    }

    private function sql(): string
    {
        return <<<SQL
select p1.* FROM product p1 
JOIN (
    SELECT p2.id_collection, SUBSTRING_INDEX(GROUP_CONCAT(id order by date DESC), ',', 2) AS ids
    FROM product p2
    GROUP BY id_collection
    ) p2
ON p1.id_collection = p2.id_collection AND FIND_IN_SET(p1.id, p2.ids)
SQL;
    }
}