<?php

namespace yanoox;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use yanoox\CooldownClosureTask;

final class Example extends PluginBase implements Listener
{
    protected function onEnable(): void
    {

        $this->getScheduler()->scheduleRepeatingTask(new CooldownClosureTask(function (int $cooldown, bool $isOver /**any variable name you want */) {
            var_dump($cooldown);
            if($isOver) var_dump("it's over !");
            //the task will be cancelled as soon as the cooldown reaches: 0. (see CooldownClosureTask, onRun())
        }, 5/**every 20 ticks, the timer will be decremented by 1*/), 20);
    }
}
