<?php


namespace LetEmTalk\Component\Domain\Chat\Entity;


use LetEmTalk\Component\Domain\User\Entity\User;

class Room
{
    private int $id;
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getId(): int
    {
        return $this->id;
    }
}