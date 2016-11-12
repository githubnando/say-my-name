<?php

namespace Geekout\Core\Entitie\Question;

/**
 * Class GointToWork
 *
 * @package Geekout\Core\Entitie\Question
 */
class GointToWork extends AbstractQuestion
{
    public $title = 'Indo para o trabalho você encontra uma senhora idosa caída na rua';

    public static $alternatives = [
        'Ela vai atrapalhar seu horário. Oculte o corpo',
        'Levanta a senhora e jura protegê­la com sua vida',
        'Ajuda­a, mas questiona sua real identidade',
        'Oferece para caminharem juntos até um destino em comum',
        'Testa se ela roda bem no Firefox. Não roda'
    ];
}