<?php

namespace App\Command;

use App\Component\User\UserManager;
use App\Repository\UserRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'roles:add-to-user',
    description: 'Add a new role to the user',
    aliases: ['r-add']
)]
class RolesAddToUserCommand extends Command
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly UserManager $userManager
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $idQuestion = new Question('Type the Id of the user:  ');
        $roleQuestion = new Question('Type the role:  ');
        $questionHelper = $this->getHelper('question');

        $user = null;
        $role = '';

        while (!$user) {
            $id = $questionHelper->ask($input, $output, $idQuestion);
            $user = $this->userRepository->find($id);

            if (!$user) {
                $io->warning('No ID provided');
            } else {

                $role_list = implode(', ', $user->getRoles());

                $io->info(
                    'User Info: '.
                    $user->getEmail() .
                    ' : ' . $user->getLastName() .
                    ' User Current Roles: ' . $role_list
                );
            }
        }

        while (!preg_match('/^ROLE_[A-Z]{4,}$/', $role)) {
            $role = $questionHelper->ask($input, $output, $roleQuestion);

            if (!preg_match('/^ROLE_[A-Z]{4,}$/', $role)) {
                $io->warning('No role provided. You can use -- ROLE_ABC');
            }
        }

        if (!in_array($role, $user->getRoles(), true)) {
            $roles = $user->getRoles();
            $roles[] = $role;

            $user->setRoles($roles);
            $this->userManager->saveUser($user, true);

            $role_list = implode(', ', $user->getRoles());
            $io->success($role . ' is successfully added ' . $user->getId());
            // $io->info($user->getRoles()[0]. ' AND , ' .$user->getRoles()[1] . ' Role successfully added');
            $io->info($user->getFirstName() . ' Roles are - ' . $role_list);
            $io->block('Great Job!', 'DONE');


        } else {
            $io->warning($role .' is already exists');
        }



        return Command::SUCCESS;
    }
}
