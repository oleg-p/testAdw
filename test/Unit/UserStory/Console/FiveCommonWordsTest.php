<?php

declare(strict_types=1);

namespace Adv\UserStory\Console;

use PHPUnit\Framework\TestCase;

class FiveCommonWordsTest extends TestCase
{
    public function testResultEmptyText()
    {
        $result = (new FiveCommonWords(''))->result();

        $this->assertIsArray($result);
        $this->assertCount(0, $result);
    }

    public function testOneWord()
    {
        $result = (new FiveCommonWords('one'))->result();

        $this->assertIsArray($result);
        $this->assertCount(1, $result);
    }

    public function testThreeDifferentWords()
    {
        $result = (new FiveCommonWords('one two three'))->result();

        $this->assertIsArray($result);
        $this->assertCount(3, $result);

        $this->assertArrayHasKey('one', $result);
        $this->assertEquals(1, $result['one']);
    }

    public function testFiveWordsAndTwoSame()
    {
        $result = (new FiveCommonWords('one two three two one'))->result();

        $this->assertIsArray($result);
        $this->assertCount(3, $result);

        $this->assertArrayHasKey('one', $result);
        $this->assertEquals(2, $result['one']);
    }

    public function testSixWords()
    {
        $result = (new FiveCommonWords('one two three four five six'))->result();

        $this->assertIsArray($result);
        $this->assertCount(5, $result);
    }

    public function testManyWords()
    {
        $result =
            (new FiveCommonWords('one two three four five six seven one two three four five one two three one two two'))
                ->result();

        $this->assertIsArray($result);
        $this->assertCount(5, $result);

        $this->assertArrayNotHasKey('six', $result);

        $this->assertArrayHasKey('one', $result);
        $this->assertEquals(4, $result['one']);

        $this->assertArrayHasKey('two', $result);
        $this->assertEquals(5, $result['two']);

        $this->assertArrayHasKey('three', $result);
        $this->assertEquals(4, $result['one']);

        $this->assertArrayHasKey('four', $result);
        $this->assertEquals(2, $result['four']);

        $this->assertArrayHasKey('five', $result);
        $this->assertEquals(2, $result['five']);
    }

    public function testManyWordsWithDifferentCase()
    {
        $result =
            (new FiveCommonWords('one TWO three Four five six Seven one tWo three four Five One two three one two two'))
                ->result();

        $this->assertIsArray($result);
        $this->assertCount(5, $result);

        $this->assertArrayNotHasKey('six', $result);

        $this->assertArrayHasKey('one', $result);
        $this->assertEquals(4, $result['one']);

        $this->assertArrayHasKey('two', $result);
        $this->assertEquals(5, $result['two']);

        $this->assertArrayHasKey('three', $result);
        $this->assertEquals(4, $result['one']);

        $this->assertArrayHasKey('four', $result);
        $this->assertEquals(2, $result['four']);

        $this->assertArrayHasKey('five', $result);
        $this->assertEquals(2, $result['five']);
    }

    public function testManyWordsWithDifferentCaseAndCyrillicSymbols()
    {
        $result =
            (new FiveCommonWords('one ДВА three Four five six Seven one дВа three four Five One два three one два два'))
                ->result();

        $this->assertIsArray($result);
        $this->assertCount(5, $result);

        $this->assertArrayNotHasKey('six', $result);

        $this->assertArrayHasKey('one', $result);
        $this->assertEquals(4, $result['one']);

        $this->assertArrayHasKey('два', $result);
        $this->assertEquals(5, $result['два']);

        $this->assertArrayHasKey('three', $result);
        $this->assertEquals(4, $result['one']);

        $this->assertArrayHasKey('four', $result);
        $this->assertEquals(2, $result['four']);

        $this->assertArrayHasKey('five', $result);
        $this->assertEquals(2, $result['five']);
    }

    public function testPlainText()
    {
        $plainText = <<<BEGIN
Yii приложения организованы согласно шаблону проектирования модель-представление-контроллер (MVC).
Модели представляют собой данные, бизнес логику и бизнес правила; представления отвечают за отображение информации,
в том числе и на основе данных, полученных из моделей; контроллеры принимают входные данные от пользователя
и преобразовывают их в понятный для моделей формат и команды, а также отвечают за отображение нужного представления.
BEGIN;

        $result =
            (new FiveCommonWords(
                $plainText
            ))
                ->result();

        var_dump($result);

        $this->assertIsArray($result);
        $this->assertCount(5, $result);

        $this->assertArrayHasKey('и', $result);
        $this->assertEquals(4, $result['и']);

        $this->assertArrayHasKey('данные', $result);
        $this->assertEquals(2, $result['данные']);

        $this->assertArrayHasKey('бизнес', $result);
        $this->assertEquals(2, $result['бизнес']);
    }
}
