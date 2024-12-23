<?php

declare(strict_types=1);

namespace App\Component\User\DTO;

use Symfony\Component\Serializer\Annotation\Groups;

class UserFullNameDto
{
    public function __construct(
        #[Groups(['user:write', 'user:read'])]
        private string $fatherName,

        #[Groups(['user:write'])]
        private string $motherName,

        #[Groups(['user:write','user:read'])]
        private bool $isMarried
    )
    {
    }

    public function getFatherName(): string
    {
        return $this->fatherName;
    }

    public function getMotherName(): string
    {
        return $this->motherName;
    }

    public function isMarried(): bool
    {
        return $this->isMarried;
    }
}