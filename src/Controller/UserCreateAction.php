<?php

declare(strict_types=1);

namespace App\Controller;

use App\Component\User\UserFactory;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserCreateAction extends AbstractController
{
    public function __construct(private readonly UserFactory $userFactory)
    {
    }

    /**
     * @throws \DateMalformedStringException
     */
    public function __invoke(User $data): void
    {
        $user = $this->userFactory->createUser(
            $data->getEmail(),
            $data->getPassword(),
            $data->getFirstName(),
            $data->getLastName(),
            $data->getAge(),
            $data->getGender(),
            $data->getPhone()
        );

        print_r($user);
        exit;
    }
}