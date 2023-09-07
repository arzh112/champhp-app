<?php

interface IgetData 
{
    /**
     * Get all data from data base
     *
     * @param PDO $pdo - Connection instance
     * @return array - array of objects
     */
    public static function getData(PDO $pdo): array;
}