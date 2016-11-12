<?php

namespace Geekout\Output\Cli;

/**
 * Class Header
 */
class Header
{
    use TraitConsole;

    /** @var string Título do cabeçalho do formulário */
    public static $title = 'Hello darkness my old friend, i\'ve come to talk to you again! :)';

    /** @var string Delimitador do cabeçalho */
    private static $delimiter = '#';

    /**
     * Exibe o cabeçalho
     */
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