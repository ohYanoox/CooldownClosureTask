<?php
/*
__    __      ___   __   _   _____   _____  __    __
\ \  / /     /   | |  \ | | /  _  \ /  _  \ \ \  / /
 \ \/ /     / /| | |   \| | | | | | | | | |  \ \/ /
  \  /     / / | | | |\   | | | | | | | | |   }  {
  / /     / /  | | | | \  | | |_| | | |_| |  / /\ \
 /_/     /_/   |_| |_|  \_| \_____/ \_____/ /_/  \_\

This plugin is used to launch a closure task with a cooldown. It avoids having to create specialized class tasks, or having to define dynamic variables... well, to avoid complicated things. 
*/
namespace yournamespace;

use Closure;
use pocketmine\scheduler\CancelTaskException;
use pocketmine\scheduler\Task;
use pocketmine\utils\Utils;
use ReflectionException;

final class CooldownClosureTask extends Task
{
    /**
     * @var Closure
     * @phpstan-var \Closure() : void
     */
    private Closure $closure;
    private int $cooldown;
    private bool $isOver = false;

    /**
     * @param Closure $closure Must accept zero parameters
     * @phpstan-param \Closure() : void $closure
     */
    public function __construct(Closure $closure, int $cooldown)
    {
        $this->closure = $closure;
        $this->cooldown = $cooldown;
    }

    /**
     * @throws ReflectionException
     */
    public function getName(): string
    {
        return Utils::getNiceClosureName($this->closure);
    }

    public function getCooldown(): int
    {
        return $this->cooldown;
    }

    public function isOver(): bool
    {
        return $this->isOver;
    }

    public function onRun(): void
    {
        ($this->closure)($this->cooldown, $this->isOver);
        if ($this->cooldown <= 0) {
            $this->isOver = true;
            throw new CancelTaskException();
        }
        $this->cooldown--;
    }
}
