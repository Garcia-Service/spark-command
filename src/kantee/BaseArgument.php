<?php

namespace kantee;

use pocketmine\command\CommandSender;

abstract class BaseArgument {

    public string $name;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function getName(): string {
        return $this->name;
    }

    abstract public function execute(CommandSender $sender, array $args): void;
    
}