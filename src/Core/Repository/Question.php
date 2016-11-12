<?php

namespace Geekout\Core\Repository;

use Geekout\Core\Entitie\Question\AbstractQuestion;
use Geekout\Core\Entitie\Question\ArrivingAtTheBuilding;
use Geekout\Core\Entitie\Question\ArrivingAtWork;
use Geekout\Core\Entitie\Question\GointToWork;
use Geekout\Core\Entitie\Question\InTheMorning;
use Geekout\Core\Entitie\Question\ScheduleFulfilled;

/**
 * Responsável pela obtenção das informações persistas referente às perguntas.
 *
 * Class Question
 *
 * @package Geekout\Core\Repository
 */
class Question
{
    /**
     * @var AbstractQuestion[]
     */
    public static $availableQuestions = [
        GointToWork::class,
        ArrivingAtTheBuilding::class,
        ArrivingAtWork::class,
        InTheMorning::class,
        ScheduleFulfilled::class
    ];

    /**
     * @return array
     */
    public function getDescriptions()
    {
        return [
            'a' => 'Você é House of Cards: ataca o problema com método e faz de ' .
                'tudo para resolver a situação.',

            'b'=> 'Você é Game of Thrones: não tem muita delicadeza nas ações, ' .
                'mas resolve o problema de forma prática.',

            'c' => 'Você é Lost: faz as coisas sem ter total certeza se é o caminho certo ou se faz ' .
                'sentido, mas no final dá tudo certo.',

            'd' => 'Você é Breaking Bad: pra fazer acontecer você toma a liderança, mas ' .
                'sempre contando com seus parceiros.',

            'e' => 'Você é Silicon Valley: vive a tecnologia o tempo todo e faz disso um ' .
                'mantra para cada situação no dia.',
        ];
    }

    /**
     * @return AbstractQuestion[]
     */
    public function getAllQuestions()
    {
        return array_map(function ($question) {
            return new $question;
        }, self::$availableQuestions);
    }
}