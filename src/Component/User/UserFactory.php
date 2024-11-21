<?php

declare(strict_types=1);

namespace App\Component\User;

use App\Entity\User;
use DateTimeZone;
use Symfony\Component\Clock\DatePoint;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFactory
{
    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher)
    {
    }

    /**
     * @throws \DateMalformedStringException
     */
    public function createUser(
        string $email,
        string $password,
        string $firstName,
        string $lastName,
        int $age,
        string $gender,
        string $phone
    ): User
    {
        $user = new User();

        $hashedPassword = $this->passwordHasher->hashPassword($user, $password);

        $user->setEmail($email);
        $user->setPassword($hashedPassword);
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setAge($age);
        $user->setGender($gender);
        $user->setPhone($phone);
        $user->setCreatedAt(new DatePoint(timezone: new DateTimeZone('Asia/Tokyo')));

        return $user;
    }
}