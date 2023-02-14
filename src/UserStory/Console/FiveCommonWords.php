<?php

declare(strict_types=1);

namespace Adv\UserStory\Console;

class FiveCommonWords
{
    private string $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function result(): array
    {
        $wordsCount = array_reduce(
            array_map(
                fn(string $word) => mb_strtolower($word),
                str_word_count(
                    $this->text,
                    1,
                    'АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя'
                )
            ),
            fn(array $carry, string $word) => key_exists($word, $carry)
                ? array_merge($carry, [$word => $carry[$word] + 1])
                : array_merge($carry, [$word => 1]),
            []
        );

        arsort($wordsCount, SORT_NUMERIC);

        return array_slice($wordsCount, 0, 5);
    }
}