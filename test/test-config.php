<?php
return
    yii\helpers\ArrayHelper::merge(
        require __DIR__ . '/../common/config/main.php',
        require __DIR__ . '/../common/config/main-local.php',
        require __DIR__ . '/../common/config/test.php',
        require __DIR__ . '/../common/config/test-local.php',
        require __DIR__ . '/../console/config/main.php',
        require __DIR__ . '/../console/config/main-local.php',
        require __DIR__ . '/../console/config/test.php',
        require __DIR__ . '/../console/config/test-local.php'
    );