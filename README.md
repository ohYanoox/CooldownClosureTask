# CooldownClosureTask
**No need to create multiple task files!**

## SETUP
**Drop the CooldownClosureTask file in your Core/Plugin... and edit the namespace! And now you can use this system perfectly**

An example is provided in Example.php

## Create the task
```php
//Arguments: Closure, timer (every 20 ticks, the timer will be decremented by 1)
$task = new CooldownClosureTask(function(){}, 5);
```

## Get the cooldown
```php
//$cooldown is optional for your own use
$task = new CooldownClosureTask(function(int $cooldown){}, 5);
```

## Launch the task
```php
$this->getScheduler()->scheduleRepeatingTask(new CooldownClosureTask(function(int $cooldown){}, 5), 20);
```
The task will be cancelled as soon as the input timer reaches 0. Of course you can cancel as soon as you want with :
```PHP
 throw new CancelTaskException();
```
## There you go! you can now create in any circumstance and modify scoreboards to the player
have a nice day ;)
