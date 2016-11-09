<?php

namespace Geekout\Core\Contract;

/**
 * Interface FactoryInterface
 *
 * @package Geekout\Core\Contract
 */
interface FactoryInterface
{
    /**
     * @param $question
     *
     * @return mixed
     */
    public static function create($question);
}