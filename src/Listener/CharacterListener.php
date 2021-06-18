<?php


namespace App\Listener;


use App\Entity\Character;

class CharacterListener
{

    public function prePersist(Character $character): void
    {
        $this->prepareCharacterEntity($character);
    }

    public function postPersist(Character $character): void
    {
        $this->prepareCharacterEntity($character);
    }

    public function preUpdate(Character $character): void
    {
        $this->prepareCharacterEntity($character);
    }

    public function postUpdate(Character $character): void
    {
        $this->prepareCharacterEntity($character);
    }

    private function prepareCharacterEntity(Character $character): void
    {
        $specMapping = [
            4 => [
                'class' => 6,
                'metaSpec' => 4
            ],
            5 => [
                'class' => 6,
                'metaSpec' => 1
            ],
            6 => [
                'class' => 6,
                'metaSpec' => 2
            ],
            7 => [
                'class' => 7,
                'metaSpec' => 4
            ],
            8 => [
                'class' => 7,
                'metaSpec' => 4
            ],
            9 => [
                'class' => 7,
                'metaSpec' => 4
            ],
            10 => [
                'class' => 2,
                'metaSpec' => 4
            ],
            11 => [
                'class' => 3,
                'metaSpec' => 4
            ],
            12 => [
                'class' => 3,
                'metaSpec' => 4
            ],
            13 => [
                'class' => 9,
                'metaSpec' => 2
            ],
            14 => [
                'class' => 9,
                'metaSpec' => 1
            ],
            15 => [
                'class' => 9,
                'metaSpec' => 3
            ],
            16 => [
                'class' => 2,
                'metaSpec' => 2
            ],
            17 => [
                'class' => 2,
                'metaSpec' => 2
            ],
            18 => [
                'class' => 2,
                'metaSpec' => 4
            ],
            19 => [
                'class' => 5,
                'metaSpec' => 3
            ],
            20 => [
                'class' => 5,
                'metaSpec' => 3
            ],
            21 => [
                'class' => 5,
                'metaSpec' => 3
            ],
            22 => [
                'class' => 8,
                'metaSpec' => 4
            ],
            23 => [
                'class' => 8,
                'metaSpec' => 3
            ],
            24 => [
                'class' => 8,
                'metaSpec' => 2
            ],
            25 => [
                'class' => 4,
                'metaSpec' => 4
            ],
            26 => [
                'class' => 4,
                'metaSpec' => 4
            ],
            27 => [
                'class' => 4,
                'metaSpec' => 4
            ],
            28 => [
                'class' => 1,
                'metaSpec' => 3
            ],
            29 => [
                'class' => 1,
                'metaSpec' => 3
            ],
            30 => [
                'class' => 1,
                'metaSpec' => 1
            ]
        ];
        if ($character->getSpec() !== null && isset($specMapping[$character->getSpec()])) {
            $character->setMetaspec($specMapping[$character->getSpec()]['metaSpec']);
            $character->setClass($specMapping[$character->getSpec()]['class']);
        }

    }
}