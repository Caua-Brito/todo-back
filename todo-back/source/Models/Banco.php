<?php

namespace Source\Models;
//PDO

use PDO;
use PDOException;

class Banco
{
   private const DB_HOST = "localhost";
   private const DB_NAME = "todoMVC";
   private const DB_USER = "devcaua";
   private const DB_PASS = "mister@";
   private const OPTIONS = [
      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
      PDO::ATTR_CASE => PDO::CASE_NATURAL
   ];

   private static $connect;

   public static function connect()
   {
      if (empty(self::$connect)) {
         try {
            self::$connect = new PDO(
               "mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME,
               self::DB_USER,
               self::DB_PASS,
               self::OPTIONS
            );
         } catch (PDOException $e) {
            var_dump($e);
         }
      }
      return self::$connect;
   }
}
