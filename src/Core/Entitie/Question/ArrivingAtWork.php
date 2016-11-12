<?php

namespace Geekout\Core\Entitie\Question;

/**
 * Class ArrivingAtWork
 *
 * @package Geekout\Core\Entitie\Question
 */
class ArrivingAtWork extends AbstractQuestion
{
    /** @inheritDoc */
    public $title = 'Você chega no trabalho e as convenções sociais te obrigam a puxar assunto';

    /** @inheritDoc */
    public static $alternatives = [
        'Fala sobre a política, eleições, como tudo é um absurdo',
        'Larga uma frase polêmica e vê uma pequena guerra se formar',
        'Puxa um assunto e te lembram que já foi discutido semana passada',
        'Sugere que os colegas trabalhem na ideia de um novo projeto',
        'Desabafa sobre como odeia PHP. Todo mundo na sala adora PHP'
    ];
}