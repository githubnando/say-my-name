<?php

namespace Geekout\Core\Repository;

/**
 * Responsável pela obtenção das informações persistas referente às respostas.
 *
 * Class Answer
 *
 * @package Geekout\Core\Repository
 */
class Answer
{
    /**
     * @return array
     */
    public function getShows()
    {
        return [
            'a' => 'House of Cards',
            'b' => 'Game of Thrones',
            'c' => 'Lost',
            'd' => 'Breaking Bad',
            'e' => 'Silicon Valley'
        ];
    }
}
