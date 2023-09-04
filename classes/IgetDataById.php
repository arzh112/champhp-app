<?php

interface IgetDataById 
{
    public static function getDataById(PDO $pdo, int $id): object;
}