<?php

declare(strict_types=1);

namespace App\Component\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserManager
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function saveUser(User $user, bool $isNeedFlush = false): void
    {
        $this->entityManager->persist($user);

        if ($isNeedFlush) {
            $this->entityManager->flush();
        }
    }
}