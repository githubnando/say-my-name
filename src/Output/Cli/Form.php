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
    public function display()
    {
        $questionRepository = new \Geekout\Core\Repository\Question();

        foreach ($questionRepository->findAllAlternatives() as $questionObject) {

        }
    }
}