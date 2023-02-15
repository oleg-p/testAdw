<?php

declare(strict_types=1);

namespace console\modules\Arithmetic\controllers;

use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

class DoController extends Controller
{
    /**
     *Расчёт суммы
     */
    public function actionSum()
    {
        $data = $this->module->data;

        Console::output(
            sprintf(
                'Сумма чисел: %s равна %d',
                implode(', ', $data),
                array_sum($data)
            )
        );

        return ExitCode::OK;
    }

    /**
     * Расчёт произведения
     */
    public function actionProduct()
    {
        $data = $this->module->data;

        Console::output(
            sprintf(
                'Произведение чисел: %s равно %d',
                implode(', ', $data),
                array_product($data)
            )
        );

        return ExitCode::OK;
    }
}