<?php

namespace Geekout\Core\Entitie\Question;

/**
 * Class AbstractQuestion
 *
 * @package Geekout\Core\Entitie\Question
 */
class AbstractQuestion
{
    protected $alternatives = [];

    public static $questionNumerations = ['a','b','c','d','e'];

    /**
     * AbstractQuestion constructor.
     */
    public function __construct()
    {
        $this->alternatives = $this->addNumerations($this->alternatives);
    }

    /**
     * @param array $alternatives
     *
     * @return array
     */
    protected function addNumerations(array $alternatives)
    {
        return array_combine(self::$questionNumerations, $this->alternatives);
    }
}