<?php


// add abstract class books
abstract class Books
{
  public string $title;
  public string $authorName;
  public string $genre;
  abstract public function getBookInfo();
  abstract protected function getISBN();  
}

// extend class from Books, in order to integrate it as abstract class
class Book extends Books
{
  
  public int $yearPublished;
  public int $noPages;
  private float $bookRating;  
  protected string $isbn;

  public function getBookInfo ()
  {
    $this->genre = strtolower($this->genre);
    return "This $this->genre title, $this->title, was published by $this->authorName in $this->yearPublished.";
  }

  public function setRating(float $ratingOutOf5) 
  {
    $this->bookRating = $ratingOutOf5;
  }

  public function getRating()
  {
    return "GETTER retrieves Rating: $this->bookRating";
  }

  public function getISBN() 
  {
    return $this->isbn;
  }

  public function __construct($genre, $authorName, $title) 
  {
    $this->genre = $genre;
    $this->authorName =$authorName;
    $this->title = $title;

    echo "CONSTRUCTOR created " . $this->title . " by " . $this->authorName . " in " . strtolower($this->genre) . " genre.\n";
  }

  function __destruct() 
  {
    echo "DESTRUCTOR destroyed object: $this->title.";
  }
}

class Collection extends Book
{
  public static int $noVolumes;
  private string $cost;  
  public int $noPages = 0;

  public static function createCollection() 
  {
    return "Collection has been created with " . SELF::$noVolumes . " volumes.\n";
  }
  
  public function getBookInfo ()
  {
    $this->genre = strtolower($this->genre);
    return "This $this->genre collection is a " . SELF::$noVolumes . "-volume edition of $this->title.";
  }

  public function __construct($genre, $authorName, $title, $isbn, $noVolumes)
  {    
    parent::__construct($genre, $authorName, $title);
    $this->isbn = $isbn;
    // override original value of $authorName
    $this->authorName = 'one or more authors';
    SELF::$noVolumes = $noVolumes;

    echo SELF::createCollection();
  }
  
  public function setVolumes ($noVolumes) 
  {
    $this->noVolumes = $noVolumes;
  }

  public function getVolumes () {
    return $this->noVolumes;
  }

  public function showCost() 
  {
    return $this->cost;
  }
}

// try to instantiate $book from Books class, but can't because it's abstract
// $book= new Books();  
// echo $book; // Fatal error: Uncaught Error: Cannot instantiate abstract class Books


// instantiation still works for child class, Book
$book001 = new Book('Non-fiction', 'Bill Bryson', 'A Short History of Nearly Everything');

// View output for constructor and destructor
print_r($book001);

