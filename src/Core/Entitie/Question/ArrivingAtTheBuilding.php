<?php

namespace Geekout\Core\Entitie\Question;

/**
 * Class ArrivingAtTheBuilding
 *
 * @package Geekout\Core\Entitie\Question
 */
class ArrivingAtTheBuilding extends AbstractQuestion
{
    public $title = 'Chega no prédio e o elevador está cheio';

    public $alternatives = [
        'Convence parte das pessoas a esperarem o próximo',
        'Ignora as pessoas no elevador e entra de qualquer forma',
        'Você questiona a realidade, as coisas e tudo mais. Sobe de escada',
        'Com uma leve intimidação passivo­agressiva, encontra um lugar no elevador',
        'Cria um app que mostra a lotação do elevador. Vende o app e fica milionário'
    ];
}