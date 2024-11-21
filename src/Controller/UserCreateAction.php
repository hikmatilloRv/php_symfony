<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserCreateAction extends AbstractController
{
    public function __invoke(User $user): void
    {
        print $user->getEmail(). PHP_EOL;
        print $user->getFirstName();
        exit;
    }
}