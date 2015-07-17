<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 19. 6. 2015
 * Time: 19:55
 */

namespace QW\FW\DP\Command;


use QW\FW\Basic\UnsupportedOperationException;

class ShowUseCommand
{

    private $commands = array();

    public function __construct()
    {
        $this->commands[] = new PrintCommand("First Line");
        $this->commands[] = new NewLineCommand();
        $this->commands[] = new PrintCommand("Second Line");
        $this->commands[] = new NewLineCommand();
    }

    public function showExample()
    {
        foreach ($this->commands as $command)
            // this code for check, if value in $commands array contains object which implements interface Command, in Java its not necessary
            if ($command instanceof Command)
                $command->execute();
            else
                throw new UnsupportedOperationException();
    }
}