<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 19. 6. 2015
 * Time: 19:51
 */

namespace QW\FW\DP\Command;


class NewLineCommand implements Command
{

    public function execute()
    {
        echo "<br>\n";
    }
}