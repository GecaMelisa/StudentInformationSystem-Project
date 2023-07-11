<?php

class Config{

    public static function DB_HOST(){
        return Config::get_env("DB_HOST", "student-information-system-do-user-14361289-0.b.db.ondigitalocean.com");
      }
      public static function DB_USERNAME(){
        return Config::get_env("DB_USERNAME", "doadmin");
      }
      public static function DB_PASSWORD(){
        return Config::get_env("DB_PASSWORD", "AVNS_p7O3n_BPocDyqE1cwkI");
      }
      public static function DB_SCHEME(){
        return Config::get_env("DB_SCHEME", "mydb");
      }
      public static function DB_PORT(){
        return Config::get_env("DB_PORT", "25060");
      }
      public static function get_env($name, $default){
        return isset($_ENV[$name]) && trim($_ENV[$name]) != '' ? $_ENV[$name] : $default;
       }
}
?>