<?php

namespace App\Command;

use App\Factory\CarFactory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'test',
    description: 'Add a short description for your command',
)]
class TestCommand
{
    public function __invoke(
        SymfonyStyle $io,
    ): int {

        $car = CarFactory::new()->create();

        return Command::SUCCESS;
    }
}
