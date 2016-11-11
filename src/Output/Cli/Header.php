<?php

namespace Geekout\Output\Cli;

/**
 * Class Header
 */
class Header
{
    use TraitConsole;

    public static $title = 'Hello darkness my old friend, i\'ve come to talk to you again! :)';

    private static $delimiter = '#';

    public function display()
    {
        $this->newLine();

        $howMany = (strlen(self::$title) + 11);
        $this->putDelimiter($howMany);

        echo '#### ' . self::$title . ' ####';
        $this->newLine();

        $this->putDelimiter($howMany);
    }
}