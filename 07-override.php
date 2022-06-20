<?php

class Book 
{
  public string $title;
  public string $authorName;
  public string $genre;
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

//
// INHERITANCE
//

class Collection extends Book
{
  public static int $noVolumes;
  private string $cost;  
  // override property $noPages, since collections consist of multiple books 
  public int $noPages = 0;

  public static function createCollection() 
  {
    return "Collection has been created with " . SELF::$noVolumes . " volumes.\n";
  }
  
  // override getBookInfo, to adapt info given when title is a collection of book volumes
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

    // echo static function on construct for extended child class
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

// change value of parameter authorName, to see override of property in line 57-58
echo "\n";
$encyclopedia = new Collection('Reference', 'unknown', 'Encyclopedia Britannica', '9780852293874', 32);
echo "\n";
// view override of noPages
echo "Echoing noPages to show override: " . $encyclopedia->noPages;
echo "\n";
echo $encyclopedia->getBookInfo();
echo "\n";



