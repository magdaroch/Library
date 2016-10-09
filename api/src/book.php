<?php
/**
 * Created by PhpStorm.
 * User: Magda
 * Date: 2016-10-08
 * Time: 15:31
 */
//klasa definjująca pojedyncza ksiazke
class Book implements JsonSerializable {
    private $id;
    private $title;
    private $author;
    private $description;

    public function __construct()
    {
        $this->id = -1;
        $this->title = '';
        $this->author = '';
        $this->description = '';
    }

    //id nie podane zwroci all books a podane pojedyncza ksiazke
    public static function loadFromDB(mysqli $conn, $id = null){
        if(is_null($id)){
            //pobieramy al books
            $result = $conn->query('SELECT * FROM Books');
        }else{
            //pobieramy jedna ksiazke
            $result = $conn->query("SELECT * FROM Books WHERE id='".intval($id)."'");
        }

        $bookList = [];

        if($result && $result->num_rows>0){
            //sprawdzamy czy db cos zwrocila
            foreach ($result as $row){
                $dbBook = new Book();
                $dbBook->id = $row['id'];
                $dbBook->title = $row['title'];
                $dbBook->author = $row['author'];
                $dbBook->description = $row['description'];

                $bookList[] = json_encode($dbBook); //bez interfejsu tak NIE zadziala
            }
        }
        return $bookList;
    }
    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
        //funkcja zwraca dane z obiektu do json_encode
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'description' => $this->description
        ];
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }




}