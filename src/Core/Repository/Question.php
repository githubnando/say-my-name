<?php

namespace Geekout\Core\Repository;

use Geekout\Core\Entitie\Question\AbstractQuestion;
use Geekout\Core\Entitie\Question\ArrivingAtTheBuilding;
use Geekout\Core\Entitie\Question\ArrivingAtWork;
use Geekout\Core\Entitie\Question\GointToWork;
use Geekout\Core\Entitie\Question\InTheMorning;
use Geekout\Core\Entitie\Question\ScheduleFulfilled;

/**
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
     * @return AbstractQuestion[]
     */
    public function getAllQuestions()
    {
        return array_map(function ($question) {
            return new $question;
        }, self::$availableQuestions);
    }
}