<?php

namespace Geekout\Core\Repository;

use Geekout\Core\Entitie\Question\AbstractQuestion;

/**
 * Class Question
 *
 * @package Geekout\Core\Repository
 */
class Question
{

    /**
     * @return AbstractQuestion[]
     */
    public function findAllAlternatives()
    {
        return array_map(function ($question) {
            return new $question;
        }, \Geekout\Core\Model\Question::$availableQuestions);
    }
}