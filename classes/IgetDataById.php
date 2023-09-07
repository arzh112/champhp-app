<?php

interface IgetDataById 
{
    /**
     * Undocumented function
     *
     * @param PDO $pdo - Connection instance
     * @param integer $id
     * @return object
     */
    public static function getDataById(PDO $pdo, int $id): object;
}