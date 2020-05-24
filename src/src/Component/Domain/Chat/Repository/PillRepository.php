<?php


namespace LetEmTalk\Component\Domain\Chat\Repository;


use LetEmTalk\Component\Domain\Chat\Entity\Pill;

interface PillRepository
{
    public function save(Pill $pill): void;
}