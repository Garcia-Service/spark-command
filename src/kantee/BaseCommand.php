<?php

namespace kantee;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

abstract class BaseCommand extends Command {

    public array $arguments = [];

    public function __construct($name, $description, $usage) {
        parent::__construct($name, $description, $usage);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if (empty($args)) {
            $sender->sendMessage($this->getUsage());
            return;
        }
        $argumentName = array_shift($args);
        $argument = $this->getArgument($argumentName);

        if ($argument === null) {
            $sender->sendMessage($this->getUsage());
            return;
        }

        $argument->execute($sender, $args);
    }

    public function getArguments(): array {
        return $this->arguments;
    }

    public function addArgument(BaseArgument $argument): void {
        if (isset($this->arguments[$argument->getName()])) {
            throw new \InvalidArgumentException("Argument with name {$argument->getName()} already exists");
        }
        $this->arguments[$argument->getName()] = $argument;
    }

    public function getArgument($name): ?BaseArgument {
        return array_filter($this->arguments, function($argument) use ($name) {
            return $argument->getName() === $name;
        })[0];
    }

}