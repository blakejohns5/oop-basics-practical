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
  // add static property
  public static int $noVolumes;
  private string $cost;

  // add static function
  public static function createCollection() {
    // use SELF and :: to refer to static property / function within class
    return "Collection has been created with " . SELF::$noVolumes . " volumes.\n";
  }
  
  public function __construct($genre, $authorName, $title, $isbn, $noVolumes)
  {
    
    parent::__construct($genre, $authorName, $title);
    $this->isbn = $isbn;
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

// view instantiation of $encyclopedia object of class collection.
// static properties and methods are called.
echo "\n";
$encyclopedia = new Collection('Reference', 'multiple authors', 'Encyclopedia Britannica', '9780852293874', 32);
echo "\n";
echo "Echoing number of volumes from static property: " . Collection::$noVolumes;
echo "\n";echo "\n";
print_r($encyclopedia);



