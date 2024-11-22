<?php

declare(strict_types=1);

namespace App\Component\User;

use Symfony\Component\Serializer\Annotation\Groups;

class FullNameDto
{
    public function __construct(
        #[Groups(['user:write', 'user:read'])]
        private readonly string $fatherName,
        #[Groups(['user:write', 'user:read'])]
        private readonly bool $isMarried
    ) {
    }

    public function getFatherName(): string
    {
        return $this->fatherName;
    }

    public function isMarried(): bool
    {
        return $this->isMarried;
    }
}