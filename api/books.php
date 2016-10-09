<?php
/**
 * Created by PhpStorm.
 * User: Magda
 * Date: 2016-10-08
 * Time: 16:27
 */

//plik do ktorego bedzie łączył sie JS

$dir = dirname(__FILE__); //zwraca aktualny katalog
//includujemy pliki połacznie z baza i klase book
include ($dir.'/src/db.php');
include ($dir.'/src/book.php');

//laczymy sie z baza
$conn = DB::connect();

//plik zawsze zwraca jsona
header('Content-Type: application/json');

//sprawdzamy typ połącznia sie z JS

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    //get zwraca dane
    if(isset($_GET['id']) && intval($_GET['id'])>0){
        //sprawdzilismy czy przesłane jest id pojedynczej ksiazki
        $books = Book::loadFromDB($conn,$_GET['id']);
    }else{
        //pobieramy wszystkie ksiazki
        $books = Book::loadFromDB($conn);
    }
    echo json_encode($books);
}elseif ($_SERVER['REQUEST_METHOD'] == 'POST'){
    //post dodaje dane
}elseif ($_SERVER['REQUEST_METHOD'] == 'PUT'){
    //pobieramy przeslane dane
    parse_str(file_get_contents('php://input'),$put_vars);
}elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE'){

}
