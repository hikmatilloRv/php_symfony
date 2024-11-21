<?php

declare(strict_types=1);

namespace App\Controller;

use ApiPlatform\Validator\ValidatorInterface;
use App\Component\User\UserFactory;
use App\Component\User\UserManager;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserCreateAction extends AbstractController
{
    public function __construct(
        private readonly UserFactory $userFactory,
        private readonly UserManager $userManager,
        private readonly ValidatorInterface $validator
    ) {
    }

    /**
     * @throws \DateMalformedStringException
     */
    public function __invoke(User $data): User
    {
        $this->validator->validate($data);

        $user = $this->userFactory->createUser(
            $data->getEmail(),
            $data->getPassword(),
            $data->getFirstName(),
            $data->getLastName(),
            $data->getAge(),
            $data->getGender(),
            $data->getPhone()
        );

        $this->userManager->saveUser($user, true);

        return $user;
    }
}