<?php

namespace Geekout\Output\Cli;

use Geekout\Core\Entitie\Question\ArrivingAtTheBuilding;
use Geekout\Core\Entitie\Question\GointToWork;
use Geekout\Core\Entitie\Question\InTheMorning;
use Geekout\Core\Model\Question;

/**
 * Class Form
 *
 * @package Geekout\Output\Cli
 */
class Form
{
    public static $questions = [
        InTheManha::class => 'De manhã, você',
        TheAgendaIsComing::class => 'A pauta pegou o dia todo, mas você está indo para casa',
        GointToTrabalho::class => 'Indo para o trabalho você encontra uma senhora idosa caída na rua',
        ArrivingAtThePredio::class => 'Chega no prédio e o elevador está cheio',
        ArrivingAtTrabalho::class => 'Você chega no trabalho e as convenções sociais te obrigam a puxar assunto',
    ];

    public function display()
    {
        $questionRepository = new \Geekout\Core\Repository\Question();

        foreach ($questionRepository->findAllAlternatives() as $questionObject) {

        }
    }
}