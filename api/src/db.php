<?php
/**
 * Created by PhpStorm.
 * User: Magda
 * Date: 2016-10-08
 * Time: 15:31
 */

class DB{
    static private $conn = null; //własnosc przechowujaca połączenie

    static public function connect(){
        if(!is_null(self::$conn)){
            //polaczenie istnieje
            return self::$conn;
        }else{
            self::$conn = new mysqli('localhost','root','coderslab','Library');
            //ustawiamy kodowanie na unicode
            self::$conn->set_charset('uft8');
            if(self::$conn->connect_error){
                die('Connection error: '.self::$conn->connect_errno);
            }
            //zwracamy połączenie
            return self::$conn;
        }
    }
    static public function disconnect(){
        //zamykamy poł z baz danych
        self::$conn->close();
        self::$conn = null;

        return true;
    }
}