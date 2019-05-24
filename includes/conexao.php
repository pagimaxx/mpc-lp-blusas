<?php
   
class Conexao {
 
    public static $instance;
 
    private function __construct() {
        //
    }
 
    public static function getInstance() {
        if (!isset(self::$instance)) {
            //self::$instance = new PDO('mysql:host=mysql.meupetcharmoso.com.br;dbname=meupetcharmoso', 'meupetcharmoso', 'w4q2k6', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$instance = new PDO('mysql:host=localhost:3306;dbname=mpc', 'root', 'm!nh0c@', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }
 
        return self::$instance;
    }
 
}
   
?>