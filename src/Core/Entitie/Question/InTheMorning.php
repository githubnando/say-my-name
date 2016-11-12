<?php

namespace Geekout\Core\Entitie\Question;

/**
 * Class InTheMorning
 *
 * @package Geekout\Core\Entitie\Question
 */
class InTheMorning extends AbstractQuestion
{
    public $title = 'De manhã, você';

    public $alternatives = [
        'Acorda cedo e come frutas cortadas metodicamente',
        'Sai da cama com o despertador e se prepara para a batalha da semana',
        'Só consegue lembrar do seu nome depois do café',
        'Levanta e faz café pra todos da casa',
        'Passa o café e conserta um erro no HTML',
    ];
}