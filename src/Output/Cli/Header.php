<?php

namespace Geekout\Output\Cli;

/**
 * Class Header
 */
class Header
{
    use TraitConsole;

    private $delimiter = '#';

    private $title = 'Hello darkness my old friend, i\'ve come to talk to you again! :)';

    public function display()
    {
        $this->newLine();

        $howMany = (strlen($this->title) + 11);
        $this->putDelimiter($howMany);

        echo "#### {$this->title} ####";
        $this->newLine();

        $this->putDelimiter($howMany);
    }
}